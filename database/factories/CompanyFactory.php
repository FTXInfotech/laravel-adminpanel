<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name'=>$faker->company,
        'email'=>$faker->unique()->safeEmail,
        'website'=>$faker->url,
        'logo'=>$faker->imageUrl,
        'active'=>rand(0,1)
    ];
});
