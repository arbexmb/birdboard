<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'owner_id' => function() {
            return factory(App\User::class)->create()->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
