<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Sob Ng',
            'email' => 'son@gmail.com',
            'password' => 'sob123'
        ]);
        \App\Models\Product::factory(3)->create([
            'user_id' => $user->id
        ]);
    }
}
