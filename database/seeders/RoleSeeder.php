<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private array $roles = [
        'admin',
        'marielle',
        'vitima'
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}