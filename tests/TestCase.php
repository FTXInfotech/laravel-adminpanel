<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn($user = null)
    {
        $user = $user ?: create('App\User');

        $this->be($user);

        return $this;
    }

    public function setUp()
    {
        parent::setUp();

        $this->withoutExceptionHandling();
    }
}
