<?php

namespace Tests\Unit;

use App\Events\Backend\Auth\User\UserConfirmed;
use App\Events\Backend\Auth\User\UserCreated;
use App\Events\Backend\Auth\User\UserDeactivated;
use App\Events\Backend\Auth\User\UserDeleted;
use App\Events\Backend\Auth\User\UserPasswordChanged;
use App\Events\Backend\Auth\User\UserPermanentlyDeleted;
use App\Events\Backend\Auth\User\UserReactivated;
use App\Events\Backend\Auth\User\UserRestored;
use App\Events\Backend\Auth\User\UserUnconfirmed;
use App\Events\Backend\Auth\User\UserUpdated;
use App\Exceptions\GeneralException;
use App\Models\Auth\Permission;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Notifications\Backend\Auth\UserAccountActive;
use App\Repositories\Backend\Auth\UserRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

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

        $role = factory(Role::class)->create([
            'name' => 'Employee',
            'all' => 0,
            'status' => 1,
        ]);

        $permissions = factory(Permission::class, 3)->create([
            'status' => 1,
        ]);

        $userData = [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
            'status' => 1,
            'confirmed' => 1,
            'permissions' => $permissions->pluck('id', 'id')->toArray(),
            'assignees_roles' => [$role->id],
        ];

        Event::fake([
            UserCreated::class,
        ]);

        $user = $this->userRepository->create($userData);

        $this->assertSame(2, User::count());
        $this->assertDatabaseHas('users', [
            'first_name' => $userData['first_name'],
            'last_name' => $userData['last_name'],
            'email' => $userData['email'],
            'first_name' => $userData['first_name'],
            'status' => $userData['status'],
            'confirmed' => $userData['confirmed'],
        ]);

        $this->assertTrue($user->hasRole($role->id));
        $this->assertSame($permissions->pluck('id', 'id')->toArray(), $user->permissions->pluck('id', 'id')->toArray());

        Event::assertDispatched(UserCreated::class, function (UserCreated $event) use ($userData) {
            return $event->user->first_name == $userData['first_name'] && $event->user->email == $userData['email'];
        });
    }

    /** @test */
    public function it_can_update_existing_users()
    {
        $this->actingAs(factory(User::class)->create());

        // We need at least one role to create a user

        $role = factory(Role::class)->create([
            'name' => 'Employee',
            'all' => 0,
            'status' => 1,
        ]);

        $permissions = factory(Permission::class, 3)->create([
            'status' => 1,
        ]);

        $user = factory(User::class)->create([
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
            'status' => 1,
            'confirmed' => 1,
        ]);

        $user->attachRoles([$role->id]);
        $user->attachPermissions($permissions->pluck('id', 'id')->toArray());

        Event::fake([
            UserUpdated::class,
        ]);

        // Now we'll try to update this user

        $newRole = factory(Role::class)->create([
            'name' => 'Staff',
            'all' => 0,
            'status' => 1,
        ]);

        $updateUserData = [
            'first_name' => $this->faker->firstName,
            'permissions' => factory(Permission::class, 2)->create()->push($permissions->random(1))->flatten()->pluck('id', 'id')->sort()->toArray(),
            'assignees_roles' => [$newRole->id],
        ];

        $updatedUser = $this->userRepository->update($user, $updateUserData);

        $this->assertSame($updatedUser->first_name, $updateUserData['first_name']);
        $this->assertTrue($updatedUser->hasRole($newRole->id));
        $this->assertFalse($updatedUser->hasRole($role->id));
        $this->assertSame($updateUserData['permissions'], $updatedUser->permissions->pluck('id', 'id')->sort()->toArray());

        Event::assertDispatched(UserUpdated::class, function (UserUpdated $event) use ($updatedUser) {
            return $event->user->first_name == $updatedUser->first_name && $event->user->email == $updatedUser->email;
        });
    }

    /** @test */
    public function it_can_soft_delete_existing_users()
    {
        // We need at least one role to delete it.
        $user = factory(User::class)->create();

        Event::fake([
            UserDeleted::class,
        ]);

        $this->userRepository->delete($user);

        $this->assertSame(1, User::onlyTrashed()->count());
        Event::assertDispatched(UserDeleted::class, 1);
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

        Event::fake([
            UserPermanentlyDeleted::class,
        ]);

        // Soft Delete User First
        $this->userRepository->delete($user);

        $this->assertTrue($this->userRepository->forceDelete($user));
        Event::assertDispatched(UserPermanentlyDeleted::class);
    }

    /** @test */
    public function it_can_restore_users_which_is_soft_deleted()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->create();

        Event::fake([
            UserRestored::class,
        ]);

        // Soft Delete User First
        $this->userRepository->delete($user);

        $restoredUser = $this->userRepository->restore($user);
        $this->assertNull($restoredUser->deleted_at);
        Event::assertDispatched(UserRestored::class);
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

        Event::fake([
            UserPasswordChanged::class,
        ]);

        $updatedUser = $this->userRepository->updatePassword($user, [
            'password' => $newPassword,
        ]);

        $this->assertTrue(Hash::check($newPassword, $updatedUser->password));
        Event::dispatched(UserPasswordChanged::class);
    }

    /** @test */
    public function it_can_change_status_of_user()
    {
        // We need at least one role to change his status.
        $user = factory(User::class)->create();

        Event::fake([
            UserDeactivated::class,
            UserReactivated::class,
        ]);

        $activeUser = $this->userRepository->mark($user, 1);   //Mark Active
        $this->assertSame(true, $activeUser->status);

        Event::assertDispatched(UserReactivated::class);

        $activeUser = $this->userRepository->mark($user, 0);   //Mark Inactive
        $this->assertSame(false, $activeUser->status);

        Event::assertDispatched(UserDeactivated::class);
    }

    /** @test */
    public function it_can_confirm_user()
    {
        config(['access.users.requires_approval' => true]);

        // We need at least one role to change his status.
        $user = factory(User::class)->state('unconfirmed')->create();

        Event::fake([
            UserConfirmed::class,
        ]);
        Notification::fake();

        $activeUser = $this->userRepository->confirm($user);
        $this->assertTrue($activeUser->isConfirmed());

        Event::assertDispatched(UserConfirmed::class);
        Notification::assertSentTo($user, UserAccountActive::class);
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
        Event::fake([
            UserUnconfirmed::class,
        ]);

        // We need at least one role to change his status.
        $user = factory(User::class)->state('confirmed')->create(['id' => 2]);

        $activeUser = $this->userRepository->unconfirm($user);
        $this->assertFalse($activeUser->isConfirmed());
        Event::assertDispatched(UserUnconfirmed::class);
    }

    /** @test */
    public function it_can_not_unconfirm_a_already_unconfirmed_user()
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

    /**
     * @test
     */
    public function createUserStub_will_provide_user_stub()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $input = [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail,
            'password' => $this->faker->password(8),
        ];

        $result = $this->callPrivateMethod($this->userRepository, 'createUserStub', [$input]);

        $this->assertInstanceOf(User::class, $result);

        $this->assertSame($input['first_name'], $result->first_name);
        $this->assertSame($input['last_name'], $result->last_name);
        $this->assertSame($input['email'], $result->email);
        $this->assertSame(false, $result->status);

        $this->assertSame($user->id, $result->created_by);
        $this->assertTrue(Hash::check($input['password'], $result->password));
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_active_users_for_datatable()
    {
        $aciveUsers = factory(User::class, 6)->state('active')->create();
        $inactiveUsers = factory(User::class, 5)->state('inactive')->create();
        $activeDeletesUsers = factory(User::class, 4)->states('active', 'softDeleted', )->create();
        $inactiveDeletedUsers = factory(User::class, 3)->states('inactive', 'softDeleted', )->create();

        $this->assertCount($aciveUsers->count(), $this->userRepository->getForDataTable(1, false)->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_inactive_users_for_datatable()
    {
        $aciveUsers = factory(User::class, 6)->state('active')->create();
        $inactiveUsers = factory(User::class, 5)->state('inactive')->create();
        $activeDeletesUsers = factory(User::class, 4)->states('active', 'softDeleted', )->create();
        $inactiveDeletedUsers = factory(User::class, 3)->states('inactive', 'softDeleted', )->create();

        $this->assertCount($inactiveUsers->count(), $this->userRepository->getForDataTable(0, false)->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_deleted_users_for_datatable()
    {
        $aciveUsers = factory(User::class, 6)->state('active')->create();
        $inactiveUsers = factory(User::class, 5)->state('inactive')->create();
        $activeDeletesUsers = factory(User::class, 4)->states('active', 'softDeleted', )->create();
        $inactiveDeletedUsers = factory(User::class, 3)->states('inactive', 'softDeleted', )->create();

        $deletedUserCount = $activeDeletesUsers->count() + $inactiveDeletedUsers->count();

        $this->assertCount($deletedUserCount, $this->userRepository->getForDataTable(1, 'true')->get()->toArray());
        $this->assertCount($deletedUserCount, $this->userRepository->getForDataTable(0, 'true')->get()->toArray());
    }

    /**
     * @test
     */
    public function getForDataTable_will_provide_users_with_fields_for_datatable()
    {
        $aciveUsers = factory(User::class, 3)->state('active')->create();

        $result = $this->userRepository->getForDataTable(1)->get();

        $this->assertSame($aciveUsers->count(), $result->count());

        $result = $result->first()->toArray();

        $this->assertIsArray($result);

        $this->assertArrayHasKey('id', $result);
        $this->assertArrayHasKey('first_name', $result);
        $this->assertArrayHasKey('last_name', $result);
        $this->assertArrayHasKey('email', $result);
        $this->assertArrayHasKey('status', $result);
        $this->assertArrayHasKey('confirmed', $result);
        $this->assertArrayHasKey('confirmed', $result);
        $this->assertArrayHasKey('created_at', $result);
        $this->assertArrayHasKey('updated_at', $result);
        $this->assertArrayHasKey('deleted_at', $result);
        $this->assertArrayHasKey('full_name', $result);
    }
}
