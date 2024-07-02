<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Materiel extends Model
{
    use HasFactory;
public const STATUS = [
    'en_prod'=>'En production'
];
    protected $fillable = [
        'nom',
        'marque',
        'serial',
        'inventaire',
        'description',
        'statut',
        'category_id',
        'image',
        'prix_achat',
        'departement_id',
        'quantite'
    ];
    public function employe(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'materiel_user','materiel_id','user_id')->wherePivot('current',1)->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class,'departement_id');
    }
}
