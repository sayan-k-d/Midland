<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Super-Admin', 'description' => 'Super-Administrator with full access'],
            ['name' => 'Admin', 'description' => 'Admin with limited access'],
            ['name' => 'User', 'description' => 'Regular user access'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
