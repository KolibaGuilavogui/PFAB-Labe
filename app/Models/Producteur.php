<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producteur extends Model
{
    protected $table = 'producteur'; // Spécifier le nom exact de la table
    
    protected $fillable = [
        'user_id',
        'phone',
        'nin',
        'cni_path',
        'surface_hectares',
        'speculations',
        'annees_experience',
        'localisation_ferme',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}