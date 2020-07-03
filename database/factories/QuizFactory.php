<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Quiz;
use Faker\Generator as Faker;

$factory->define(Quiz::class, function (Faker $faker) {
    return [
        'question' => $faker->text,
        'answer' => json_encode([
            $faker->sentence(rand(1, 5)), $faker->sentence(rand(1, 5)), $faker->sentence(rand(1, 5)), $faker->sentence(rand(1, 5))
        ]),
        'correct_answer' => 0,
        'parent' => 'materies',
        'parent_id' => rand(1, 5)
    ];
});
