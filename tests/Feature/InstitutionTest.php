<?php

namespace Tests\Feature;

use App\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstitutionTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function data()
    {
        return ['name' => $this->faker->company];
    }

    public function testCreateNewInstitution()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/instituitions', $this->data());
        $response->assertOk();
        $this->assertCount(1, Institution::all());
    }

    public function testInstituitionNameIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/instituitions',
            array_merge(
                $this->data(),
                ['name' => '']
            )
        );

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Institution::all());
    }
}
