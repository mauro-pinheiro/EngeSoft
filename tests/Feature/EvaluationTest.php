<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMakeEvaluation()
    {
        $this->withoutExceptionHandling();

        $users = factory(User::class, 4)->create();
        $evaluator = factory(User::class)->create();
        $article = factory(Article::class)->create();

        $this->post('/articles/1/authors', [
            'users' => $users
        ]);
        $response = $this->post('/evaluations', [
            'evaluator' => $evaluator,
            'article' => $article,
            'orignality' => $this->faker->numberBetween(0, 10),
            'content' => $this->faker->numberBetween(0, 10),
            'presentation' => $this->faker->numberBetween(0, 10),
        ]);

        $response->assertOk();
        $this->assertNotNull(Article::find(1)->evaluators);
        $this->assertNotNull(User::find(1)->evaluations);
    }
}
