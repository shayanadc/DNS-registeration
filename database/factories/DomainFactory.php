<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Domain::class, function (Faker $faker) {
    return [
        'name' => 'example.com'
    ];
});
