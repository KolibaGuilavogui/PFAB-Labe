<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProducteurController extends Controller
{
    public function dashboard(){
        return view('producteur.dashboard');
    }
}
