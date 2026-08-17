<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Producteur;
use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function gestionUser(){
        return view('admin.gestionuser');
    }

    public function createUser()
    {
        return view('admin.users.index');
    }

    public function storeUser(Request $request)
    {
        // 1. Récupération explicite de la valeur du type/rôle d'utilisateur
        $userRole = $request->input('user_type'); 

        try {
            if ($userRole === 'producteur') {
                $validated = $request->validate([
                    'producteur_name'     => 'required|string|max:255',
                    'producteur_email'    => 'required|email|unique:users,email',
                    'producteur_password' => 'required|min:8',
                ]);

                DB::transaction(function () use ($request) {
                    $user = User::create([
                        'name'     => $request->producteur_name,
                        'email'    => $request->producteur_email,
                        'password' => Hash::make($request->producteur_password),
                    ]);

                    // Assignation du rôle Laratrust (addRole)
                    if (method_exists($user, 'addRole')) {
                        $user->addRole('producteur');
                    } elseif (method_exists($user, 'assignRole')) {
                        $user->assignRole('producteur');
                    }

                    $cniPath = null;
                    if ($request->hasFile('producteur_cni_file')) {
                        $cniPath = $request->file('producteur_cni_file')->store('cni_documents', 'public');
                    }

                    Producteur::create([
                        'user_id'            => $user->id,
                        'phone'              => $request->producteur_phone ?? null,
                        'nin'                => $request->producteur_nin ?? null,
                        'cni_path'           => $cniPath,
                        'surface_hectares'   => $request->producteur_surface_hectares ?? null,
                        'speculations'       => $request->producteur_speculations ?? null,
                        'annees_experience'  => $request->producteur_annees_experience ?? null,
                        'localisation_ferme' => $request->producteur_localisation_ferme ?? null,
                    ]);
                });

            } elseif ($userRole === 'fournisseur') {
                $validated = $request->validate([
                    'fournisseur_name'     => 'required|string|max:255',
                    'fournisseur_email'    => 'required|email|unique:users,email',
                    'fournisseur_password' => 'required|min:8',
                ]);

                DB::transaction(function () use ($request) {
                    $user = User::create([
                        'name'     => $request->fournisseur_name,
                        'email'    => $request->fournisseur_email,
                        'password' => Hash::make($request->fournisseur_password),
                    ]);

                    // Assignation du rôle Laratrust (addRole)
                    if (method_exists($user, 'addRole')) {
                        $user->addRole('fournisseur');
                    } elseif (method_exists($user, 'assignRole')) {
                        $user->assignRole('fournisseur');
                    }

                    $cniPath = null;
                    if ($request->hasFile('fournisseur_cni_file')) {
                        $cniPath = $request->file('fournisseur_cni_file')->store('cni_documents', 'public');
                    }

                    Fournisseur::create([
                        'user_id'       => $user->id,
                        'phone'         => $request->fournisseur_phone ?? null,
                        'nin'           => $request->fournisseur_nin ?? null,
                        'cni_path'      => $cniPath,
                        'company_name'  => $request->fournisseur_company_name ?? null,
                        'rccm'          => $request->fournisseur_rccm ?? null,
                        'address'       => $request->fournisseur_address ?? null,
                        'sales_zones'   => $request->fournisseur_sales_zones ?? null,
                        'intrants_sold' => $request->fournisseur_intrants_sold ?? null,
                    ]);
                });

            } else {
                return redirect()->back()->withErrors(['user_type' => 'Type d\'utilisateur invalide'])->withInput();
            }

            return redirect()->back()->with('success', 'Utilisateur créé avec succès !');

        } catch (\Exception $e) {
            Log::error('Erreur lors de la création d\'utilisateur: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Erreur: ' . $e->getMessage()])->withInput();
        }
    }

    public function logistique(){
        return view('admin.logistique');
    }

    public function gestioncommande(){
        return view('admin.gestioncommande');
    }

    public function statistiques(){
        return view('admin.statistique');
    }

    public function supervision(){
        return view('admin.logistique');
    }

    public function statistiqueGlobale(){
        return view('admin.dashboard.statistique-globale');
    }

    public function suiviFinancier(){
        return view('admin.dashboard.suivi-financier');
    }

    public function listesUtilisateurs(){
        return view('admin.users.listes');
    }

    public function gestionComptes(){
        return view('admin.users.gestion');
    }

    public function engagementLivraisons(){
        return view('admin.logistique.engagement-livraisons');
    }

    public function suiviEtats(){
        return view('admin.logistique.suivi-etats');
    }
}