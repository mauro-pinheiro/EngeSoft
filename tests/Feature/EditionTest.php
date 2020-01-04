<?php

namespace Tests\Feature;

use App\Edition;
use App\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditionTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
        'volume' => 1,
        'number' => '1111',
        'month' => 1,
        'year' => 2020,
        'theme_id' => 1
    ];

    public function testCreateEdition()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/editions', $this->data);

        $response->assertOk();
        $this->assertCount(1, Edition::all());
    }

    public function testVolumeIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data, ['volume' => ''])
        );

        $response->assertSessionHasErrors('volume');
        // $this->assertCount(1, Edition::all());
    }

    public function testNumberIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data, ['number' => ''])
        );

        $response->assertSessionHasErrors('number');
        // $this->assertCount(1, Edition::all());
    }

    public function testMonthIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data, ['month' => ''])
        );

        $response->assertOk();
        // $this->assertCount(1, Edition::all());
    }

    public function testYearIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data, ['year' => ''])
        );

        $response->assertOk();
        // $this->assertCount(1, Edition::all());
    }

    public function testEditionThemeCreatedAutomatically()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge(
                $this->data,
                ['theme_id' => 'database']
            )
        );

        $this->assertCount(1, Theme::all());
        $this->assertEquals(Edition::first()->theme_id, Theme::first()->id);
    }
}
