<?php

use Faker\Generator as Faker;
use App\Models\BlogTags\BlogTag;
use App\Models\Access\User\User;

$factory->define(BlogTag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'status' => $faker->numberBetween(0,1),
        'created_by' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
