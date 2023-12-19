<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name'=>'product_owner',
            'guard_name'=>'api'
        ]);
        DB::table('roles')->insert([
            'name'=>'employee',
            'guard_name'=>'api'
        ]);
        DB::table('roles')->insert([
            'name'=>'company',
            'guard_name'=>'api'
        ]);
        DB::table('roles')->insert([
            'name'=>'freelancers',
            'guard_name'=>'api'
        ]);
    }
}