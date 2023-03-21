<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Auto;
use App\Models\AutoFile;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

//  https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=0001TV

class AutoController extends Controller
{
    public function create()
    {
        return view('auto\create');
    }

    public function store(Request $request){
        
        $kenteken = str_replace('-','',$request->kenteken);
        $autoApiResponse = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=".str_replace("-", "", trim($request->kenteken)))->json();
        
        $rules = [
            "titel" => 'required|max:255',
            "kenteken" => 'required|max:8:unique',
            "omschrijving" => 'required',
            "vraagprijs" => 'required',
            "transmissie" => 'required',
            "BTW" => 'required',
            'files.*' => 'image|max:3145728',
        ];

        // check if car was found
        //  if not validate other fields and send errors back
        if(isset($autoApiResponse[0])){
           $autoApiResponse= (object)$autoApiResponse[0];
           $request->validate($rules);
        }
        else{
            $errors =["kenteken" => "kenteken is niet geregistreerd bij de ADW"];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = array_merge($errors,$validator->messages()->get('*'));
            }
            return redirect()->back()
                    ->withInput($request->input())
                    ->withErrors($errors);
        }

        $brandstofApiResponse= Http::get($autoApiResponse->api_gekentekende_voertuigen_brandstof."?kenteken=".$autoApiResponse->kenteken)->json();
    //  check brandstof type.
    //  meerdere verschillende types betekent dat het hybride is 
        if(count($brandstofApiResponse)>1){
            $brandstof = "Hybride";
            foreach($brandstofApiResponse as $brandstofSoort){
                if($$brandstofSoort["brandstof_omschrijving"] === "Elektriciteit"){
                    $netMaxVermogenElektrisch = $brandstofSoort["netto_max_vermogen_elektrisch"];
                }
                elseif($brandstofSoort["brandstof_omschrijving"]=== "benzine"||"diesel"){
                    $netMaxVermogen=$brandstofSoort["nettomaximumvermogen"];
                    $verbruik = $brandstofSoort["brandstof_verbruik_gecombineerd_wltp"];
                }
            }
        }
        else{
            $brandstofApiResponse = $brandstofApiResponse[0];
            $brandstof = $brandstofApiResponse["brandstof_omschrijving"];
            if($brandstof === "Elektriciteit"){
                if(isset( $brandstofApiResponse["netto_max_vermogen_elektrisch"])){
                    $netMaxVermogenElektrisch = $brandstofApiResponse["netto_max_vermogen_elektrisch"];
                }
                else{
                    $netMaxVermogenElektrisch =  $brandstofApiResponse["nominaal_continu_maximumvermogen"];
                }
               
                $verbruik = 0;
                $netMaxVermogen = 0;
            }
            else{
                $netMaxVermogen=$brandstofApiResponse["nettomaximumvermogen"];
                $verbruik = $brandstofApiResponse["brandstofverbruik_gecombineerd"];
                $netMaxVermogenElektrisch = 0;
            }
        }
        // get first and second colour
        if($autoApiResponse->tweede_kleur != "Niet geregistreerd" && $autoApiResponse->tweede_kleur != $autoApiResponse->eerste_kleur){
            $kleur = $autoApiResponse->eerste_kleur." / ". $autoApiResponse->tweede_kleur;
        }
        else{
            $kleur = $autoApiResponse->eerste_kleur;
        }


        if(isset($autoApiResponse->aantal_cilinders)){
            $aantalCilinders = $autoApiResponse->aantal_cilinders;
        }else{
            $aantalCilinders = 0;
        }
        if(isset($autoApiResponse->cilinderinhoud)){
            $cilinderinhoud = $autoApiResponse->cilinderinhoud;
        }
        else{
            $cilinderinhoud = 0;
        }
        if(isset($autoApiResponse->zuinigheidsclassificatie)){
            $zuinigheidsclassificatie = $autoApiResponse->zuinigheidsclassificatie;
        }
        else{
            $zuinigheidsclassificatie = "-";
        }

        $bouwjaar = substr($autoApiResponse->datum_eerste_toelating,0,4);

        $auto = Auto::create([
            "titel" => $request->titel,
            "vraagprijs" => $request->vraagprijs,
            "omschrijving" => $request->omschrijving,
            "transmissie" => $request->transmissie,
            "BTW" => $request->BTW,
            "type" => $autoApiResponse->handelsbenaming,
            "extraAccessoires" => "",
            "soort" => $autoApiResponse->voertuigsoort,
            "apkVervaldatum" => $autoApiResponse->vervaldatum_apk,
            "kenteken" => $request->kenteken,
            "merk" => $autoApiResponse->merk,
            "bouwjaar" => $autoApiResponse->datum_eerste_toelating,
            "carrosserie" => Http::get($autoApiResponse->api_gekentekende_voertuigen_carrosserie."?kenteken=".$autoApiResponse->kenteken)->json()[0]["type_carrosserie_europese_omschrijving"],
            "kleur" => $kleur,
            "brandstof" => $brandstof,
            "cilinderinhoud" => $cilinderinhoud,
            "zuinigHeidsLabel" => $zuinigheidsclassificatie,
            "gewicht" => $autoApiResponse->massa_ledig_voertuig,            
            "stoelen" => $autoApiResponse->aantal_zitplaatsen,
            "deuren" => $autoApiResponse->aantal_zitplaatsen,
            "verbruik" => $verbruik,
            "netMaxVermogen" => $netMaxVermogen,
            "netMaxVermogenElektrisch" => $netMaxVermogenElektrisch,

        ]);
            // moves file to storage and makes a directory with the kenteken
        foreach($request->files as $files){
            if(!file_exists('storage/'.$request->kenteken)){
                mkdir('storage/'.$request->kenteken,0777,true);
            }
            foreach($files as $file){
                $autoFile = AutoFile::create([
                "auto_id" => $auto->id,
                "name" => $file->getClientOriginalName()
                ]);
                   $file->move('storage/'.$request->kenteken,  $file->getClientOriginalName());
            }
         }
        return redirect("/autos/$auto->merk/$auto->type/$auto->id");
    }

    public function index( Request $request)
    {
        $autos  = Auto::all();
        return view('auto/index')->with('autos', $autos);   
    }
    public function indexMerk($merk, Request $request)
    {
        $autos  = Auto::where('merk',$merk)->get();
        return view('auto/index')->with('autos', $autos);   
    }

    public function indexMerkModel($merk, $model, Request $request)
    {
        $autos  = Auto::where('merk',$merk)->where('type',$model)->get();
        return view('auto/index')->with('autos', $autos);   
    }

    public function show($merk, $model, Auto $auto){
        $files = AutoFile::where('auto_id',$auto->id)->get();
        return view('auto.show')->with('auto',$auto)->with('files',$files);
    }

    public function change(Request $request,Auto $auto){

        return redirect("/auto/$auto->id");
    }
    public function update(Request $request,Auto $auto){

        return redirect("/auto/$auto->id");
    }
    
    public function delete(Request $request,$merk, $model, Auto $auto){
        
        if(file_exists('storage/'.$auto->kenteken)){
            $files = array_diff(scandir("storage/$auto->kenteken/"), array('.','..'));

            foreach ($files as $file) {
              (is_dir("storage/$auto->kenteken/$file")) 
              ? is_dir("storage/$auto->kenteken/$file") 
              : unlink("storage/$auto->kenteken/$file");
        
            }
            rmdir('storage/'.$auto->kenteken,);
        }
        $files = AutoFile::where('auto_id',$auto->id)->get();
        foreach($files as $file){
            AutoFile::destroy($file->id);
        }
        Auto::destroy($auto->id);
        
        $status = "auto is verwijdert";
        
        
        return redirect("autos/");
    }
    
}



