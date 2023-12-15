<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Spatie\Permission\Models\Permission;

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
