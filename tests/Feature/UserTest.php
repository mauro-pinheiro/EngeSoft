<?php

namespace Tests\Feature;

use App\User;
use App\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
        'nome' => 'admin',
        'email' => 'admin@admin.com',
        'institution_id' => 'ifma',
        'endereco' => 'rua 3',
        'senha' => 'admin123',
        'senha_confirmation' => 'admin123'
    ];

    /**
     @test
     */
    public function um_user_pode_ser_cadastrado()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            $this->data
        );

        $response->assertOk();
        $this->assertCount(1, User::all());
    }

    /**
     @test
     */
    public function o_nome_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['nome' => '']
            )
        );

        $response->assertSessionHasErrors('nome');
    }

    /**
     @test
     */
    public function o_email_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['email' => '']
            )
        );

        $response->assertSessionHasErrors('email');
    }

    /**
     @test
     */
    public function o_email_eh_unico()
    {
        // $this->withoutExceptionHandling();
        $this->post(
            '/users',
            $this->data,
        );

        $response = $this->post(
            '/users',
            $this->data,
        );

        $response->assertSessionHasErrors('email');
    }

    /**
     @test
     */
    public function o_email_eh_valido()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['email' => 'admin']
            )
        );

        $response->assertSessionHasErrors('email');
    }

    /**
     @test
     */
    public function o_instituicao_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['institution_id' => '']
            )
        );

        $response->assertSessionHasErrors('institution_id');
    }

    /**
     @test
     */
    public function o_endereco_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['endereco' => '']
            )
        );

        $response->assertSessionHasErrors('endereco');
    }

    /**
     @test
     */
    public function o_senha_eh_obrigatorio()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['senha' => '']
            )
        );

        $response->assertSessionHasErrors('senha');
    }

    /**
     @test
     */
    public function o_senha_eh_com_no_min_de_8_chars()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['senha' => '123']
            )
        );

        $response->assertSessionHasErrors('senha');
    }

    /**
     @test
     */
    public function o_senha_deve_ser_confirmada()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['senha_confirmation' => 'admin1234']
            )
        );

        $response->assertSessionHasErrors('senha');
    }

    /**
      @test
     */
    public function deve_adicionar_instituicao_automaticamente()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            $this->data
        );

        $this->assertCount(1, Institution::all());
    }
}
