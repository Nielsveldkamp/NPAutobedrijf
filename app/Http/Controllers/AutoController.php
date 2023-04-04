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
        
        $kenteken = strtoupper($request->kenteken);
        $autoApiResponse = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=".strtoupper(str_replace("-", "", trim($request->kenteken))))->json();
        
        $rules = [
            "titel" => 'required|max:255',
            "kenteken" => 'required|max:8|unique:autos,kenteken',
            "omschrijving" => 'required',
            "vraagprijs" => 'required|Numeric',
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
    //  ook kijkt deze code of de properties
    //  "netto_max_vermogen_elektrisch", "brandstof_verbruik_gecombineerd_wltp", "nettomaximumvermogen", "brandstofverbruik_gecombineerd" 
    //  er zijn zo niet vervang ik ze met een vergelijkbare propertie of als die er niet is met 0
        if(count($brandstofApiResponse)>1){
            $brandstof = "Hybride";
            foreach($brandstofApiResponse as $brandstofSoort){
                if($brandstofSoort["brandstof_omschrijving"] === "Elektriciteit"){
                    $netMaxVermogenElektrisch = (isset($brandstofSoort['netto_max_vermogen_elektrisch'])? $brandstofSoort['netto_max_vermogen_elektrisch']: $brandstofSoort['nominaal_continu_maximumvermogen']);
                }
                elseif($brandstofSoort["brandstof_omschrijving"]=== "benzine"||"diesel"){
                    $netMaxVermogen=(isset($brandstofSoort['nettomaximumvermogen'])? $brandstofSoort['nettomaximumvermogen']:"0");
                    $verbruik = (isset($brandstofSoort['brandstof_verbruik_gecombineerd_wltp'])? $brandstofSoort['brandstof_verbruik_gecombineerd_wltp']:"0");
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
                $verbruik = (isset($brandstofApiResponse["brandstofverbruik_gecombineerd"])?$brandstofApiResponse["brandstofverbruik_gecombineerd"]:"0");
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

        $websites = json_encode(array_map(function($relUrl){        
            $ret = parse_url($relUrl);
           if ( !isset($ret["scheme"])and !empty($relUrl))
            {
            return "https://{$relUrl}";
            }else{
               return $relUrl;
            }
       },array_map('trim',preg_split('/\s+/',$request->websites))));

        $bouwjaar = substr($autoApiResponse->datum_eerste_toelating,0,4);

        $auto = Auto::create([
            "titel" => $request->titel,
            "vraagprijs" => $request->vraagprijs,
            "omschrijving" => $request->omschrijving,
            "transmissie" => $request->transmissie,
            "BTW" => $request->BTW,
            "type" => $autoApiResponse->handelsbenaming,
            "extraAccessoires" =>  $request->extraAccessoires,
            "soort" => $autoApiResponse->voertuigsoort,
            "apkVervaldatum" => $autoApiResponse->vervaldatum_apk,
            "kenteken" => $request->kenteken,
            "merk" => $autoApiResponse->merk,
            "bouwjaar" => $bouwjaar,
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
            "websites" => $websites,
        ]);
        // moves file to storage and makes a directory with the kenteken as name and adds the file to the database
        foreach($request->files as $files){
            if(!file_exists('storage/'.$request->kenteken)){
                mkdir('storage/'.$request->kenteken,0777,true);
            }
            foreach($files as $file){
                $autoFile = AutoFile::create([
                "auto_id" => $auto->id,
                "name" => $file->getClientOriginalName()
                ]);
                $autoFile->name = $autoFile->id.$autoFile->name;
                $autoFile->save();
                $file->move('storage/'.$auto->kenteken, $autoFile->name);
            }
         }
        return redirect("/autos/$auto->merk/$auto->type/$auto->id");
    }

    public function index( Request $request)
    {
        $autos  = Auto::paginate(10);
        
        return view('auto/index')->with('autos', $autos);   
    }
    public function indexMerk($merk, Request $request)
    {
        $autos  = Auto::where('merk',$merk)->paginate(10);
        return view('auto/index')->with('autos', $autos);   
    }

    public function indexMerkModel($merk, $model, Request $request)
    {
        $autos  = Auto::where('merk',$merk)->where('type',$model)->paginate(10);
        return view('auto/index')->with('autos', $autos);   
    }

    public function show($merk, $model, Auto $auto){
        return view('auto.show')->with('auto',$auto);
    }

    public function change(Request $request,Auto $auto){
        return view('auto.change')->with('auto',$auto);
    }
    public function update(Request $request,Auto $auto){
        $rules = [
            "titel" => 'required|max:255',
            "omschrijving" => 'required',
            "vraagprijs" => 'required|Numeric',
            "transmissie" => 'required',
            "BTW" => 'required',
            'files.*' => 'image|max:3145728',
        ];
        $request->validate($rules);

        $auto->titel = $request->titel;
        $auto->vraagprijs = $request->vraagprijs;
        $auto->transmissie = $request->transmissie;
        $auto->BTW = $request->BTW;


        $websites = array_map(function($relUrl){        
            $ret = parse_url($relUrl);
           if ( !isset($ret["scheme"])and !empty($relUrl))
            {
            return "https://{$relUrl}";
            }else{
               return $relUrl;
            }
       },array_map('trim',preg_split('/\s+/',$request->websites)));

        $auto->websites = $websites;
        $auto->omschrijving = $request->omschrijving;
        $auto->extraAccessoires = $request->extraAccessoires;
        $auto->save();

        foreach($request->files as $files){
            if(!file_exists('storage/'.$auto->kenteken)){
                mkdir('storage/'.$auto->kenteken,0777,true);
            }
            foreach($files as $file){                
                $autoFile = AutoFile::create([
                    "auto_id" => $auto->id,
                    "name" => $file->getClientOriginalName()
                ]);
                $autoFile->name = $autoFile->id.$autoFile->name;
                $autoFile->save();
                $file->move('storage/'.$auto->kenteken, $autoFile->name);
            }
         }
        
        $status = "auto is aangepast";
        return redirect("/autos/$auto->merk/$auto->type/$auto->id");
    }

    public function ajaxDeleteFile(Request $request, AutoFile $autoFile){
        $auto = $autoFile->Auto()->get()[0];
            unlink("storage/$auto->kenteken/$autoFile->name");
            AutoFile::destroy($autoFile->id);
            return json_decode([400]);
    }
    
    public function delete(Request $request,$merk, $model, Auto $auto){
        
        if(file_exists("storage/$auto->kenteken")){
            $files = array_diff(scandir("storage/$auto->kenteken/"), array('.','..'));

            foreach ($files as $file) {
              unlink("storage/$auto->kenteken/$file");
            }
            rmdir("storage/$auto->kenteken");
        }
        
        foreach($auto->files as $file){
            AutoFile::destroy($file->id);
        }
        Auto::destroy($auto->id);
        
        $status = "auto is verwijdert";
        return redirect("autos/");
    }
    public function search(Request $request){
        $autos = Auto::where([
            [function($query)use($request){
                if($request->merk !=null){
                    $query->where('merk',$request->merk);
                }
                if($request->type !=null){
                    $query->where('type',$request->type);
                }
                if($request->brandstof !=null){
                    $query->where('brandstof',$request->brandstof);
                }
                if($request->carrosserie !=null){
                    $query->where('carrosserie',$request->carrosserie);
                }
                if($request->vanaf !=null){
                    $query->where('vraagprijs',">",$request->vanaf);
                }
                if($request->tm !=null){
                    $query->where('vraagprijs','<',$request->tm);
                }       
            }]
        ])->paginate(10);
        return view('auto.index')->with('autos',$autos);
    }

    public function getSearchbarAjax(){
        
        return response()->json([
            'values' => [
                'types' => Auto::all('merk', 'type', 'carrosserie', 'brandstof')
                            ->unique('type')
                            ->groupBy('merk'),
                'brandstoffen' => Auto::all('merk', 'type', 'brandstof')
                                    ->unique('type')
                                    ->groupBy(['brandstof', 'merk']),
                'carrosseries' => Auto::all('merk', 'type', 'carrosserie')
                                    ->unique('type')
                                    ->groupBy(['carrosserie', 'merk'])
            ]
        ], 200);
        
    }
    
}



