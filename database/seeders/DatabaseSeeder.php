<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
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
        // Users & products
        $user = \App\Models\User::factory()->create([
            'name' => 'Sob Ng',
            'email' => 'son@gmail.com',
            'password' => 'sob123'
        ]);
        \App\Models\Product::factory(3)->create([
            'user_id' => $user->id,
            'categories' => 'Men, Kid, Computer'
        ]);


        $user02 = \App\Models\User::factory()->create([
            'name' => 'Troll Warrior',
            'email' => 'emailtrol@gmail.com',
            'password' => 'sob123'
        ]);
        \App\Models\Product::factory(5)->create([
            'user_id' => $user02->id,
            'categories' => 'Women, Clothes, Accessories'
        ]);

        // Categories
        Category::factory()->create(['name' => 'Men']);
        Category::factory()->create(['name' => 'Women']);
        Category::factory()->create(['name' => 'Clothes']);
        Category::factory()->create(['name' => 'Accessories']);
        Category::factory()->create(['name' => 'Kid']);
        Category::factory()->create(['name' => 'Computer']);
    }
}
