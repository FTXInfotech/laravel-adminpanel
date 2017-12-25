<?php

use App\Models\Page\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'title'       => $title,
        'page_slug'   => str_slug($title),
        'description' => $faker->paragraph,
        'created_by'  => 1,
    ];
});
