<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'user',
            'email' => 'user@mail.com',
            'password' => bcrypt('password')
        ]);

        Product::create([
            'category_id' => 1,
            'name' => 'Sweeter',
            'slug' => 'sweeter',
            'price' => 100000,
            'stock' => 10,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.',
            'image' => 'https://via.placeholder.com/200x250'
        ]);

        Category::create([
            'name' => 'clothing',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.'
        ]);

        Order::create([
            'user_id' => 1,
            'order_number' => 1,
            'status' => 'sedang diproses',
            'total_price' => 100000
        ]);
    }
}