<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=RestaurantTypeSeeder
     */
    public function run(): void
    {
        $categories = [
            [
                'type' => 'International',
                'slug' => 'international',
                'description' =>''
            ],
            [
                'type' => 'Breakfast',
                'slug' => 'breakfast',
                'description' =>''
            ],
            [
                'type' => 'Pastries',
                'slug' => 'pastries',
                'description' =>''
            ],
            [
                'type' => 'Shawarma',
                'slug' => 'shawarma',
                'description' =>''
            ],
            [
                'type' => 'Vegeterian',
                'slug' => 'vegeterian',
                'description' =>''
            ],
            [
                'type' => 'Bakery and Pastry',
                'slug' => 'bakery-and-pastry',
                'description' =>''
            ],
            [
                'type' => 'Grill',
                'slug' => 'grill',
                'description' =>''
            ],
            [
                'type' => 'Pasta',
                'slug' => 'pasta',
                'description' =>''
            ],
            [
                'type' => 'Nigerian',
                'slug' => 'nigerian',
                'description' =>''
            ],
            [
                'type' => 'Snacks',
                'slug' => 'snacks',
                'description' =>''
            ],
            [
                'type' => 'Pizza',
                'slug' => 'pizza',
                'description' =>''
            ],
            [
                'type' => 'Juices',
                'slug' => 'juices',
                'description' =>''
            ],
            [
                'type' => 'Desserts',
                'slug' => 'desserts',
                'description' =>''
            ],
            [
                'type' => 'Burgers',
                'slug' => 'burgers',
                'description' =>''
            ],
            [
                'type' => 'Jollof',
                'slug' => 'jollof',
                'description' =>''
            ],
            [
                'type' => 'Chicken',
                'slug' => 'chicken',
                'description' =>''
            ],
            [
                'type' => 'Local',
                'slug' => 'local',
                'description' =>''
            ],
            [
                'type' => 'Seafood',
                'slug' => 'seafood',
                'description' =>''
            ],
            [
                'type' => 'Fastfood',
                'slug' => 'fastfood',
                'description' =>''
            ],
            [
                'type' => 'Others',
                'slug' => 'others',
                'description' =>''
            ],
        ];

        // Insert records into the database
        DB::table('restaurant_types')->insert($categories);
    }
}
