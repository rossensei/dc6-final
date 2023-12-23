<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Administrator']);
        Role::create(['name' => 'Manager']);
        Role::create(['name' => 'User']);

        Permission::create(['name' => 'manage-users']);
        Permission::create(['name' => 'create-tasks']);
        Permission::create(['name' => 'view-tasks']);
        Permission::create(['name' => 'edit-tasks']);
        Permission::create(['name' => 'delete-tasks']);


        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => 'admin123',
        ]);

        $admin->assignRole('Administrator');

        $manager = User::create([
            'name' => 'Task Manager',
            'email' => 'manager@example.com',
            'password' => 'manager123',
        ]);

        $manager->assignRole('Manager');

        $excludedUserIds = [$admin->id, $manager->id];

        $users = User::whereNotIn('id', $excludedUserIds)->get();

        foreach($users as $user) {
            $user->assignRole('User');
        }
    }
}
