<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
        
    protected $fillable = [
        "titel", 
        "kenteken", 
        "vraagprijs",
        "omschrijving",
        "extraAccessoires",
        "websites",
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
    public function files()
    {
        return $this->hasMany(AutoFile::class);
    }

    public function mainFile()
    {
        return $this->hasOne(AutoFile::class)->oldestOfMany();
    }
}
