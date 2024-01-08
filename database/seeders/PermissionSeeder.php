<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'create company', 'guard_name'=>'web']);
        Permission::create(['name' => 'view company', 'guard_name'=>'web']);
        Permission::create(['name' => 'update company', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete company', 'guard_name'=>'web']);

        // Freelancer permissions
        Permission::create(['name' => 'create freelancer', 'guard_name'=>'web']);
        Permission::create(['name' => 'view freelancer', 'guard_name'=>'web']);
        Permission::create(['name' => 'update freelancer', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete freelancer', 'guard_name'=>'web']);

        // Department permissions
        Permission::create(['name' => 'create department', 'guard_name'=>'web']);
        Permission::create(['name' => 'view department', 'guard_name'=>'web']);
        Permission::create(['name' => 'update department', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete department', 'guard_name'=>'web']);

        // Employee permissions
        Permission::create(['name' => 'create employee', 'guard_name'=>'web']);
        Permission::create(['name' => 'view employee', 'guard_name'=>'web']);
        Permission::create(['name' => 'update employee', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete employee', 'guard_name'=>'web']);

        // Task permissions
        Permission::create(['name' => 'create task', 'guard_name'=>'web']);
        Permission::create(['name' => 'view task', 'guard_name'=>'web']);
        Permission::create(['name' => 'update task', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete task', 'guard_name'=>'web']);
        Permission::create(['name' => 'assign task', 'guard_name'=>'web']);
        
        // Project permissions
        Permission::create(['name' => 'create project', 'guard_name'=>'web']);
        Permission::create(['name' => 'view project', 'guard_name'=>'web']);
        Permission::create(['name' => 'update project', 'guard_name'=>'web']);
        Permission::create(['name' => 'delete project', 'guard_name'=>'web']);
        Permission::create(['name' => 'assign project', 'guard_name'=>'web']);
    }
}
//         $productOwnerPermissions = [
//             'create company', 'view company', 'delete company',
//             'create freelancer', 'view freelancer', 'delete freelancer',
//         ];

//         $freelancerPermissions = [ 'create project', 'view project', 'update project', 'delete project'];

//         $companyAdminPermissions = [
//             'create department', 'view department', 'update department', 'delete department',
//             'create employee', 'view employee', 'update employee', 'delete employee',
            
//         ];
//         $departmentAdminPermissions = [
//             'view department',
//             'create task', 'view task', 'update task', 'delete task',
//         ];
//         $employeePermissions = ['view task'];
        
//         // Assign permissions to roles
//         Role::where('name', 'product-owner')->firstOrFail()->syncPermissions($productOwnerPermissions);
//         Role::where('name', 'freelancer')->firstOrFail()->syncPermissions($freelancerPermissions);
//         Role::where('name', 'company-admin')->firstOrFail()->syncPermissions($companyAdminPermissions);
//         Role::where('name', 'department-admin')->firstOrFail()->syncPermissions($departmentAdminPermissions);
//         Role::where('name', 'employee')->firstOrFail()->syncPermissions($employeePermissions);
//     }
// }
