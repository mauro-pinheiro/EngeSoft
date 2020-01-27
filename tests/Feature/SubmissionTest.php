<?php

namespace Tests\Feature;

use App\Article;
use App\Edition;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubmissionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testMakeSubmission()
    {
        $this->withoutExceptionHandling();
        $users = factory(User::class, 4)->create();
        $article = factory(Article::class)->create();
        $edition = factory(Edition::class)->create();

        $this->post('/articles/1/authors', [
            'authors' => $users
        ]);

        $response = $this->post('/submissions', [
            'number' => (string) $this->faker->unique()->randomNumber(),
            'article' => $article,
            'edition' => $edition
        ]);

        $response->assertOk();
        $this->assertNotNull(Article::find(1)->editions);
        $this->assertNotNull(Edition::find(1)->articles);
    }
}
