<?php
use App\Project;
use App\User;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {

    $user = User::all()->random();

    return [
        'title' => $faker->text(50),
        'content' => $faker->text(200),
        'likes' => $faker->randomDigit,
        'views' => $faker->randomDigit,
        'user_id' => $user->id
    ];
});
 