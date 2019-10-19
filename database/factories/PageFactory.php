<?php

use App\Models\Access\User\User;
use App\Models\Page\Page;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Page::class, function (Faker $faker) {
    $title = $faker->sentence;

    $newestPage = Page::orderBy('id', 'desc')->first();

    return [
        'title'           => $title,
        'page_slug'       => Str::slug($title),
        'description'     => $faker->paragraph,
        'cannonical_link' => 'http://localhost:8000/'.Str::slug($title),
        'created_by'      => function () {
            return factory(User::class)->create()->id;
        },
        'status'      => 1,
        'created_at'  => Carbon\Carbon::now(),
        'updated_at'  => Carbon\Carbon::now(),
    ];
});
