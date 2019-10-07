<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Task::class, function (Faker $faker) {

    $typeDet = $faker->boolean();

    return [
        "type" => $typeDet ? 'practice' : 'theory',
        "body" => ($typeDet ? "Izracunati: " : "Napisati:" ) . $faker->paragraph
    ];
});
