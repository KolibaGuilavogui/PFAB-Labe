<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;



class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'admin',
            'display_name'=>'Administrateur',
            'description'=>'Administrateur du site',
        ]);
         Role::create([
            'name'=>'producteur',
            'display_name'=>'Producteur',
            'description'=>'Producteur agricole',
        ]);
         Role::create([
            'name'=>'client',
            'display_name'=>'Client',
            'description'=>'Client du site',
        ]);
         $adminUser=User::create([
        'name'=>'Admin',
        'email'=>'adminfab@gmail.com',
        'password'=>bcrypt('fab2026'),
        ]);
        $adminUser->addRole('admin');
    }
   
}
