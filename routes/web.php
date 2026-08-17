<?php

use App\Http\Controllers\Admin\CommandeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\ProducteurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route publique
Route::get('/', function () {
    return view('welcome');
});

// Routes protégées par authentification
Route::middleware('auth')->group(function () {

    // Gestion du profil utilisateur
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Redirection centralisée du tableau de bord selon le rôle
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('fournisseur')) {
            return view('fournisseur.espacefournisseur');
        }

        if ($user->hasRole('producteur')) {
            return view('producteur.espaceproducteur');
        }

        if ($user->hasRole('client')) {
            return redirect()->route('client.espaceclient');
        }

        abort(403, 'Rôle non défini.');
    })->name('dashboard');

    // Espace Administration (Rôle: admin)
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        
        // Tableau de bord & statistiques
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard/statistique-globale', [AdminController::class, 'statistiqueGlobale'])->name('statistique-globale');
        Route::get('/dashboard/suivi-financier', [AdminController::class, 'suiviFinancier'])->name('suivi-financier');
        
        // Gestion des utilisateurs
        Route::get('/users', [AdminController::class, 'gestionUser'])->name('users');
        Route::get('/users/listes', [AdminController::class, 'listesUtilisateurs'])->name('users.listes');
        Route::get('/users/gestion', [AdminController::class, 'gestionComptes'])->name('users.gestion');
        Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
        Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
        
        // Logistique & Supervision
        Route::get('/logistique', [AdminController::class, 'logistique'])->name('logistique');
        Route::get('/logistique/engagement-livraisons', [AdminController::class, 'engagementLivraisons'])->name('logistique.engagement-livraisons');
        Route::get('/logistique/suivi-etats', [AdminController::class, 'suiviEtats'])->name('logistique.suivi-etats');
        Route::get('/gestioncommande', [AdminController::class, 'gestioncommande'])->name('gestioncommande');
        Route::get('/supervision', [AdminController::class, 'supervision'])->name('supervision');
        Route::get('/statistique', [AdminController::class, 'statistiques'])->name('statistique');
        
        // Gestion des commandes (Resource-like)
        Route::prefix('commandes')->name('commandes.')->group(function () {
            Route::get('/', [CommandeController::class, 'index'])->name('index');
            Route::get('/create', [CommandeController::class, 'create'])->name('create');
            Route::post('/', [CommandeController::class, 'store'])->name('store');
            Route::get('/{id}', [CommandeController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [CommandeController::class, 'edit'])->name('edit');
            Route::put('/{id}', [CommandeController::class, 'update'])->name('update');
            Route::delete('/{id}', [CommandeController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/statut', [CommandeController::class, 'updateStatut'])->name('updateStatut');
            Route::post('/{id}/annuler', [CommandeController::class, 'annuler'])->name('annuler');
            Route::get('/{id}/print', [CommandeController::class, 'print'])->name('print');
        });
        
        // Routes de compatibilité (anciennes routes)
        Route::get('/gestionuser', [AdminController::class, 'gestionUser'])->name('gestionuser-old');
        Route::get('/logistique-old', [AdminController::class, 'logistique'])->name('logistique-old');
        Route::get('/gestioncommande-old', [AdminController::class, 'gestioncommande'])->name('gestioncommande-old');
        Route::get('/supervision-old', [AdminController::class, 'supervision'])->name('supervision-old');
        Route::get('/statistique-old', [AdminController::class, 'statistiques'])->name('statistique-old');
    });

    // Espace Producteur
    Route::middleware('role:producteur')->prefix('producteur')->name('producteur.')->group(function () {
        Route::get('/dashboard', [ProducteurController::class, 'dashboard'])->name('espaceproducteur');
    });

    // Espace Fournisseur
    Route::middleware('role:fournisseur')->prefix('fournisseur')->name('fournisseur.')->group(function () {
        Route::get('/dashboard', [FournisseurController::class, 'dashboard'])->name('espacefournisseur');
    });

    // Espace Client
    Route::middleware('role:client')->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('espaceclient');
        Route::get('/catalogues', [ClientController::class, 'catalogues'])->name('catalogues');
        Route::get('/panier-commandes', [ClientController::class, 'panierCommandes'])->name('panier-commandes');
    });

});

require __DIR__ . '/auth.php';