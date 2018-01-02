<?php

use App\Models\Access\Role\Role;
use Faker\Generator;

/*
 * Roles
 */
$factory->define(Role::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'all'  => 0,
        'sort' => $faker->numberBetween(1, 100),
    ];
});

$factory->state(Role::class, 'admin', function () {
    return [
        'all' => 1,
    ];
});

$factory->state(Role::class, 'active', function () {
    return [
        'status' => 1,
    ];
});

$factory->state(Role::class, 'inactive', function () {
    return [
        'status' => 0,
    ];
});
