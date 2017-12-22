<?php

namespace Tests;

use App\Models\Access\Role\Role;
use App\Models\Access\User\User;
use Illuminate\Support\Facades\Artisan;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTestCase extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost:8000';

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

    /**
     * Set up tests.
     */
    public function setUp()
    {
        parent::setUp();

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
}
