<?php
namespace Tests\Behavior;

use App\Model\ChannelModel;
use App\Repository\ChannelRepository;
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
     * @param $name
     * @param $number
     * @param $provider
     *
     * @dataProvider getProviders
     */
    public function testSaveChannel($name, $number, $provider)
    {
        $this->repo->saveChannel($name, $number, $provider);
        $this->assertDatabaseHas('channels', ['name' => $name, 'channel_number' => $number, 'provider' => $provider]);
    }

    public function testGetChannels()
    {
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 102, 'name' => 'ASTRO MY', 'provider' => 'ASTRO']
            );
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 103, 'name' => 'ASTRO SG', 'provider' => 'ASTRO']
            );
        factory(ChannelModel::class)
            ->create(
                ['channel_number' => 101, 'name' => 'NETFLIX USA', 'provider' => 'NEFL']
            );
        $result = $this->repo->getChannels('ASTRO');
        static::assertCount(2, $result, 'Must have only one');
        $result = $this->repo->getChannels('NEFL');
        static::assertCount(1, $result, 'Must have only one');
        foreach ($result as $item) {
            static::assertEquals('NEFL', $item->getProvider());
            static::assertEquals('NETFLIX USA', $item->getName());
            static::assertEquals(101, $item->getNumber());
        }
    }

    public function getProviders()
    {
        return [
            '#1' => [
                'name'     => 'ASTRO MY',
                'number'   => 101,
                'provider' => 'ASTRO',
            ],
            '#2' => [
                'name'     => 'NETFLIX',
                'number'   => 102,
                'provider' => 'NFLIX',
            ],
        ];
    }
}