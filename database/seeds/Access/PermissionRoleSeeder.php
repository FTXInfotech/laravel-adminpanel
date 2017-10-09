<?php

use App\Models\Access\Role\Role;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleSeeder.
 */
class PermissionRoleSeeder extends Seeder
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
        $this->truncate(config('access.permission_role_table'));

        /*
         * Assign permission to executive role
        */
        $executivePermission = [1, 3, 4, 5, 6, 7, 8, 16, 20,
            24, 25, 26, 27, // CMS Pages
            28, 29, 30, 31, // Email template
            33, 34, 35, 36, // Blog Category
            37, 38, 39, 40, // Blog Tag
            41, 42, 43, 44, // Blogs
            45, 46, 47, 48, // FAQ
        ];
        Role::find(2)->permissions()->sync($executivePermission);

        /*
         * Assign view frontend to user role
        */
        Role::find(3)->permissions()->sync([2]);

        $this->enableForeignKeys();
    }
}
