<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;
    /**
     @test
     */
    public function um_user_pode_ser_cadastrado()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            $this->data()
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
                $this->data(),
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
                $this->data(),
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
            $this->data(),
        );

        $response = $this->post(
            '/users',
            $this->data(),
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
                $this->data(),
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
                $this->data(),
                ['instituicao' => '']
            )
        );

        $response->assertSessionHasErrors('instituicao');
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
                $this->data(),
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
                $this->data(),
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
                $this->data(),
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
                $this->data(),
                ['senha_confirmation' => 'admin1234']
            )
        );

        $response->assertSessionHasErrors('senha');
    }

    protected function data()
    {
        return [
            'nome' => 'admin',
            'email' => 'admin@admin.com',
            'instituicao' => 'ifma',
            'endereco' => 'rua 3',
            'senha' => 'admin123',
            'senha_confirmation' => 'admin123'
        ];
    }
}
