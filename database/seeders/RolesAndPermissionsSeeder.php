<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name' => 'edit_tasks']);
        Permission::create(['name' => 'delete_tasks']);
        Permission::create(['name' => 'create_tasks']);

        $role =
            Role::create([
            'name' => 'admin',
            'guard_name' => 'admin',
        ]);

        $role->givePermissionTo(['edit_tasks', 'delete_tasks', 'create_tasks']);
    }
}
