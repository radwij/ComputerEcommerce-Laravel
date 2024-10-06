<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Role for admins
        $ownerRole = Role::create([
            'name' => 'owner'
        ]);

        // Role for buyer
        $buyerRole = Role::create([
            'name' => 'buyer'
        ]);


        // Creating a superadmin
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);

        $user -> assignRole($ownerRole);
    }
}
