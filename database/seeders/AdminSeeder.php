<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $permissions = [
            ['name' => 'Index-admin', 'category' => 'Admin', 'display' => 'Index'],
            ['name' => 'Create-admin', 'category' => 'Admin', 'display' => 'Create'],
            ['name' => 'Edit-admin', 'category' => 'Admin', 'display' => 'Edit'],
            ['name' => 'Delete-admin', 'category' => 'Admin', 'display' => 'Delete'],

            ['name' => 'Index-role', 'category' => 'Roles', 'display' => 'Index'],
            ['name' => 'Create-role', 'category' => 'Roles', 'display' => 'Create'],
            ['name' => 'Edit-role', 'category' => 'Roles', 'display' => 'Edit'],
            ['name' => 'Delete-role', 'category' => 'Roles', 'display' => 'Delete'],

            ['name' => 'Index-client', 'category' => 'Client', 'display' => 'Index'],
            ['name' => 'Edit-client', 'category' => 'Client', 'display' => 'Edit'],
            ['name' => 'Delete-client', 'category' => 'Client', 'display' => 'Delete'],

            ['name' => 'Index-room', 'category' => 'Room', 'display' => 'Index'],
            ['name' => 'Create-room', 'category' => 'Room', 'display' => 'Create'],
            ['name' => 'Edit-room', 'category' => 'Room', 'display' => 'Edit'],
            ['name' => 'Delete-room', 'category' => 'Room', 'display' => 'Delete'],

            ['name' => 'Index-booking', 'category' => 'Booking', 'display' => 'Index'],
        ];

        // Define employee permissions
        $employeePermissions = [
            ['name' => 'Index-room', 'category' => 'Room', 'display' => 'Index'],
            ['name' => 'Index-booking', 'category' => 'Booking', 'display' => 'Index'],
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission['name'], 'category' => $permission['category'], 'guard_name' => 'web', 'display' => $permission['display']]);
        }
        $admin= User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456789'),
        ]);
        $adminRole = Role::create(['name' => 'Admin', 'guard_name' => 'web']);
        $employeeRole = Role::create(['name' => 'Employee', 'guard_name' => 'web']);

        // $permissions = Permission::pluck('id', 'id')->all();

        $adminRole->syncPermissions(Permission::whereIn('name', array_column($permissions, 'name'))->get());
        $employeeRole->syncPermissions(Permission::whereIn('name', array_column($employeePermissions, 'name'))->get());
        $admin->assignRole($adminRole);

    }

}
