<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\RecordType::class, function (Faker $faker) {
    return [
//        'domain_id' => factory(\App\Domain::class)->create()->id,
        'content' => $faker->text
    ];
});
