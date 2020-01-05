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
    use WithFaker;

    protected function data()
    {
        $password = $this->faker->password(8);
        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'institution_id' => factory(Institution::class)->create()->id,
            'address' => $this->faker->address,
            'password' => $password,
            'password_confirmation' => $password
        ];
        // dump($data);
        return $data;
    }

    public function testCreateNewUser()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            $this->data()
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
                $this->data(),
                ['name' => '']
            )
        );

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, User::all());
    }

    public function testUserEmailIsRequired()
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
        $this->assertCount(0, User::all());
    }

    public function testUserEmailIsUnique()
    {
        // $this->withoutExceptionHandling();
        $email = $this->data()['email'];
        // dump($email);
        $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['email' => $email]
            )
        );

        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['email' => $email]
            )
        );


        $response->assertSessionHasErrors('email');
        $this->assertCount(1, User::all());
    }

    public function testUserEmailIsValide()
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
        $this->assertCount(0, User::all());
    }

    public function testUserInstitutionIsNotRequired()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['institution_id' => '']
            )
        );

        $response->assertOk();
        $this->assertCount(1, User::all());
    }

    public function testUserAddressIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['address' => '']
            )
        );

        $response->assertSessionHasErrors('address');
        $this->assertCount(0, User::all());
    }

    public function testUserPasswordIsRequired()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['password' => '']
            )
        );

        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }

    public function testUserPasswordHasMinOf8Chars()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['password' => '123']
            )
        );

        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }

    public function testUserPasswordConfirmation()
    {
        // $this->withoutExceptionHandling();
        $response = $this->post(
            '/users',
            array_merge(
                $this->data(),
                ['password_confirmation' => 'admin1234']
            )
        );

        $response->assertSessionHasErrors('password');
        $this->assertCount(0, User::all());
    }

    // public function testUserInstitutionCreatedAutomatically()
    // {
    //     $this->withoutExceptionHandling();
    //     $response = $this->post(
    //         '/users',
    //         array_merge(
    //             $this->data(),
    //             ['institution_id' => 'ifma']
    //         )
    //     );

    //     $this->assertCount(1, Institution::all());
    //     $this->assertEquals(User::first()->institution, Institution::first());
    // }

    // public function testCannotCreateDuplicatedThemesFromTheThemesList()
    // {
    //     $this->withoutExceptionHandling();
    //     $themes = ['database', 'A.I', 'database'];
    //     $response = $this->post(
    //         '/users',
    //         array_merge(
    //             $this->data(),
    //             ['themes' => $themes]
    //         )
    //     );

    //     $this->assertCount(2, Theme::all());
    // }
}
