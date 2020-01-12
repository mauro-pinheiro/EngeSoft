<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\Edition;
use App\Submission;
use Faker\Generator as Faker;

$factory->define(Submission::class, function (Faker $faker) {
    return [
        'number' => $faker->randomNumber(),
        'status' => $faker->randomElement([
            'I',        //Incompleto
            'P',        //Pendente
            'A',        //Avalidado
            'S'         //Selecionado
        ]),
        'article_id' => factory(Article::class)->create()->id,
        'edtion_id' => factory(Edition::class)->create()->id,
        'user_id' => factory(User::class)->create()->id
    ];
});
