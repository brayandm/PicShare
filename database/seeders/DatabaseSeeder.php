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
            'email' => 'brayanduranmedina@gmail.com',
            'is_admin' => true,
        ]);

        $exampleUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $weatherUser = \App\Models\User::factory()->create([
            'name' => 'Weather User',
            'email' => 'weather@example.com',
        ]);

        \App\Models\User::factory(10)->create();

        foreach (\App\Models\User::all() as $user) {
            if(!$user->is_admin)
            {
                $user->person()->delete();
            }
        }

        foreach (\App\Models\User::all() as $user) {
            if(!$user->is_admin)
            {
                \App\Models\Person::factory()->create([
                    'user_id' => $user,
                ]);
            }
        }

        \App\Models\Person::where('user_id', $exampleUser->id)->first()->update([
            'is_premium' => false,
            'description' => 'This is a test user',
            'birthdate' => '2000-1-1'
        ]);

        \App\Models\Person::where('user_id', $weatherUser->id)->first()->update([
            'is_premium' => true,
            'description' => 'This is a weather service',
            'birthdate' => '2000-1-1'
        ]);

        $people = \App\Models\Person::all();

        \App\Models\Post::factory(3)->create([
            'person_id' => $exampleUser->person->id,
        ]);

        foreach ($people as $person) {
            $amount = rand(0, 3);

            for ($i = 0; $i < $amount; $i++) {
                \App\Models\Post::factory()->create([
                    'person_id' => $person->id,
                ]);
            }
        }

        \App\Models\Tag::factory(10)->create();

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

        for ($i = 0; $i < 30; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $post = $posts[rand(0, count($posts) - 1)];

            \App\Models\Comment::factory()->create([
                'person_id' => $person->id,
                'post_id' => $post->id,
            ]);
        }

        for ($i = 0; $i < 40; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $comments = \App\Models\Comment::all();

            $comment = $comments[rand(0, count($comments) - 1)];

            \App\Models\Comment::factory()->create([
                'person_id' => $person->id,
                'comment_id' => $comment->id,
            ]);
        }

        for ($i = 0; $i < 50; $i++) {
            $person = $people[rand(0, count($people) - 1)];

            $post = $posts[rand(0, count($posts) - 1)];

            if (! $post->likedPeople()->pluck('person_id')->contains($person->id)) {
                $post->likedPeople()->attach($person);
                $post->likes++;
                $post->save();
            }
        }

        foreach ($people as $person1) {
            foreach ($people as $person2) {
                if ($person1->id != $person2->id) {
                    if (! rand(0, 2)) {
                        $person1->followings()->attach($person2->id);
                    }
                }
            }
        }
    }
}
