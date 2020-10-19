<?php

use App\Models\Auth\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    $name = $faker->name();

    return [
        'name' => $name,
        'display_name' => $name,
        'sort' => $faker->numberBetween(1, 100),
        'status' => $faker->randomElement([0, 1]),
    ];
});
