<?php

namespace Tests\Unit;

use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var string role_id
     */
    protected $role_id;

    protected function setUp(): void
    {
        parent::setUp();

        $this->userRepository = $this->app->make(UserRepository::class);
        // We create a test-role because almost every test need one
        $this->role_id = factory(Role::class)->create(['name' => 'test-role'])->id;
    }

    protected function getValidUserData($userData = [])
    {
        return array_merge([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'timezone' => 'UTC',
            'password' => 'secret',
            'assignees_roles' => [1],
        ], $userData);
    }

    /** @test */
    public function it_can_count_unconfirmed_users()
    {
        factory(User::class, 30)->states('unconfirmed')->create();
        $this->assertSame(30, $this->userRepository->getUnconfirmedCount());
    }

    /** @test */
    public function it_can_paginate_the_active_users()
    {
        factory(User::class, 30)->create();

        $paginatedUsers = $this->userRepository->getActivePaginated(25);

        $this->assertSame(2, $paginatedUsers->lastPage());
        $this->assertSame(25, $paginatedUsers->perPage());
        $this->assertSame(30, $paginatedUsers->total());

        $newPaginatedUsers = $this->userRepository->getActivePaginated(5);

        $this->assertSame(5, $newPaginatedUsers->perPage());
    }

    /** @test */
    public function it_can_paginate_the_inactive_users()
    {
        factory(User::class, 30)->create();
        factory(User::class, 25)->states('inactive')->create();

        $paginatedUsers = $this->userRepository->getInactivePaginated(10);

        $this->assertSame(3, $paginatedUsers->lastPage());
        $this->assertSame(10, $paginatedUsers->perPage());
        $this->assertSame(25, $paginatedUsers->total());
    }

    /** @test */
    public function it_can_paginate_the_soft_deleted_inactive_users()
    {
        factory(User::class, 30)->create();
        factory(User::class, 25)->states('softDeleted')->create();

        $paginatedUsers = $this->userRepository->getDeletedPaginated(10);

        $this->assertSame(3, $paginatedUsers->lastPage());
        $this->assertSame(10, $paginatedUsers->perPage());
        $this->assertSame(25, $paginatedUsers->total());
    }

    /** @test */
    public function it_can_create_new_users()
    {
        $this->actingAs(factory(User::class)->create());

        $user = $this->userRepository->create($this->getValidUserData());

        $this->assertSame(2, User::count());
    }

    /** @test */
    public function it_can_update_existing_users()
    {
        $this->actingAs(factory(User::class)->create());

        // We need at least one role to create a user
        $user = factory(User::class)->create();

        $this->userRepository->update($user, $this->getValidUserData([
            'first_name' => 'updated',
            'last_name' => 'name',
            'email' => 'new@email.com',
        ]));

        $this->assertSame('updated', $user->fresh()->first_name);
        $this->assertSame('name', $user->fresh()->last_name);
        $this->assertSame('new@email.com', $user->fresh()->email);
    }

    /** @test */
    public function it_can_soft_delete_existing_users()
    {
        // We need at least one role to delete it.
        $user = factory(User::class)->create();

        $this->userRepository->delete($user);

        $this->assertSame(1, User::onlyTrashed()->count());
    }

    /** @test */
    public function it_can_not_hard_delete_existing_users_which_is_not_soft_deleted_yet()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = factory(User::class)->create();
        
        $this->userRepository->forceDelete($user);
        // $this->assertTrue($this->userRepository->forceDelete($user));
    }

    /** @test */
    public function it_can_hard_delete_existing_users()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->create();
        // Soft Delete User First
        $this->userRepository->delete($user);

        $this->assertTrue($this->userRepository->forceDelete($user));
    }

    /** @test */
    public function it_can_restore_users_which_is_soft_deleted()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->create();
        // Soft Delete User First
        $this->userRepository->delete($user);

        $restoredUser = $this->userRepository->restore($user);
        $this->assertNull($restoredUser->deleted_at);
    }

    /** @test */
    public function it_can_not_restore_users_which_is_not_soft_deleted_yet()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = factory(User::class)->create();
        
        $restoredUser = $this->userRepository->restore($user);
    }

    /** @test */
    public function it_can_update_password_of_user()
    {
        $newPassword = '1234';
        $this->actingAs(factory(User::class)->create());

        // We need at least one role to update his password.
        $user = factory(User::class)->create();
        
        $updatedUser = $this->userRepository->updatePassword($user,[
            'password'  =>  $newPassword,
        ]);

        $this->assertTrue(Hash::check($newPassword, $updatedUser->password));
    }

    /** @test */
    public function it_can_change_status_of_user()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->create();
        
        $activeUser = $this->userRepository->mark($user, 1);   //Mark Active
        $this->assertSame(1, $activeUser->status);

        $activeUser = $this->userRepository->mark($user, 0);   //Mark Inactive
        $this->assertSame(0, $activeUser->status);
    }

    /** @test */
    public function it_can_confirm_user()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->state('unconfirmed')->create();
        
        $activeUser = $this->userRepository->confirm($user);
        $this->assertTrue($activeUser->isConfirmed());
    }

    /** @test */
    public function it_can_not_confirm_a_confirmed_user()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = factory(User::class)->state('confirmed')->create();
        
        $this->userRepository->confirm($user);
    }

    /** @test */
    public function it_can_unconfirm_user()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->state('confirmed')->create(['id' => 2]);
        
        $activeUser = $this->userRepository->unconfirm($user);
        $this->assertFalse($activeUser->isConfirmed());
    }

    /** @test */
    public function it_can_not_unconfirm_a_unconfirmed_user()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = factory(User::class)->state('unconfirmed')->create();
        
        $this->userRepository->unconfirm($user);
    }

    /** @test */
    public function it_can_not_unconfirm_self()
    {
        $this->expectException(GeneralException::class);

        $user = factory(User::class)->create();
        $this->actingAs($user);
        
        $this->userRepository->unconfirm($user);
    }

    /** @test */
    public function it_can_not_unconfirm_administrator()
    {
        $this->expectException(GeneralException::class);

        // We need at least one role to change his status.
        $user = factory(User::class)->state('confirmed')->create(['id' => 1]);  //User with id 1 will be administrator in production
        
        $activeUser = $this->userRepository->unconfirm($user);
    }


}
