<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\Permission;
use App\Models\Province;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Role::create([
            'name' => 'admin',
        ]);

//        Permission::create([
//           'name' => 'Manage User',
//        ]);
        $permissions = [
            ['name' => 'Manage Website Settings'],
            ['name' => 'Manage Users'],
            ['name' => 'Manage Roles'],
            ['name' => 'Manage Locations'],
            ['name' => 'Manage Categories'],
            ['name' => 'Manage Products'],
            ['name' => 'Manage Orders'],

//            ['name' => 'Manage Tags'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

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
            'delivery_change' => 0,
            'delivery_status' => 0,
        ]);




//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
