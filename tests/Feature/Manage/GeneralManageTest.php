<?php

namespace Tests\Feature\Manage;

use Tests\TestCase;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class GeneralManageTest extends TestCase
{
    /** @test */
    public function only_admins_can_access_to_main_page_of_manage_area()
    {
        $this->get('/manage')->assertRedirect('/login');

        $this->withoutExceptionHandling();

        $this->expectException(NotFoundHttpException::class);
        $this->signIn();

        $this->get('/manage');
    }
}
