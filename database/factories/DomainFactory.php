<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Domain::class, function (Faker $faker) {
    return [
        'name' => 'example.com',
        'user_id' => factory(\App\User::class)->create()->id,
        'approved' => false
    ];
});
