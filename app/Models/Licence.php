<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Licence extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom',
        'date_achat',
        'date_expiration',
        'prix_achat',
        'quantite',
        'description',
        'category_id',
        'materiel_id',
        'departement_id',
        'locale_id',
    ];


    public function employe(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'licence_user','licence_id','user_id')->wherePivot('current',1)->withTimestamps();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function departement(): BelongsTo
    {
        return $this->belongsTo(Departement::class,'departement_id');
    }

    public function materiel(): BelongsTo
    {
        return $this->belongsTo(Materiel::class);
    }
}
