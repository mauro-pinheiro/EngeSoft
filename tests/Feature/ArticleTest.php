<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
        'title' => 'Database use nowadays',
        'file' => 'um arquivo'
    ];

    public function testCreateArticle()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/articles', $this->data);

        $response->assertOk();
        $this->assertCount(1, Article::all());
    }

    public function testTitleIsRequired()
    {
        $response = $this->post(
            '/articles',
            array_merge(
                $this->data,
                ['title' => '']
            )
        );

        $response->assertSessionHasErrors('title');
        $this->assertCount(0, Article::all());
    }

    public function testFileIsNotRequired()
    {
        $response = $this->post(
            '/articles',
            array_merge(
                $this->data,
                ['file' => '']
            )
        );

        $response->assertOk();
        $this->assertCount(1, Article::all());
    }
}
