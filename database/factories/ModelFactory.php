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
            'name'     => $faker->name,
            'channel_number'   => $faker->numberBetween(100, 200),
            'provider' => $faker->userName,
        ];
    }
);