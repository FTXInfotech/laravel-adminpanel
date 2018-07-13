<?php

use Carbon\Carbon;
use Database\DisableForeignKeys;
use Database\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionTableSeeder.
 */
class PermissionTableSeeder extends Seeder
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
        $this->truncateMultiple([config('access.permissions_table'), config('access.permission_role_table')]);

        /**
         * Don't need to assign any permissions to administrator because the all flag is set to true
         * in RoleTableSeeder.php.
         */

        /**
         * Misc Access Permissions.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-backend';
        $viewBackend->display_name = 'View Backend';
        $viewBackend->sort = 1;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewFrontend = new $permission_model();
        $viewFrontend->name = 'view-frontend';
        $viewFrontend->display_name = 'View Frontend';
        $viewFrontend->sort = 2;
        $viewFrontend->created_by = 1;
        $viewFrontend->updated_by = null;
        $viewFrontend->created_at = Carbon::now();
        $viewFrontend->updated_at = Carbon::now();
        $viewFrontend->deleted_at = null;
        $viewFrontend->save();

        /**
         * Access Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-access-management';
        $viewBackend->display_name = 'View Access Management';
        $viewBackend->sort = 3;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * User Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-user-management';
        $viewBackend->display_name = 'View User Management';
        $viewBackend->sort = 4;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-active-user';
        $viewBackend->display_name = 'View Active User';
        $viewBackend->sort = 5;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-deactive-user';
        $viewBackend->display_name = 'View Deactive User';
        $viewBackend->sort = 6;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-deleted-user';
        $viewBackend->display_name = 'View Deleted User';
        $viewBackend->sort = 7;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'show-user';
        $viewBackend->display_name = 'Show User Details';
        $viewBackend->sort = 8;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-user';
        $viewBackend->display_name = 'Create User';
        $viewBackend->sort = 9;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-user';
        $viewBackend->display_name = 'Edit User';
        $viewBackend->sort = 9;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-user';
        $viewBackend->display_name = 'Delete User';
        $viewBackend->sort = 10;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'activate-user';
        $viewBackend->display_name = 'Activate User';
        $viewBackend->sort = 11;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'deactivate-user';
        $viewBackend->display_name = 'Deactivate User';
        $viewBackend->sort = 12;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'login-as-user';
        $viewBackend->display_name = 'Login As User';
        $viewBackend->sort = 13;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'clear-user-session';
        $viewBackend->display_name = 'Clear User Session';
        $viewBackend->sort = 14;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Role Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-role-management';
        $viewBackend->display_name = 'View Role Management';
        $viewBackend->sort = 15;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-role';
        $viewBackend->display_name = 'Create Role';
        $viewBackend->sort = 16;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-role';
        $viewBackend->display_name = 'Edit Role';
        $viewBackend->sort = 17;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-role';
        $viewBackend->display_name = 'Delete Role';
        $viewBackend->sort = 18;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Permission Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-permission-management';
        $viewBackend->display_name = 'View Permission Management';
        $viewBackend->sort = 19;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-permission';
        $viewBackend->display_name = 'Create Permission';
        $viewBackend->sort = 20;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-permission';
        $viewBackend->display_name = 'Edit Permission';
        $viewBackend->sort = 21;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-permission';
        $viewBackend->display_name = 'Delete Permission';
        $viewBackend->sort = 22;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Pages.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-page';
        $viewBackend->display_name = 'View Page';
        $viewBackend->sort = 23;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-page';
        $viewBackend->display_name = 'Create Page';
        $viewBackend->sort = 24;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-page';
        $viewBackend->display_name = 'Edit Page';
        $viewBackend->sort = 25;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-page';
        $viewBackend->display_name = 'Delete Page';
        $viewBackend->sort = 26;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Email Templates.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-email-template';
        $viewBackend->display_name = 'View Email Templates';
        $viewBackend->sort = 27;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-email-template';
        $viewBackend->display_name = 'Create Email Templates';
        $viewBackend->sort = 28;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-email-template';
        $viewBackend->display_name = 'Edit Email Templates';
        $viewBackend->sort = 29;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-email-template';
        $viewBackend->display_name = 'Delete Email Templates';
        $viewBackend->sort = 30;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Settings.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-settings';
        $viewBackend->display_name = 'Edit Settings';
        $viewBackend->sort = 31;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Blog Categories Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-blog-category';
        $viewBackend->display_name = 'View Blog Categories Management';
        $viewBackend->sort = 32;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-blog-category';
        $viewBackend->display_name = 'Create Blog Category';
        $viewBackend->sort = 33;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-blog-category';
        $viewBackend->display_name = 'Edit Blog Category';
        $viewBackend->sort = 34;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-blog-category';
        $viewBackend->display_name = 'Delete Blog Category';
        $viewBackend->sort = 35;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Blog Tags Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-blog-tag';
        $viewBackend->display_name = 'View Blog Tags Management';
        $viewBackend->sort = 36;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-blog-tag';
        $viewBackend->display_name = 'Create Blog Tag';
        $viewBackend->sort = 37;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-blog-tag';
        $viewBackend->display_name = 'Edit Blog Tag';
        $viewBackend->sort = 38;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-blog-tag';
        $viewBackend->display_name = 'Delete Blog Tag';
        $viewBackend->sort = 39;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * Blogs Management.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-blog';
        $viewBackend->display_name = 'View Blogs Management';
        $viewBackend->sort = 40;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-blog';
        $viewBackend->display_name = 'Create Blog';
        $viewBackend->sort = 41;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-blog';
        $viewBackend->display_name = 'Edit Blog';
        $viewBackend->sort = 42;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-blog';
        $viewBackend->display_name = 'Delete Blog';
        $viewBackend->sort = 43;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        /**
         * FAQs.
         */
        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'view-faq';
        $viewBackend->display_name = 'View FAQ Management';
        $viewBackend->sort = 44;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'create-faq';
        $viewBackend->display_name = 'Create FAQ';
        $viewBackend->sort = 45;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'edit-faq';
        $viewBackend->display_name = 'Edit FAQ';
        $viewBackend->sort = 46;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $permission_model = config('access.permission');
        $viewBackend = new $permission_model();
        $viewBackend->name = 'delete-faq';
        $viewBackend->display_name = 'Delete FAQ';
        $viewBackend->sort = 47;
        $viewBackend->created_by = 1;
        $viewBackend->updated_by = null;
        $viewBackend->created_at = Carbon::now();
        $viewBackend->updated_at = Carbon::now();
        $viewBackend->deleted_at = null;
        $viewBackend->save();

        $this->enableForeignKeys();
    }
}
