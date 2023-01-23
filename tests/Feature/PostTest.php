<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Tag;
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

        $tag1 = Tag::factory()->create(['keyword' => 'testing']);
        $tag2 = Tag::factory()->create(['keyword' => 'myposts']);
        $tag3 = Tag::factory()->create(['keyword' => 'picshare']);

        $post->tags()->sync([$tag1->id, $tag2->id, $tag3->id]);

        //EXECUTION
        $response = $this->get(route('myposts.show'));

        //ASSERTION
        $response->assertSee('myposts');
        $response->assertSee($post->header);
        $response->assertSee($post->text);
        $response->assertSee($this->exampleUser->name);
        $response->assertSee('testing');
        $response->assertSee('myposts');
        $response->assertSee('picshare');
    }

    public function testCreateMyPosts()
    {
        //PREPARATION
        $this->actingAs($this->exampleUser);

        $tag1 = Tag::factory()->create(['keyword' => 'testing']);
        $tag2 = Tag::factory()->create(['keyword' => 'myposts']);
        $tag3 = Tag::factory()->create(['keyword' => 'picshare']);

        //EXECUTION
        $response = $this->post(route('myposts.store'), [
            'header' => 'This is a header',
            'text' => 'This is a text',
            'tags' => $tag1->keyword . ', ' . $tag2->keyword . ', ' . $tag3->keyword,
        ]);

        //ASSERTION
        $this->assertDatabaseHas('posts', [
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header',
            'text' => 'This is a text',
        ]);

        $post = Post::find([
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header',
            'text' => 'This is a text'
        ])->first();

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag1->id,
        ]);
        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag2->id,
        ]);
        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag3->id,
        ]);
    }

    public function testUpdateMyPosts()
    {
        //PREPARATION
        $this->actingAs($this->exampleUser);

        $tag1 = Tag::factory()->create(['keyword' => 'testing']);
        $tag2 = Tag::factory()->create(['keyword' => 'myposts']);
        $tag3 = Tag::factory()->create(['keyword' => 'picshare']);
        $tag4 = Tag::factory()->create(['keyword' => 'updated']);

        $post = Post::factory()->create([
            'header' => 'This is a header',
            'text' => 'This is a text',
            'person_id' => $this->examplePerson->id,
        ]);

        $post->tags()->sync([$tag1->id, $tag2->id, $tag3->id]);

        //EXECUTION
        $response = $this->put(route('myposts.update', ['id' => $post->id]), [
            'header' => 'This is a header updated',
            'text' => 'This is a text updated',
            'tags' => 'testing, updated',
        ]);

        //ASSERTION
        $this->assertDatabaseMissing('posts', [
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header update',
            'text' => 'This is a text update',
        ]);

        $this->assertDatabaseHas('posts', [
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header updated',
            'text' => 'This is a text updated',
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag1->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag2->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag3->id,
        ]);

        $this->assertDatabaseHas('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag4->id,
        ]);
    }

    public function testDeleteMyPosts()
    {
        //PREPARATION
        $this->actingAs($this->exampleUser);

        $tag1 = Tag::factory()->create(['keyword' => 'testing']);
        $tag2 = Tag::factory()->create(['keyword' => 'myposts']);
        $tag3 = Tag::factory()->create(['keyword' => 'picshare']);

        $post = Post::factory()->create([
            'header' => 'This is a header',
            'text' => 'This is a text',
            'person_id' => $this->examplePerson->id,
        ]);

        $post->tags()->sync([$tag1->id, $tag2->id, $tag3->id]);

        //EXECUTION
        $response = $this->delete(route('myposts.delete', ['id' => $post->id]));

        //ASSERTION
        $this->assertDatabaseMissing('posts', [
            'person_id' => $this->examplePerson->id,
            'header' => 'This is a header',
            'text' => 'This is a text',
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag1->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag2->id,
        ]);

        $this->assertDatabaseMissing('post_tag', [
            'post_id' => $post->id,
            'tag_id' => $tag3->id,
        ]);
    }
}
