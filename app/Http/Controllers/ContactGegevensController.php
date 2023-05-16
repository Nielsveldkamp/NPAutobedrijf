<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactGegevens;
use Illuminate\Database\Eloquent\Builder;


class ContactGegevensController extends Controller
{

    public function update()
    {
        $contactGegevens =
        ContactGegevens::all();
        if(!isset($contactGegevens[0])){
            $contactGegevens = ContactGegevens::create([
                "email" => '',
                "telefoonnummer" => '',
                "adres" => ''
            ]);
        }
        else{
            $contactGegevens = $contactGegevens[0];
        }
        return view('contactGegevens.update')->with('contactGegevens', $contactGegevens);
    }

    
    public function store(Request $request,ContactGegevens $contactGegevens){
        
        $request->validate(["telefoonnummer" => 'required|max:15|
        regex:/^(?:\+?\d{1,3}\s?)?(?:\(\d{1,4}\)|\d{1,4})[-\s]?\d{1,4}[-\s]?\d{1,9}$/',
            "email" => 'max:255|email:rfc,dns',
        ]);
        $contactGegevens->telefoonnummer = $request->telefoonnummer;
        $contactGegevens->email = $request->email;
        $contactGegevens->adres = $request->adres;
        $contactGegevens->save();
        

        $status = "contact gegevens zijn aangepast";
        return redirect('/')->with('status', $status);
    }
}



