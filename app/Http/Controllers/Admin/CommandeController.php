<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use App\Models\LigneCommande;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CommandeController extends Controller
{
    /**
     * Afficher la liste des commandes
     */
    public function index(Request $request)
    {
        $query = Commande::with(['user', 'lignes']);

        // Filtrer par statut
        if ($request->has('statut') && $request->statut) {
            $query->byStatut($request->statut);
        }

        // Recherche
        if ($request->has('search') && $request->search) {
            $query->search($request->search);
        }

        // Pagination
        $commandes = $query->orderBy('created_at', 'desc')->paginate(15);
        $statuts = Commande::STATUTS;

        return view('admin.commandes.index', compact('commandes', 'statuts'));
    }

    /**
     * Afficher le détail d'une commande
     */
    public function show($id)
    {
        $commande = Commande::with(['user', 'lignes.produit'])->findOrFail($id);
        $statuts = Commande::STATUTS;

        return view('admin.commandes.show', compact('commande', 'statuts'));
    }

    /**
     * Mettre à jour le statut d'une commande
     */
    public function updateStatut(Request $request, $id)
    {
        $request->validate([
            'statut' => 'required|in:' . implode(',', array_keys(Commande::STATUTS)),
        ]);

        $commande = Commande::findOrFail($id);
        $commande->update([
            'statut' => $request->statut,
        ]);

        return redirect()->back()->with('success', 'Statut mis à jour avec succès.');
    }

    /**
     * Annuler une commande avec motif
     */
    public function annuler(Request $request, $id)
    {
        $request->validate([
            'motif' => 'required|string|min:10',
        ]);

        $commande = Commande::findOrFail($id);

        $commande->update([
            'statut' => 'annulee',
            'note_admin' => $request->motif,
        ]);

        return redirect()->back()->with('success', 'Commande annulée avec succès.');
    }

    /**
     * Générer une facture PDF
     */
    public function print($id)
    {
        $commande = Commande::with(['user', 'lignes.produit'])->findOrFail($id);

        $pdf = Pdf::loadView('admin.commandes.facture', compact('commande'));

        return $pdf->download('facture_' . $commande->numero_commande . '.pdf');
    }

    /**
     * Créer une nouvelle commande (page formulaire)
     */
    public function create()
    {
        return view('admin.commandes.create');
    }

    /**
     * Stocker une nouvelle commande
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'adresse_livraison' => 'required|string',
            'lignes' => 'required|array|min:1',
            'lignes.*.produit_id' => 'required|exists:produits,id',
            'lignes.*.quantite' => 'required|integer|min:1',
            'lignes.*.prix_unitaire' => 'required|numeric|min:0',
        ]);

        $total = 0;
        foreach ($request->lignes as $ligne) {
            $total += $ligne['quantite'] * $ligne['prix_unitaire'];
        }

        $commande = Commande::create([
            'user_id' => $request->user_id,
            'total' => $total,
            'statut' => 'en_attente',
            'adresse_livraison' => $request->adresse_livraison,
            'payment_status' => 'en_attente',
        ]);

        // Créer les lignes de commande
        foreach ($request->lignes as $ligne) {
            LigneCommande::create([
                'commande_id' => $commande->id,
                'produit_id' => $ligne['produit_id'],
                'quantite' => $ligne['quantite'],
                'prix_unitaire' => $ligne['prix_unitaire'],
            ]);
        }

        return redirect()->route('admin.commandes.show', $commande->id)
            ->with('success', 'Commande créée avec succès.');
    }

    /**
     * Éditer une commande
     */
    public function edit($id)
    {
        $commande = Commande::with(['user', 'lignes'])->findOrFail($id);
        return view('admin.commandes.edit', compact('commande'));
    }

    /**
     * Mettre à jour une commande
     */
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        $request->validate([
            'adresse_livraison' => 'required|string',
            'payment_status' => 'required|in:' . implode(',', array_keys(Commande::PAYMENT_STATUS)),
        ]);

        $commande->update([
            'adresse_livraison' => $request->adresse_livraison,
            'payment_status' => $request->payment_status,
        ]);

        return redirect()->route('admin.commandes.show', $id)
            ->with('success', 'Commande mise à jour avec succès.');
    }

    /**
     * Supprimer une commande
     */
    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->lignes()->delete();
        $commande->delete();

        return redirect()->route('admin.commandes.index')
            ->with('success', 'Commande supprimée avec succès.');
    }
}
