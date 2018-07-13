<?php

use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionUserSeeder.
 */
class PermissionUserSeeder extends Seeder
{
    use DisableForeignKeys, TruncateTable;

    /**
     * Run the database seed.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        $this->truncate(config('access.permission_user_table'));

        // Attach executive user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(2);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        // Attach frontend user permission
        $user_model = config('auth.providers.users.model');
        $user = new $user_model();
        $user = $user::find(3);
        $permissions = $user->roles->first()->permissions->pluck('id');
        if (!empty($permissions)) {
            $user->permissions()->sync($permissions);
        }

        $this->enableForeignKeys();
    }
}
