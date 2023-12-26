<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'product-owner', 'guard_name'=>'api']);
        Role::create(['name' => 'company-admin', 'guard_name'=>'api']);
        Role::create(['name' => 'freelancer', 'guard_name'=>'api']);
        Role::create(['name' => 'department-admin', 'guard_name'=>'api']);
        Role::create(['name' => 'employee', 'guard_name'=>'api']);
    }
}
