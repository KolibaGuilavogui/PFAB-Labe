<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    protected $table = 'fournisseur'; // Spécifier le nom exact de la table
    
    protected $fillable = [
        'user_id',
        'phone',
        'nin',
        'cni_path',
        'company_name',
        'rccm',
        'address',
        'sales_zones',
        'intrants_sold',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}