<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tekst extends Model
{
    use HasFactory;
    protected $table = 'tekst';
    
    public $timestamps = false;

    protected $fillable = [
        'tekst',
    ];
}
