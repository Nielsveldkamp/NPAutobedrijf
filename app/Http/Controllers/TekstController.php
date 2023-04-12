<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tekst;
use Illuminate\Database\Eloquent\Builder;


class TekstController extends Controller
{

    public function update()
    {
        $tekst =
        Tekst::all();
        if(!isset($tekst[0])){
            $tekst = Tekst::create([
                "tekst" => ' '
            ]);
        }
        else{
            $tekst = $tekst[0];
        }
        return view('tekst.update')->with('tekst', $tekst);
    }

    
    public function store(Request $request,Tekst $tekst){
        $tekst->tekst = $request->tekst;
        $request->validate([
            "tekst" => 'max:6400'
        ]);
        $tekst->save();
        

        $status = "algemene info is aangepast";
        return redirect('/')->with('status', $status);
    }
}



