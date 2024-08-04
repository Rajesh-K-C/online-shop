<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        $user = User::factory()->create([
//            'name' => 'Admin',
//            'email' => 'admin@example.com',
//            'password' => Hash::make('password'),
//        ]);
//        Permission::create(['name' => 'manage-setting']);
//        Permission::create(['name' => 'update-order-status']);
//        Permission::create(['name' => 'manage-product']);
//        Permission::create(['name' => 'manage-category']);
//        Permission::create(['name' => 'update-payment-status']);
//        $role = Role::create(['name' => 'admin']);
//        $role->givePermissionTo(Permission::all());
//        Permission::create(['name' => 'order']);
//        $role2 = Role::create(['name' => 'user']);
//        $role2->givePermissionTo('order');
//        $user->syncRoles(['admin']);
//        $user2 = User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//            'password' => Hash::make('password'),
//        ]);
//        $user2->assignRole('user');
//        Setting::create([
//            'setting_name' => 'test',
//            'website_name' => 'My Website',
//            'favicon' => '1722402656_favicon.png',
//            'logo' => '1722402656_logo.jpg',
//            'phone' => '+977 01-555556',
//            'email' => 'mywebsite@gmail.com',
//            'address' => 'KTM',
//            'facebook_link' => 'https://www.facebook.com/rajeshkc.official',
//            'instagram_link' => 'https://www.instagram.com/kc4156/',
//            'youtube_link' => 'https://www.youtube.com/@rajesh-kc',
//            'opening_hours' => 'Sunday - Friday, 6 AM - 9 PM',
//            'status' => 1,
//            'created_by' => $user->id,
//        ]);
    }
}
