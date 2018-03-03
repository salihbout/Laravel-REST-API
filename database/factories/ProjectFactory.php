<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'content' => $faker->text(200),
        'likes' => $faker->randomDigit,
        'views' => $faker->randomDigit
    ];
});
