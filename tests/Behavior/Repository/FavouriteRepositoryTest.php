<?php
namespace Tests\Behavior;

use App\Repository\FavouriteRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Class FavouriteRepositoryTest
 *
 * @package Tests\Behavior
 * @covers  \App\Repository\FavouriteRepository
 * @covers  \App\Model\FavouriteModel
 */
class FavouriteRepositoryTest extends TestCase
{
    /**
     * @param $token
     * @param $channel
     *
     * @dataProvider getDataProvider
     */
    public function testSaveHistory($token, $channel)
    {
        /**
         * @var $repo FavouriteRepository
         */
        $repo = app(FavouriteRepository::class);

        $repo->saveHistory($token, $channel);

        $this->assertDatabaseHas('favourite_history', ['token' => $token, 'channel' => $channel]);
    }

    public function getDataProvider()
    {
        return [
            '#1' => [
                'token'   => uniqid('first_', false),
                'channel' => 101,
            ],
            '#2' => [
                'token'   => uniqid('first_', false),
                'channel' => 102,
            ],
        ];
    }
}
