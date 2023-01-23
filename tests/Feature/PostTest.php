<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testGetMyPosts()
    {
        $this->actingAs($this->exampleUser);

        $post = Post::factory()->create([
            'header' => 'This is a header',
            'text' => 'This is a text',
            'person_id' => $this->examplePerson->id,
        ]);

        $response = $this->get(route('myposts.show'));

        $response->assertSee('myposts');
        $response->assertSee($post->header);
        $response->assertSee($post->text);
        $response->assertSee($this->exampleUser->name);
    }
}
