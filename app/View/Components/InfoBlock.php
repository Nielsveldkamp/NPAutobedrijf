<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Tekst;

class InfoBlock extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $tekst = Tekst::all();
        
        if(!$tekst->isEmpty()){
            $tekst = $tekst[0];
        }
        else{
            $tekst = (object)[];
            $tekst->tekst = "";
        }
        
        return view('components.info-block',
        ['tekst' => $tekst,]);
    }
}
