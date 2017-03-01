<?php

namespace Tests\Behavior;

use Tests\TestCase;

class HomeHttpTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        $response->assertSee('Channels');
    }
}
