<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'edit articles',
            'view articles',
            'delete articles',
            'create articles',
            'edit roles',
            'view roles',
            'delete roles',
            'create roles',
            'edit users',
            'view users',
            'delete users',
            'create users',
            'edit permissions',
            'view permissions',
            'delete permissions',
            'create permissions'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $writer = Role::firstOrCreate(['name' => 'writer']);
        $writer->givePermissionTo(['edit articles', 'view articles', 'delete articles', 'create articles']);

        $admin = Role::firstOrCreate(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $superAdmin = Role::firstOrCreate(['name' => 'super admin']);
    }
}
