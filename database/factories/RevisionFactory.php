<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Revision;
use App\ProfessionalPractice;
use Faker\Generator as Faker;

$factory->define(Revision::class, function (Faker $faker) {
    return [
        'professional_practice_id' => factory(ProfessionalPractice::class),
        'description' => $faker->paragraph
    ];
});
