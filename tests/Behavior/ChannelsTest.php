<?php

namespace Tests\Behavior;

use App\Astro\Client;
use App\DTO\AstroChannel;
use App\Model\ChannelEventModel;
use App\Model\ChannelModel;
use App\Services\BroadcastingProvider;
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
        $channels = [
            new AstroChannel(['channelId' => 1, 'channelStbNumber' => 101, 'channelTitle' => 'HBO MY']),
            new AstroChannel(['channelId' => 2, 'channelStbNumber' => 102, 'channelTitle' => 'HBO SG']),
        ];
        $client   = $this->createMock(Client::class);
        $client->method('getServiceName')->willReturn(Client::ASTRO_SERVICE);
        $client->method('getChannels')->willReturn($channels);

        $this->app->instance(
            Client::class,
            $client
        );
        $response = $this->get('/api/channels');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSourceChannels()
    {
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 102, 'name' => 'ASTRO MY', 'provider' => 'ASTRO']
            );

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

        $response->assertStatus(202);
        $this->assertDatabaseHas('favourite_history', ['token' => 'some-token', 'channel' => 102]);
    }

    /**
     * @param $events
     *
     * @dataProvider eventsProvider
     */
    public function testGetChannelEvents($events)
    {
        foreach ($events as $event) {
            factory(ChannelEventModel::class)
                ->create(
                    $event
                );
        }
        $response = $this->get(sprintf('/api/channel/%s/%s', 'ASTRO', 1));
        $response->assertStatus(200);
        $responseEvents = json_decode($response->content(), true);

        static::assertCount(2, $responseEvents['data'], 'Must response 2 items');
    }

    public function eventsProvider()
    {
        return [
            '#1' => [
                'events' => [
                    [
                        'provider'           => 'ASTRO',
                        'eventID'            => 24518396,
                        'channelId'          => 1,
                        'channelStbNumber'   => '411',
                        'channelHD'          => false,
                        'channelTitle'       => 'HBO SG',
                        'epgEventImage'      => '',
                        'certification'      => '18',
                        'displayDateTimeUtc' => '2017-02-01 16:15:00.0',
                        'displayDateTime'    => '2017-02-02 00:15:00.0',
                        'displayDuration'    => '02:30:00',
                        'siTrafficKey'       => '1:998:29914081',
                    ],
                    [
                        'provider'           => 'ASTRO',
                        'eventID'            => 24518397,
                        'channelId'          => 1,
                        'channelStbNumber'   => '411',
                        'channelHD'          => true,
                        'channelTitle'       => 'HBO MY',
                        'certification'      => '18',
                        'displayDateTimeUtc' => '2017-02-01 16:15:00.0',
                        'displayDateTime'    => '2017-02-02 00:15:00.0',
                        'displayDuration'    => '02:30:00',
                        'siTrafficKey'       => '1:998:29914081',
                        'programmeId'        => 120891,
                    ],
                    [
                        'provider'           => 'NETFLIX',
                        'eventID'            => 24518390,
                        'channelId'          => 2,
                        'channelStbNumber'   => '411',
                        'channelHD'          => true,
                        'channelTitle'       => 'SPORT FLIX',
                        'certification'      => '18',
                        'displayDateTimeUtc' => '2017-02-01 16:15:00.0',
                        'displayDateTime'    => '2017-02-02 00:15:00.0',
                        'displayDuration'    => '02:30:00',
                        'siTrafficKey'       => '1:998:29914081',
                        'programmeId'        => 120891,
                    ],
                ],
            ],
        ];
    }
}
