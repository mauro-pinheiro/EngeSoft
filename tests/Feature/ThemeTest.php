<?php

namespace Tests\Feature;

use App\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThemeTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function data()
    {
        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->text()
        ];
    }

    public function testCreateTheme()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/themes', $this->data());
        $response->assertOk();
        $this->assertCount(1, Theme::all());
    }

    public function testNameIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/themes',
            array_merge(
                $this->data(),
                ['name' => '']
            )
        );

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Theme::all());
    }

    public function testNameIsUnique()
    {
        // $this->withoutExceptionHandling();
        $name = $this->data()['name'];
        $this->post(
            '/themes',
            array_merge(
                $this->data(),
                ['name' => $name]
            )
        );
        $response = $this->post(
            '/themes',
            array_merge(
                $this->data(),
                ['name' => $name]
            )
        );
        $response->assertSessionHasErrors('name');
        $this->assertCount(1, Theme::all());
    }

    public function testDescriptionIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/themes',
            array_merge(
                $this->data(),
                ['description' => '']
            )
        );

        $response->assertOk();
        $this->assertCount(1, Theme::all());
    }
}
