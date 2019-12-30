<?php

namespace Tests\Feature;

use App\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InstitutionTest extends TestCase
{
    use RefreshDatabase;

    protected $data = ['nome' => 'ifma'];

    /**
     @test
     */
    public function eh_possivel_adicionar_uma_instituicao()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post('/instituitions', $this->data);

        $response->assertOk();
        $this->assertCount(1, Institution::all());
    }

    /**
     @test
     */
    public function o_nome_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/instituitions',
            array_merge(
                $this->data,
                ['nome' => '']
            )
        );

        $response->assertSessionHasErrors('nome');
    }
}
