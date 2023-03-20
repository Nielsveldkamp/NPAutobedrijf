<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\ContactGegevens;

class Footer extends Component
{
private $contactGegevens;

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
        $contactGegevens = ContactGegevens::all();
        if(!$contactGegevens->isEmpty()){
            $contactGegevens = $contactGegevens[0];
        }
        else{
            $contactGegevens = (object)[];
            $contactGegevens->telefoonnummer = "";
            $contactGegevens->email = "";
        }
        return view('components.footer',
        ['contact_gegevens' => $contactGegevens,]);
    }
}
