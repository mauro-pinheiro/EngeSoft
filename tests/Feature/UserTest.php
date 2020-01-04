<?php

namespace Tests\Feature;

use App\User;
use App\Institution;
use App\Theme;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected $data = [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'institution_id' => 'ifma',
        'address' => 'rua 3',
        'password' => 'admin123',
        'password_confirmation' => 'admin123'
    ];

    public function testCreateNewUser()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            $this->data
        );

        // dd(User::first()->institution);

        $response->assertOk();
        $this->assertCount(1, User::all());
    }

    public function testUserNameIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['name' => '']
            )
        );

        $response->assertSessionHasErrors('name');
    }

    public function testUserEmailIsRequired()
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

    public function testUserEmailIsUnique()
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

    public function testUserEmailIsValide()
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

    public function testUserInstitutionIsNotRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['institution_id' => '']
            )
        );

        $response->assertOk();
    }

    public function testUserAddressIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['address' => '']
            )
        );

        $response->assertSessionHasErrors('address');
    }

    public function testUserPasswordIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['password' => '']
            )
        );

        $response->assertSessionHasErrors('password');
    }

    public function testUserPasswordHasMinOf8Chars()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['password' => '123']
            )
        );

        $response->assertSessionHasErrors('password');
    }

    public function testUserPasswordConfirmation()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['password_confirmation' => 'admin1234']
            )
        );

        $response->assertSessionHasErrors('password');
    }

    public function testUserInstitutionCreatedAutomatically()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['institution_id' => 'ifma']
            )
        );

        $this->assertCount(1, Institution::all());
        $this->assertEquals(User::first()->institution, Institution::first());
    }

    public function testUserThemeCreatedAutomatically()
    {
        // $this->withoutExceptionHandling();
        $themes = ['database', 'A.I'];
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['themes' => $themes]
            )
        );

        $this->assertCount(2, Theme::all());
        $this->assertCount(2, User::first()->themes);
        $this->assertEquals(User::first()->themes->first()->pivot->theme_id, Theme::find(1)->id);
        $this->assertEquals(User::first()->themes->get(1)->pivot->theme_id, Theme::find(2)->id);
    }

    public function testCannotCreateDuplicatedThemesFromTheThemesList()
    {
        $this->withoutExceptionHandling();
        $themes = ['database', 'A.I', 'database'];
        $response = $this->post(
            '/users',
            array_merge(
                $this->data,
                ['themes' => $themes]
            )
        );

        $this->assertCount(2, Theme::all());
    }
}
