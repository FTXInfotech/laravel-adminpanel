<?php

use App\Models\Access\Permission\Permission;
use Faker\Generator;

/*
 * Permissions
 */

$factory->define(Permission::class, function (Generator $faker) {
    $name = $faker->word;

    return [
        'name'          => $name,
        'display_name'  => $name,
        'sort'          => $faker->numberBetween(1, 100),
    ];
});

$factory->state(Permission::class, 'active', function () {
    return [
        'status' => 1,
    ];
});

$factory->state(Permission::class, 'inactive', function () {
    return [
        'status' => 0,
    ];
});
