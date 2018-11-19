<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->truncate();

        $modules = [
            [
                'name'                  => trans('menus.backend.access.title'),
                'url'                   => null,
                'view_permission_id'    => 'view-access-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.access.users.management'),
                'url'                   => 'admin.access.user.index',
                'view_permission_id'    => 'view-user-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.access.roles.management'),
                'url'                   => 'admin.access.role.index',
                'view_permission_id'    => 'view-role-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.access.permissions.management'),
                'url'                   => 'admin.access.permission.index',
                'view_permission_id'    => 'view-permission-management',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.menus.title'),
                'url'                   => 'admin.menus.index',
                'view_permission_id'    => 'view-menu',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.modules.title'),
                'url'                   => 'admin.modules.index',
                'view_permission_id'    => 'view-module',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.pages.title'),
                'url'                   => 'admin.pages.index',
                'view_permission_id'    => 'view-page',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('labels.backend.settings.title'),
                'url'                   => 'admin.settings.edit',
                'view_permission_id'    => 'edit-settings',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('menus.backend.blog.management'),
                'url'                   => null,
                'view_permission_id'    => 'view-blog',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('menus.backend.blogcategories.management'),
                'url'                   => 'admin.blogcategories.index',
                'view_permission_id'    => 'view-blog-category',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('menus.backend.blogtags.management'),
                'url'                   => 'admin.blogtags.index',
                'view_permission_id'    => 'view-blog-tag',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('menus.backend.blog.management'),
                'url'                   => 'admin.blogs.index',
                'view_permission_id'    => 'view-blog',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
            [
                'name'                  => trans('menus.backend.faqs.management'),
                'url'                   => 'admin.faqs.index',
                'view_permission_id'    => 'view-faq',
                'created_by'            => 1,
                'created_at'            => Carbon::now(),
            ],
        ];

        DB::table('modules')->insert($modules);
    }
}
