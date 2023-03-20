<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGegevens extends Model
{
    use HasFactory;
    protected $table = 'contact_gegevens';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'adress',
        'telefoonnummer',
    ];
}
