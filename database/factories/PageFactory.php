<?php

use App\Models\Page\Page;
use Faker\Generator as Faker;
use App\Models\Access\User\User;

$factory->define(Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title'       => $title,
        'page_slug'   => str_slug($title),
        'description' => $faker->paragraph,
        'created_by' => function () {
            return factory(User::class)->create()->id;
        },
    ];
});
