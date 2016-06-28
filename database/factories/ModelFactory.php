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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Money::class, function (Faker\Generator $faker) {
    $datetime = $faker->dateTimeBetween('-30days');
    return [
        'user_id' => null,
        'shop_name' => $faker->name,
        'shop_address' => $faker->streetAddress,
        'shop_tel' => $faker->phoneNumber,
        'use_time' => $datetime,
        'use_date' => $datetime,
        'use_currency' => 'JPY',
        'use_datetime' => $datetime,
        'use_total' => $faker->randomFloat(),
        'read_receipt_data' => $faker->text()
    ];
});
