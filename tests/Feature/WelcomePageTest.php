<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use DatabaseMigrations;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testWelcomePage()
    {
        //EXECUTION
        $response = $this->get(route('welcome'));

        //ASSERTION
        $response->assertSee('Log in');
        $response->assertSee('Register');
        $response->assertDontSee('Dashboard');
    }

    public function testWelcomePageLogIn()
    {
        //PREPARATION
        $this->actingAs($this->exampleUser);

        //EXECUTION
        $response = $this->get(route('welcome'));

        //ASSERTION
        $response->assertDontSee('Log in');
        $response->assertDontSee('Register');
        $response->assertSee('Dashboard');
    }
}
