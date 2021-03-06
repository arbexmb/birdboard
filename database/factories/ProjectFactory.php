<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'owner_id' => factory('App\User'),
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'notes' => 'Foobar notes'
    ];
});
