<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Console\Kernel;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

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

    /**
     * Sign in as user
     *
     * @param  mixed $user
     * @return User
     */
    protected function signIn($user = null)
    {
        return (!$user) ? $this->be(create(User::class)) : $this->be($user);
    }

    /**
     * Sign in as Admin
     *
     * @return User
     */
    protected function signInAsAdmin()
    {
        return $this->signIn(create(User::class, [
            'is_admin' => true,
        ]));
    }

    /**
     * Create fake http client with the requested response
     *
     * @param  integer $status
     * @param  array  $headers
     * @return Client
     */
    protected function createTestHttpClient($arrayOfResponse)
    {
        $arrayOfResponse = array_map(function ($response) {
            return new Response(
                $response['status'],
                array_get($response, 'headers', []),
                array_get($response, 'body', null)
            );
        }, $arrayOfResponse);

        $mock = new MockHandler($arrayOfResponse);

        $handler = HandlerStack::create($mock);

        return new Client(['handler' => $handler]);
    }
}
