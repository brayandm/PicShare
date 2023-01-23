<?php

namespace Tests;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $exampleUser;
    protected $examplePerson;

    protected function setUp(): void
    {
        parent::setUp();

        $this->exampleUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'testing@example.com',
        ]);

        $this->examplePerson = Person::where('user_id', $this->exampleUser->id)->first();

        $this->examplePerson->update([
            'is_premium' => true,
            'description' => 'This is a example person',
            'birthdate' => '2000-1-1'
        ]);
    }
}
