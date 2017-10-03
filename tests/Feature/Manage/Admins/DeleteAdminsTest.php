<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\User;

class DeleteAdminsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        // $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_delete_admin()
    {
        $admin = create(User::class, ['is_admin' => true]);

        $this->assertDatabaseHas('users', [
            'id' => $admin->id
        ]);

        $this->deleteJson("/manage/api/admins/{$admin->id}");

        $this->assertDatabaseMissing('users', [
            'id' => $admin->id
        ]);
    }
}
