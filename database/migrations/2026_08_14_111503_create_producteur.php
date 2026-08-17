<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producteur', function (Blueprint $table) {
            $table->id();
            
            // Relation avec la table users créée par Laravel Breeze
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // BLOC 1 : Identité & Pièce justificative
            $table->string('phone')->nullable();
            $table->string('nin')->nullable(); // Numéro d'Identifiant National / CNI
            $table->string('cni_path')->nullable(); // Fichier de la CNI / pièce d'identité

            // BLOC 2 : Informations sur l'exploitation & la production
            $table->decimal('surface_hectares', 8, 2)->nullable(); // Nombre d'hectares
            $table->string('speculations')->nullable(); // Pomme de terre, Tomate, Fiente, etc.
            $table->integer('annees_experience')->nullable(); // Années d'expérience
            $table->string('localisation_ferme')->nullable(); // Localisation de l'exploitation

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producteur');
    }
};