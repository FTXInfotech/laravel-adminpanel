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
