<?php

namespace Tests\Astro;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testSendRequest()
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
}
