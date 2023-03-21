<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class auto extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
            // voertuigsoort
        // merk
        // datum_toelating
        // inrichting (carrosserie?)
        // eerste en tweede kleur
        // aantal cilinders (niet altijd. EV)
        // cilinderinhoud (niet altijd. EV)
        //    in cm3 / cc
        // aantal_zitplaatsen
        // apk vervaldatum
        // massa_ledig_voertuig
        // zuinigheids label
        // VERBUIk L/100KM
        //    Gecombineerd (hybrids)
        //    1.200 = 1.2L
        // ----Gas---
        // nettomaximumvermogen
        //      in kW
        // ---EV---
        // netto_max_vermogen elektrisch
        
    protected $fillable = [
        "titel", 
        "kenteken", 
        "vraagprijs",
        "omschrijving",
        "extraAccessoires",
        "transmissie",
        "BTW",
        "type",
        "brandstof",
        "apkVervaldatum",
        "merk",
        "soort", 
        "bouwjaar", 
        "carrosserie",
        "kleur", 
        "cilinderinhoud",
        "zuinigHeidsLabel",
        "gewicht",
        "stoelen",
        "deuren",
        "verbruik",
        "netMaxVermogen",
        "netMaxVermogenElektrisch",
    ];

}
