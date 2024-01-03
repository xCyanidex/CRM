<?php

namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ProductOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user =  User::create([
            'username' => 'umair',
            'email' => 'h.umairamjad.30@gmail.com',
            'password' => Hash::make('password'),
            
        ]);
        $permissions =  [
            'create company', 'view company', 'delete company',
            'create freelancer', 'view freelancer', 'delete freelancer',
        ];

      $role = Role::where('name', 'product-owner')->firstOrFail()->syncPermissions($permissions);
      $user->assignRole($role);


        
    }
}
