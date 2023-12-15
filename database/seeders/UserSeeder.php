<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Create a user
       $user = User::create([
        'name' => 'ahmad',
        'email' => 'ahmad@example.com',
        'password' => Hash::make('password'),
      
    ]);

    $role = Role::where('name', 'client')->first();
 

    $permission = Permission::where('name','view-employee')->first();
    $role->givePermissionTo($permission);
    $user->assignRole($role);
    

  
   
    }
}
