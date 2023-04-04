<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoFile extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "auto_id", 
        "name", 
    ];
    public function Auto(){
		return $this->belongsTo(Auto::class,'auto_id','id');
	}
}
