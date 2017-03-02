<?php
namespace Tests\Behavior;

use App\DTO\ChannelEvent;
use App\Model\ChannelModel;
use App\Repository\ChannelRepository;
use App\Services\ChannelInterface;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Class ChannelRepositoryTest
 *
 * @package Tests\Behavior
 * @covers  \App\Repository\ChannelRepository
 * @covers  \App\Model\ChannelModel
 */
class ChannelRepositoryTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    /**
     * @var ChannelRepository
     */
    private $repo;

    protected function setUp()
    {
        parent::setUp();
        /**
         * @var $repo ChannelRepository
         */
        $this->repo = app(ChannelRepository::class);
    }

    /**
     * @param $id
     * @param $name
     * @param $number
     * @param $provider
     *
     * @dataProvider getProviders
     */
    public function testSaveChannel($id, $name, $number, $provider)
    {
        $mockChannel = $this->createMock(ChannelInterface::class);
        $mockChannel->method('getName')->willReturn($name);
        $mockChannel->method('getNumber')->willReturn($number);
        $mockChannel->method('getChannelId')->willReturn($id);

        $this->repo->saveChannel($mockChannel, $provider);
        $this->assertDatabaseHas(
            'channels',
            [
                'name'           => $name,
                'channel_number' => $number,
                'channel_id'     => $id,
                'provider'       => $provider,
            ]
        );
    }

    public function testGetChannels()
    {
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 102, 'name' => 'ASTRO MY', 'provider' => 'ASTRO_CO', 'channel_id' => 1]
            );
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 103, 'name' => 'ASTRO SG', 'provider' => 'ASTRO_CO', 'channel_id' => 2]
            );
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 101, 'name' => 'NETFLIX USA', 'provider' => 'NEFL', 'channel_id' => 3]
            );
        $result = $this->repo->getChannels('ASTRO_CO');
        static::assertCount(2, $result, 'Must have only one');
        $result = $this->repo->getChannels('NEFL');
        static::assertCount(1, $result, 'Must have only one');
        foreach ($result as $item) {
            static::assertEquals('NEFL', $item->getProvider());
            static::assertEquals('NETFLIX USA', $item->getName());
            static::assertEquals(101, $item->getNumber());
        }
    }

    public function testSaveEvent()
    {
        $data  = [
            'provider'           => 'ASTRO',
            'eventID'            => 24518396,
            'channelId'          => 1,
            'channelStbNumber'   => '411',
            'channelHD'          => false,
            'channelTitle'       => 'HBO',
            'epgEventImage'      => '',
            'certification'      => '18',
            'displayDateTimeUtc' => '2017-02-01 16:15:00.0',
            'displayDateTime'    => '2017-02-02 00:15:00.0',
            'displayDuration'    => '02:30:00',
            'siTrafficKey'       => '1:998:29914081',
            'programmeTitle'     => '',
            'programmeId'        => '120890',
            'episodeId'          => '',
            'shortSynopsis'      => '',
            'longSynopsis'       => '',
            'actors'             => '',
            'directors'          => '',
            'producers'          => '',
            'genre'              => 'Movie',
            'subGenre'           => 'Action',
            'live'               => false,
            'premier'            => false,
            'ottBlackout'        => false,
            'highlight'          => false,
            'contentId'          => '',
            'contentImage'       => '',
            'groupKey'           => '',
        ];
        $event = new ChannelEvent($data);
        $this->repo->saveEvent($event->getData());

        $this->assertDatabaseHas('channel_events', ['provider' => 'ASTRO', 'channelId' => $data['channelId']]);
    }

    public function getProviders()
    {
        return [
            '#1' => [
                'id'       => 1,
                'name'     => 'ASTRO MY',
                'number'   => 200,
                'provider' => 'ASTRO',
            ],
            '#2' => [
                'id'       => 1,
                'name'     => 'NETFLIX',
                'number'   => 201,
                'provider' => 'NFLIX',
            ],
        ];
    }
}