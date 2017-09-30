<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;

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
}
