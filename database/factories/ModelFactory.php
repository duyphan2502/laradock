<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(
    App\User::class,
    function (Faker\Generator $faker) {
        static $password;

        return [
            'name'           => $faker->name,
            'email'          => $faker->unique()->safeEmail,
            'password'       => $password ?: $password = bcrypt('secret'),
            'remember_token' => str_random(10),
        ];
    }
);

$factory->define(
    App\Model\FavouriteModel::class,
    function (Faker\Generator $faker) {
        return [
            'token'      => $faker->unique(),
            'channel'    => $faker->numberBetween(100, 200),
            'created_at' => $faker->date('Y-m-d H:i:s'),
        ];
    }
);

$factory->define(
    App\Model\ChannelModel::class,
    function (Faker\Generator $faker) {
        return [
            'name'           => $faker->name,
            'channel_number' => $faker->numberBetween(100, 200),
            'channel_id'     => $faker->numberBetween(1, 20),
            'provider'       => $faker->userName,
        ];
    }
);

$factory->define(
    App\Model\ChannelEventModel::class,
    function (Faker\Generator $faker) {
        return [
            'provider'           => $faker->company,
            'eventID'            => $faker->numberBetween(100, 200),
            'channelId'          => $faker->numberBetween(100, 200),
            'channelStbNumber'   => $faker->numberBetween(100, 200),
            'channelHD'          => $faker->title,
            'channelTitle'       => $faker->title,
            'epgEventImage'      => '',
            'certification'      => $faker->numberBetween(1, 20),
            'displayDateTimeUtc' => $faker->date('Y-m-d H:i:s'),
            'displayDateTime'    => $faker->time('H:i:s'),
            'displayDuration'    => '02:00',
            'siTrafficKey'       => $faker->bankAccountNumber,
            'programmeTitle'     => $faker->title,
            'programmeId'        => '',
            'episodeId'          => $faker->numberBetween(200, 1000),
            'shortSynopsis'      => '',
            'longSynopsis'       => '',
            'actors'             => $faker->randomElement(['Paul', 'Rasham', 'Kok Toong']),
            'genre'              => $faker->randomElement(['Movie', 'Documentary', 'Sports']),
            'subGenre'           => $faker->randomElement(['Personal', 'Professional']),
        ];
    }
);