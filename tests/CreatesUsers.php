<?php

namespace Tests;

use App\Models\Access\User\User;

trait CreatesUsers
{
    protected function login(array $attributes = []): User
    {
        $user = $this->createUser($attributes);

        $this->be($user);

        return $user;
    }


    protected function createUser(array $attributes = []): User
    {
        return factory(User::class)->create(array_merge([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'github_username' => 'johndoe',
        ], $attributes));
    }
}
