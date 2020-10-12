<?php

use App\Models\Auth\Role;
use Faker\Generator as Faker;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'all' => $faker->randomElement([0, 1]),
        'sort' => $faker->numberBetween(1, 100),
        'status' => $faker->randomElement([0, 1]),
    ];
});
