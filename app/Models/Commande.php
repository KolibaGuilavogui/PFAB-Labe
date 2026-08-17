<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commandes';
    protected $guarded = [];

    // Statuts possibles
    const STATUTS = [
        'en_attente' => 'En Attente',
        'confirmee' => 'Confirmée',
        'en_preparation' => 'En Préparation',
        'prete' => 'Prête',
        'en_livraison' => 'En Livraison',
        'livree' => 'Livrée',
        'annulee' => 'Annulée',
        'remboursee' => 'Remboursée',
    ];

    const PAYMENT_STATUS = [
        'en_attente' => 'En Attente',
        'payee' => 'Payée',
        'partiellement_payee' => 'Partiellement Payée',
        'remboursee' => 'Remboursée',
    ];

    const COLOR_MAP = [
        'en_attente' => 'warning',
        'confirmee' => 'info',
        'en_preparation' => 'primary',
        'prete' => 'secondary',
        'en_livraison' => 'dark',
        'livree' => 'success',
        'annulee' => 'danger',
        'remboursee' => 'secondary',
    ];

    /**
     * Relation: Une commande appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation: Une commande a plusieurs lignes de commande
     */
    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }

    /**
     * Obtenir le statut formaté
     */
    public function getStatutLabelAttribute()
    {
        return self::STATUTS[$this->statut] ?? $this->statut;
    }

    /**
     * Obtenir le statut de paiement formaté
     */
    public function getPaymentStatusLabelAttribute()
    {
        return self::PAYMENT_STATUS[$this->payment_status] ?? $this->payment_status;
    }

    /**
     * Scope: Filtrer par statut
     */
    public function scopeByStatut($query, $statut)
    {
        if ($statut) {
            return $query->where('statut', $statut);
        }
        return $query;
    }

    /**
     * Scope: Rechercher par numéro ou téléphone du client
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('id', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
        }
        return $query;
    }

    /**
     * Obtenir le numéro de commande formaté
     */
    public function getNumeroCommandeAttribute()
    {
        return 'CMD-' . str_pad($this->id, 6, '0', STR_PAD_LEFT);
    }

    /**
     * Obtenir la classe de couleur Bootstrap pour le statut
     */
    public function getColorAttribute()
    {
        return self::COLOR_MAP[$this->statut] ?? 'secondary';
    }

    /**
     * Obtenir la classe de couleur Bootstrap pour le statut de paiement
     */
    public function getPaymentColorAttribute()
    {
        $paymentColors = [
            'payee' => 'success',
            'en_attente' => 'warning',
            'partiellement_payee' => 'info',
            'remboursee' => 'danger',
        ];
        return $paymentColors[$this->payment_status] ?? 'secondary';
    }
}
