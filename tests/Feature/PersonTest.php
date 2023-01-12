<?php

namespace Tests\Feature;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testFollowPerson()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        Auth::login($user1);

        // $this->post('/profiles/' . $user2->person->id . '/follow');

        $this->assertDatabaseHas('person_person', ['follower_id' => $user1->person->id, 'following_id' => $user2->person->id]);
    }
}
