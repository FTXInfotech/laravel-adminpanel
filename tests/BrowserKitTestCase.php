<?php

namespace Tests;

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication,
        RefreshDatabase;

    /**
     * @var
     */
    public $baseUrl;

    /**
     * @var
     */
    protected $admin;

    /**
     * @var
     */
    protected $executive;

    /**
     * @var
     */
    protected $user;

    /**
     * @var
     */
    protected $adminRole;

    /**
     * @var
     */
    protected $executiveRole;

    /**
     * @var
     */
    protected $userRole;

    public function setUp(): void
    {
        parent::setUp();

        if (config('database.default') == 'sqlite') {
            $db = app()->make('db');
            $db->connection()->getPdo()->exec('pragma foreign_keys=0');
        }

        $this->baseUrl = config('app.url', 'http://localhost:8000');

        // Set up the database
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed');

        /*
         * Create class properties to be used in tests
         */
        $this->admin = User::find(1);
        $this->executive = User::find(2);
        $this->user = User::find(3);
        $this->adminRole = Role::find(1);
        $this->executiveRole = Role::find(2);
        $this->userRole = Role::find(3);
    }

    public function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        parent::tearDown();
    }

    /**
     * Check if User is logged in or not.
     *
     * @return bool true or false
     */
    protected function assertLoggedIn()
    {
        $this->assertTrue(Auth::check());
    }

    /**
     * Check if User is logged out or not.
     *
     * @return bool true or false
     */
    protected function assertLoggedOut()
    {
        $this->assertFalse(Auth::check());
    }
}
