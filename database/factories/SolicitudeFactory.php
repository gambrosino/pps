<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Role;
use App\User;
use App\Solicitude;
use Faker\Generator as Faker;

$factory->define(Solicitude::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(['role_id' => Role::student()]),
        'status' => $faker->sentence(),
        'description' => $faker->paragraph(),
        'path' => '/solicitude/test.pdf'
    ];
});
