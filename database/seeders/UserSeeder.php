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

        $product_ownerRole = Role::create(["name" => 'product_owner', 'guard_name'=>'api']);
        $clientRole = Role::create(["name" => 'client', 'guard_name'=>'api']);
        $employeeRole = Role::create(["name" => 'employee', 'guard_name'=>'api']);

        $viewClientPermission = Permission::create(['name' => 'view clients', 'guard_name'=>'api']);
        $viewEmployeePermission = Permission::create(['name' => 'view employees', 'guard_name'=>'api']);
        $viewResourcePermission = Permission::create(['name' => 'view resource', 'guard_name'=>'api']);

        $product_ownerRole->givePermissionTo($viewClientPermission);
        $clientRole->givePermissionTo($viewEmployeePermission);
        $employeeRole->givePermissionTo($viewResourcePermission);

        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
        ]);
        // $user->assignRole('product_owner');
        // $user->givePermissionTo('view clients');

        // DB::table('roles')->insert([
        //     'name' => 'client',
        //     'guard_name' => 'api',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        // DB::table('roles')->insert([
        //     'name' => 'employee',
        //     'guard_name' => 'api',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}
