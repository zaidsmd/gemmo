<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const TYPES =[
        'materiel'=>'Matériel',
        'licence'=>'Licence'
    ];

    protected $fillable =[
        'nom',
        'type'
    ];

    public function materiel(){
        return $this->hasMany(Materiel::class,'category_id');
    }
}
