<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;

    protected $table = 'ligne_commandes';
    protected $guarded = [];

    /**
     * Relation: Une ligne de commande appartient à une commande
     */
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    /**
     * Relation: Une ligne de commande appartient à un produit
     */
    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    /**
     * Obtenir le total de la ligne (quantité × prix)
     */
    public function getTotalAttribute()
    {
        return $this->quantite * $this->prix_unitaire;
    }
}
