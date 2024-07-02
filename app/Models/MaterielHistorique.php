<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterielHistorique extends Model
{
    use HasFactory;



    protected $fillable = [
        'materiel_id', 'action', 'date'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    protected  function date() : Attribute{
        return Attribute::make(get: fn ($value)=> Carbon::make($value)->format('d/m/Y H:i:s'));
    }
}
