<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // HR
            'employee.view',
            'employee.create',
            'employee.update',
            'employee.delete',

            // Budget
            'budget.view',
            'budget.create',
            'budget.update',
            'budget.delete',

            // Admin
            'admin.manage',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $hrAdmin    = Role::firstOrCreate(['name' => 'hr-admin']);
        $finance    = Role::firstOrCreate(['name' => 'finance']);
        $user       = Role::firstOrCreate(['name' => 'user']);

        $superAdmin->syncPermissions(Permission::all());

        $hrAdmin->syncPermissions([
            'employee.view','employee.create','employee.update','employee.delete',
        ]);

        $finance->syncPermissions([
            'budget.view','budget.create','budget.update','budget.delete',
        ]);

        $user->syncPermissions([
            'employee.view',
        ]);
    }
}
