<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create(['name' => 'developer', 'email' => 'dev@local.com', 'password' => Hash::make('password')]);
        \App\Models\User::factory(50)->create();
        \App\Models\Article::factory(50)->create();
    }
}
