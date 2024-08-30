<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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
        $users = User::factory(50)->create();
        $categories = Category::factory(5)->create();

        Post::factory(100)->create([
            'user_id' => function () use ($users) {
                return $users->random()->id;
            },
            'category_id' => function () use ($categories) {
                return $categories->random()->id;
            },
        ]);
    }
}
