<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\User;

class CreateAdminsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_create_new_admin()
    {
        $this->postJson('/manage/api/admins', [
            'name' => 'moshe',
            'email' => 'mosh@gmail.com',
            'password' => '123',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'moshe'
        ]);

        $moshe = User::whereName('moshe')->first();

        $this->assertTrue($moshe->isAdmin());

    }

    /** @test */
    public function name_is_requried()
    {
        $response = $this->postJson('/manage/api/admins', [
            'name' => 'asd',
            'email' => 'mosh@gmail.com',
            'password' => '',
        ])->json();

        $this->assertArrayHasKey('password', $response['errors']);
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->postJson('/manage/api/admins', [
            'name' => '',
            'email' => 'mosh@gmail.com',
            'password' => '123',
        ])->json();

        $this->assertArrayHasKey('name', $response['errors']);
    }

    /** @test */
    public function email_must_be_valid()
    {
        $response = $this->postJson('/manage/api/admins', [
            'name' => 'asd',
            'email' => 'moshgmail.com',
            'password' => '123',
        ])->json();

        $this->assertArrayHasKey('email', $response['errors']);

        create(User::class, [ 'email' => 'a@gmail.com' ]);

        $response = $this->postJson('/manage/api/admins', [
            'name' => 'asd',
            'email' => 'a@gmail.com',
            'password' => '123',
        ])->json();

        $this->assertArrayHasKey('email', $response['errors']);
    }
}
