<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateAdminsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_update_an_admin_without_changing_a_password()
    {
        $admin = create(User::class, [
            'is_admin' => true,
            'name' => 'aa',
            'email' => 'aa@gmail.com'
        ]);

        $this->patchJson("/manage/api/admins/{$admin->id}", [
            'name' => 'bb',
            'email' => $email = 'bb@gmail.com',
            'is_new_password' => false,
            'password' => $newPassword = 'as',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'bb',
            'email' => 'bb@gmail.com'
        ]);

        $this->assertFalse(Auth::attempt(['email' => $email, 'password' => $newPassword]));

    }

    /** @test */
    public function an_admin_can_update_an_admin_and_changing_a_password()
    {
        $admin = create(User::class, [
            'is_admin' => true,
            'name' => 'aa',
            'email' => 'aa@gmail.com',
            'password' => '555555',
        ]);

        $this->patchJson("/manage/api/admins/{$admin->id}", [
            'name' => 'bb',
            'email' => $email = 'bb@gmail.com',
            'is_new_password' => true,
            'password' => $newPassword = 'assssss',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'bb',
            'email' => 'bb@gmail.com'
        ]);

        $this->assertTrue(Auth::attempt(['email' => $email, 'password' => $newPassword]));

    }

}
