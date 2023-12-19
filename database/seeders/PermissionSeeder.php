<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            'name' => 'view-company',
            'guard_name' => 'api'

        ]);
        DB::table('permissions')->insert([
            'name' => 'create-company',
            'guard_name' => 'api'

        ]);
        DB::table('permissions')->insert([
            'name' => 'view-employee',
            'guard_name' => 'api'

        ]);
        DB::table('permissions')->insert([
            'name' => 'edit-employee',
            'guard_name' => 'api'
        ]);
    }
}
