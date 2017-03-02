<?php

namespace Tests\Astro;

use App\DTO\ChannelEvent;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testGetChannel()
    {
        $guzzleClient = $this->createMock(Client::class);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(
                '{
                    "responseMessage": "Success",
                    "responseCode": "200",
                    "channels": [
                        {
                            "channelId": 1,
                            "channelTitle": "HBO",
                            "channelStbNumber": 412
                        },
                        {
                            "channelId": 2,
                            "channelTitle": "HBO MY",
                            "channelStbNumber": 411
                        }
                        ]
                    }'
            );
        $guzzleClient
            ->expects(static::once())
            ->method('send')
            ->withAnyParameters()
            ->willReturn($response);

        $client   = new \App\Astro\Client($guzzleClient, 'http://astro.api.endpoint');
        $channels = $client->getChannels();
        static::assertCount(2, $channels);
    }

    /**
     * @dataProvider eventsProvider
     */
    public function testGetEvents($events)
    {
        $guzzleClient = $this->createMock(Client::class);

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')
            ->willReturn(
                '{
                    "responseMessage": "Success",
                    "responseCode": "200",
                    "getevent": '.json_encode($events).'
                    }'
            );
        $guzzleClient
            ->expects(static::once())
            ->method('send')
            ->withAnyParameters()
            ->willReturn($response);

        $client = new \App\Astro\Client($guzzleClient, 'http://astro.api.endpoint');
        /**
         * @var $channels ChannelEvent[]
         */
        $channels = $client->getChannelEvents(1);
        foreach ($channels as $key => $channel) {
            $outPut = $channel->getData();
            static::assertArraySubset($events[$key], $outPut);
        }
        static::assertCount(2, $channels);
    }


    public function eventsProvider()
    {
        return [
            '#1' => [
                'events' => [
                    [
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
                ],
            ],
        ];
    }
}
