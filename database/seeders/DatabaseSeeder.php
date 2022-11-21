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
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'is_admin' => true,
        ]);

        $exampleUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $users = \App\Models\User::factory(5)->create();

        \App\Models\Post::factory(3)->create([
            'person_id' => $exampleUser->person->id,
        ]);

        \App\Models\Tag::factory(20)->create();

        foreach ($users as $user) {
            \App\Models\Post::factory()->create([
                'person_id' => $user->person->id,
            ]);
        }

        $posts = \App\Models\Post::all();

        $tags = \App\Models\Tag::all()->toArray();

        foreach ($posts as $post) {
            shuffle($tags);

            $amount = rand(0, 5);

            for ($i = 0; $i < $amount; $i++) {
                $post->tags()->attach($tags[$i]['id']);
            }
        }

        $people = \App\Models\Person::all();

        for ($i = 0; $i < 15; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $post = $posts[rand(0, count($posts) - 1)];

            \App\Models\Comment::factory()->create([
                'person_id' => $person->id,
                'post_id' => $post->id,
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $comments = \App\Models\Comment::all();

            $comment = $comments[rand(0, count($comments) - 1)];

            \App\Models\Comment::factory()->create([
                'person_id' => $person->id,
                'comment_id' => $comment->id,
            ]);
        }

        for ($i = 0; $i < 25; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $post = $posts[rand(0, count($posts) - 1)];

            if (! $post->likedPeople()->pluck('person_id')->contains($person->id)) {
                $post->likedPeople()->attach($person);
                $post->likes++;
                $post->save();
            }
        }
    }
}
