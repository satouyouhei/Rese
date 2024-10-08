<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminShopUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $masterPermission = Permission::create(['name' => 'master']);
        $editorPermission = Permission::create(['name' => 'editor']);

        Role::create(['name' => 'admin'])
            ->givePermissionTo($masterPermission);
        Role::create(['name' => 'shop'])
            ->givePermissionTo($editorPermission);

        User::create([
            'name' => '管理者',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('admin');

        User::create([
            'name' => '店舗管理者',
            'email' => 'shop@shop.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ])->assignRole('shop');

        User::create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        User::factory()->count(47)->create();
    }
}