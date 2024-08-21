<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(6)->create();
        User::factory(20)
            ->has(Post::factory(2)
                ->has(Like::factory(5)
                    ->for(User::factory()))

                ->has(Comment::factory(3)
                    ->for(User::factory())))
            ->has(Subscription::factory()
                ->for($users->random(), 'subscriber'))
            ->create();
        dump($users);
    }
}
