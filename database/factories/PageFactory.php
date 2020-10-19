<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auth\User;
use App\Models\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        'title' => $faker->words(4, true),
        'page_slug' => $faker->slug,
        'description' => $faker->paragraph,
        'cannonical_link' => $faker->url,
        'seo_title' => $faker->word,
        'seo_keyword' => $faker->word,
        'seo_description' => $faker->paragraph,
        'status' => $faker->boolean,
        'created_by' => function () {
            return factory(User::class)->state('active')->create()->id;
        },
    ];
});
