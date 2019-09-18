<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ProfessionalPractice;
use App\Role;
use App\User;
use App\Solicitude;
use Faker\Generator as Faker;

$factory->define(ProfessionalPractice::class, function (Faker $faker) {
    return [
        'tutor_id' => factory(User::class)->create([
            'role_id' => Role::tutor()
        ]),
        'solicitude_id' => factory(Solicitude::class)->create(['status' => 'accepted']),
        'status' => 'active'
    ];
});
