<?php

namespace Tests\Feature;

use App\Edition;
use App\Theme;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function data()
    {
        return [
            'volume' => $this->faker->randomDigit,
            'number' => $this->faker->randomNumber(),
            'month' => $this->faker->month,
            'year' => $this->faker->year,
            'theme_id' => factory(Theme::class)->create()->id,
            'user_id' => factory(User::class)->create()->id
        ];
    }

    // protected $userData = [
    //     'name' => 'admin',
    //     'email' => 'admin@admin.com',
    //     'institution_id' => 'ifma',
    //     'address' => 'rua 3',
    //     'password' => 'admin123',
    //     'password_confirmation' => 'admin123'
    // ];

    public function testCreateEdition()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/editions', $this->data());

        $response->assertOk();
        $this->assertCount(1, Edition::all());
    }

    public function testVolumeIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data(), ['volume' => ''])
        );

        $response->assertSessionHasErrors('volume');
        $this->assertCount(0, Edition::all());
    }

    public function testNumberIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data(), ['number' => ''])
        );

        $response->assertSessionHasErrors('number');
        $this->assertCount(0, Edition::all());
    }

    public function testMonthIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data(), ['month' => ''])
        );

        $response->assertOk();
        $this->assertCount(1, Edition::all());
    }

    public function testYearIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/editions',
            array_merge($this->data(), ['year' => ''])
        );

        $response->assertOk();
        $this->assertCount(1, Edition::all());
    }

    // public function testEditionThemeCreatedAutomatically()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->post(
    //         '/editions',
    //         array_merge(
    //             $this->data(),
    //             ['theme_id' => 'database']
    //         )
    //     );

    //     $this->assertCount(1, Theme::all());
    //     $this->assertEquals(Edition::first()->theme_id, Theme::first()->id);
    // }
}
