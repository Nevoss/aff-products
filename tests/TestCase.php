<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Console\Kernel;
use App\Models\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase {
        refreshInMemoryDatabase as baseRefreshInMemoryDatabase;
    }

    /**
     * Overwrite! Refresh the in-memory database.
     *
     * @return void
     */
    protected function refreshInMemoryDatabase()
    {
        $this->artisan('migrate');
        $this->artisan('db:seed', [
            '--class' => 'TestsSeeder'
        ]);

        $this->app[Kernel::class]->setArtisan(null);
    }

    protected function signIn($user = null)
    {
        return (!$user) ? $this->be(create(User::class)) : $this->be($user);
    }

    protected function signInAsAdmin()
    {
        return $this->signIn(create(User::class, [
            'is_admin' => true,
        ]));
    }
}
