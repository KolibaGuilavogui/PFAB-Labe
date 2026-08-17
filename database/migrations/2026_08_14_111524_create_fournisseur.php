<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fournisseur', function (Blueprint $table) {
            $table->id();

            // Relation avec la table users créée par Laravel Breeze
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
           
            // BLOC 1 : Identité du responsable
            $table->string('phone')->nullable();
            $table->string('nin')->nullable(); // NIN / CNI du représentant
            $table->string('cni_path')->nullable(); // Fichier CNI

            // BLOC 2 : Informations sur l'entreprise & Activité commercial
            $table->string('company_name')->nullable(); // Nom du magasin / établissement
            $table->string('rccm')->nullable(); // Registre de commerce
            $table->string('address')->nullable(); // Adresse / Localisation du magasin principal
            $table->string('sales_zones')->nullable(); // Zones ou lieux de vente
            $table->text('intrants_sold')->nullable(); // Intrants vendus (engrais, semences, outillage, etc.)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fournisseur');
    }
};