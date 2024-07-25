<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Permission;
use App\Models\Province;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];
        foreach ($roles as $role) {
            Role::create($role);
        }

//        Permission::create([
//           'name' => 'Manage User',
//        ]);
        $permissions = [
            ['name' => 'Manage Website Settings'],
            ['name' => 'Manage Roles'],
            ['name' => 'Manage Staff'],
            ['name' => 'Manage Users'],
            ['name' => 'Manage Locations'],
            ['name' => 'Manage Categories'],
            ['name' => 'Manage Products'],
            ['name' => 'Manage Orders'],
//            ['name' => 'Manage Tags'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        $rolePermissions = [
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
            ['role_id' => 1, 'permission_id' => 7],
            ['role_id' => 1, 'permission_id' => 8],
        ];
        RolePermission::create([
            'role_id' => 1,
            'permission_id' => 1,
        ]);

        Province::create([
            'name'=>'Bagmati'
        ]);



        District::create([
            'name' => 'Kathmandu',
            'province_id' => 1
        ]);

        City::create([
            'name' => 'Kathmandu',
            'district_id' => 1,
            'delivery_charge' => 0,
            'delivery_status' => 0,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);
    }
}
