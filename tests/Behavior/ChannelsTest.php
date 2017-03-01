<?php

namespace Tests\Behavior;

use App\Model\ChannelModel;
use Tests\TestCase;

class ChannelsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAPIChannels()
    {
        $response = $this->get('/api/channels');

        $response->assertStatus(200);
    }

    public function testFavouriteAPI()
    {
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 102, 'name' => 'ASTRO MY', 'provider' => 'ASTRO']
            );
        $response = $this->post('/api/channel', ['token' => 'some-token', 'channel' => 102]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('favourite_history', ['token' => 'some-token', 'channel' => 102]);
    }
}
