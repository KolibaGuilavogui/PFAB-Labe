<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=[
             ['nom_role'=>'admin','libelle'=>'Administrateur'],
             ['nom_role'=>'producteur','libelle'=>'Producteur'],
             ['nom_role'=>'acheteur','libelle'=>'Acheteur'],
        ];
       foreach($roles as $role){
        Role::firstOrCreate(['nom_role'=>$role['nom_role']],$role);
       }
    }
}
