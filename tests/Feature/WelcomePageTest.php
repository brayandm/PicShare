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
    }
}
