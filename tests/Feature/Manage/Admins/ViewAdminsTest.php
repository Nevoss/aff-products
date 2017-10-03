<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use App\Models\User;

class ViewAdminsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->signinAsAdmin();

        $this->withoutExceptionHandling();
    }

    /** @test */
    public function an_admin_can_fetch_all_of_the_admins()
    {
        $response = $this->getJson('/manage/api/admins')->json();

        $this->assertCount(1, $response['data']);
    }

    /** @test */
    public function an_admin_can_fetch_single_admin()
    {
        $admin = create(User::class, ['is_admin' => true]);

        $response = $this->getJson("/manage/api/admins/{$admin->id}")->json();

        $this->assertEquals($admin->id, $response['data']['id']);

    }

    /** @test */
    public function an_admin_can_filters_admin_by_search()
    {
        create(User::class, [ 'name' => 'abc', 'is_admin' => true ]);
        create(User::class, [ 'name' => 'kkk', 'is_admin' => true ]);

        $response = $this->getJson('/manage/api/admins?search=kk')->json();

        $this->assertCount(1, $response['data']);
    }
}
