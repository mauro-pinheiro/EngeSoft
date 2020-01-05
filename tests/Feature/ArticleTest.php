<?php

namespace Tests\Feature;

use App\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function data()
    {
        return [
            'title' => $this->faker->sentence,
            'file' => $this->faker->sentence
        ];
    }

    public function testCreateArticle()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/articles', $this->data());

        $response->assertOk();
        $this->assertCount(1, Article::all());
    }

    public function testTitleIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/articles',
            array_merge(
                $this->data(),
                ['title' => '']
            )
        );

        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Article::all());
    }

    public function testFileIsNotRequired()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/articles',
            array_merge(
                $this->data(),
                ['file' => '']
            )
        );

        $response->assertOk();
        $this->assertCount(1, Article::all());
    }

    public function testAttachAuthor()
    {
        $this->withoutExceptionHandling();
        $this->post('/articles', $this->data());
        $num_authors = $this->faker->randomDigit;
        $user = factory(User::class, $num_authors)->create();

        $response = $this->post('/articles/1/author', [
            'author' => $user
        ]);

        // dd(Article::find(1)->authors);
        $response->assertOk();
        $this->assertCount($num_authors, Article::find(1)->authors);
        // $this->assertCount(User::find(1)->articles);
    }
}
