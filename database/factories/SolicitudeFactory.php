<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Solicitude;
use App\User;
use Faker\Generator as Faker;

$factory->define(Solicitude::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'status' => $faker->sentence(),
        'description' => $faker->paragraph()
    ];
});
