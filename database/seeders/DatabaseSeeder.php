<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Role;
use App\Models\User;
use App\Models\VictimHasChat;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            RoleSeeder::class,
        ]);

        User::factory(5)->create();
        Chat::factory(10)->create();
        Message::factory(20)->create();
    }
}