<?php

use Faker\Generator as Faker;
use App\Comment;
use App\User;
use App\Project;


$factory->define(Comment::class, function (Faker $faker) {
    $user = User::all()->random();
    $project = Project::all()->random();
    return [
        'body' => $faker->text(50),
        'likes' => $faker->randomDigit,
        'user_id' => $user->id,
        'project_id' => $project->id
    ];
});
