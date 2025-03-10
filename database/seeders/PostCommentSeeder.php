<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class InstagramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear previous data
        Post::truncate();
        Comment::truncate();
        DB::table('post_likes')->truncate(); // Assuming you're using a pivot table for likes

        // Create users if they don't exist
        if (User::count() < 10) {
            User::factory(10)->create();
        }

        $users = User::all();

        // Create posts
        $posts = [];
        for ($i = 1; $i <= 20; $i++) {
            $posts[] = [
                'user_id' => $users->random()->id,
                'caption' => 'This is an Instagram post caption #' . $i . '. ' . fake()->paragraph(),
                'image_path' => 'posts/post_' . $i . '.jpg', // Images need to be stored in storage
                'created_at' => fake()->dateTimeBetween('-30 days', 'now'),
                'updated_at' => now(),
            ];
        }

        // Insert posts in batches
        foreach (array_chunk($posts, 5) as $chunk) {
            Post::insert($chunk);
        }

        // Get all posts and add comments and likes
        $allPosts = Post::all();

        // Add comments
        $comments = [];
        foreach ($allPosts as $post) {
            $commentCount = rand(0, 15);

            for ($i = 0; $i < $commentCount; $i++) {
                $comments[] = [
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'content' => fake()->sentence(rand(3, 15)),
                    'created_at' => fake()->dateTimeBetween($post->created_at, 'now'),
                    'updated_at' => now(),
                ];
            }
        }

        // Insert comments in batches
        foreach (array_chunk($comments, 10) as $chunk) {
            Comment::insert($chunk);
        }

        // Add likes
        foreach ($allPosts as $post) {
            $likeCount = rand(0, $users->count());
            $likers = $users->random($likeCount);

            foreach ($likers as $liker) {
                $post->likes()->attach($liker->id, ['created_at' => now(), 'updated_at' => now()]);
            }
        }

        // This placeholder tells you to actually add images to storage
        $this->command->info('Remember to add actual images to the storage/app/public/posts directory');
    }
}
