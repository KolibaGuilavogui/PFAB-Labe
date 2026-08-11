<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProducteurController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Routes des profils
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth'])->get('/dashboard',function(){
        $user=auth()->user();
        if($user->hasRole('admin')){
            return redirect()->route('admin.dashboard');

        }
        if($user->hasRole('producteur')){
            return redirect()->route('producteur.dashboard');
        }
    });
    Route::middleware(['auth', 'role:admin'])->group(function(){
        Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/admin/gestionuser', [AdminController::class,'gestionUser'])->name('gestionuser');

    });
    Route::middleware(['auth', 'role:producteur'])->group(function(){
        Route::get('/producteur/dashboard', [ProducteurController::class, 'dashboard'])->name('producteur.dashboard');
    });

});

require __DIR__.'/auth.php';
