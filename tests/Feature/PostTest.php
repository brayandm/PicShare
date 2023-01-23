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
        //PREPARATION
        $this->actingAs($this->exampleUser);

        $post = Post::factory()->create([
            'header' => 'This is a header',
            'text' => 'This is a text',
            'person_id' => $this->examplePerson->id,
        ]);

        //EXECUTION
        $response = $this->get(route('myposts.show'));

        //ASSERTION
        $response->assertSee('myposts');
        $response->assertSee($post->header);
        $response->assertSee($post->text);
        $response->assertSee($this->exampleUser->name);
    }

    public function testCreateMyPosts()
    {
        //PREPARATION
        $this->actingAs($this->exampleUser);

        //EXECUTION
        $response = $this->post(route('myposts.store'), [
            'header' => 'This is a header',
            'text' => 'This is a text',
            'tags' => 'testing, myposts, picshare',
        ]);

        //ASSERTION
        $this->assertDatabaseHas('posts', [
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header',
            'text' => 'This is a text',
        ]);
    }
}
