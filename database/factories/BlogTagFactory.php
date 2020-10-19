<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogTag;
use App\Models\Auth\User;
use Faker\Generator as Faker;

$factory->define(BlogTag::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'status' => $faker->boolean,
        'created_by' => function () {
            return factory(User::class)->state('active')->create()->id;
        },
    ];
});
