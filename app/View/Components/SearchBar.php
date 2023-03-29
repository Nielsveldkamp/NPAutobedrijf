<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Auto;

class SearchBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($view="")
    {
        //
        $this->view = $view;
 
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $types = Auto::all('merk','type','carrosserie','brandstof')->unique('type')->groupBy(['merk']);
        $brandstoffen = Auto::all('merk','type','brandstof')->unique('type')->groupBy(['brandstof','merk']);
        $carrosseries = Auto::all('merk','type','carrosserie')->unique('type')->groupBy(['carrosserie','merk']);
   
        return view('components.search-bar'.$this->view, ['types' => $types,'carrosseries'=> $carrosseries,'brandstoffen'=> $brandstoffen]);
    }
}
