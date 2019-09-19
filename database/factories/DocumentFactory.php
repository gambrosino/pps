<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Document;
use App\Revision;
use Faker\Generator as Faker;

$factory->define(Document::class, function (Faker $faker) {
    return [
        'revision_id' => factory(Revision::class),
        'title' => $faker->title,
        'path' =>'/public/storage/documents' . $faker->uuid() . 'pdf'
    ];
});
