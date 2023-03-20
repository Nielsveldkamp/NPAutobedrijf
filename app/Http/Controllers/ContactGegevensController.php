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
                "email" => ' ',
                "telefoonnummer" => ' '
            ]);
        }
        else{
            $contactGegevens = $contactGegevens[0];
        }
        return view('contactGegevens\update')->with('contactGegevens', $contactGegevens);
    }

    
    public function store(Request $request,ContactGegevens $contactGegevens){
        
        $request->validate(["telefoonnummer" => 'required|max:15|
        regex:/^([0-9\s\-\+\(\)]*)$/',
            "email" => 'max:255|email:rfc,dns',
        ]);
        $contactGegevens->telefoonnummer = $request->telefoonnummer;
        $contactGegevens->email = $request->email;
        $contactGegevens->save();
        

        $status = "contact gegevens zijn aangepast";
        return redirect('/')->with('status', $status);
    }
}



