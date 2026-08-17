<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.espaceclient');
    }

    public function catalogues()
    {
        return view('client.catalogues');
    }

    public function panierCommandes()
    {
        return view('client.panier-commandes');
    }
}
