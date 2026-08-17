<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    public function dashboard(){
        return view('fournisseur.espacefournisseur');
    }
}
