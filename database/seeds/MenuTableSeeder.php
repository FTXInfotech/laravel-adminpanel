<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('access.menus_table'))->truncate();
        $menu = [
            'id'                    => 1,
            'type'                  => 'backend',
            'name'                  => 'Backend Sidebar Menu',
            'items'                 => '[{"view_permission_id":"view-access-management","icon":"fa-users","open_in_new_tab":0,"url_type":"route","url":"","name":"Access Management","id":11,"content":"Access Management","children":[{"view_permission_id":"view-user-management","open_in_new_tab":0,"url_type":"route","url":"admin.access.user.index","name":"User Management","id":12,"content":"User Management"},{"view_permission_id":"view-role-management","open_in_new_tab":0,"url_type":"route","url":"admin.access.role.index","name":"Role Management","id":13,"content":"Role Management"},{"view_permission_id":"view-permission-management","open_in_new_tab":0,"url_type":"route","url":"admin.access.permission.index","name":"Permission Management","id":14,"content":"Permission Management"}]},{"view_permission_id":"view-module","icon":"fa-wrench","open_in_new_tab":0,"url_type":"route","url":"admin.modules.index","name":"Module","id":1,"content":"Module"},{"view_permission_id":"view-menu","icon":"fa-bars","open_in_new_tab":0,"url_type":"route","url":"admin.menus.index","name":"Menus","id":3,"content":"Menus"},{"view_permission_id":"view-page","icon":"fa-file-text","open_in_new_tab":0,"url_type":"route","url":"admin.pages.index","name":"Pages","id":2,"content":"Pages"},{"view_permission_id":"edit-settings","icon":"fa-gear","open_in_new_tab":0,"url_type":"route","url":"admin.settings.edit?id=1","name":"Settings","id":9,"content":"Settings"},{"view_permission_id":"view-blog","icon":"fa-commenting","open_in_new_tab":0,"url_type":"route","url":"","name":"Blog Management","id":15,"content":"Blog Management","children":[{"view_permission_id":"view-blog-category","open_in_new_tab":0,"url_type":"route","url":"admin.blogCategories.index","name":"Blog Category Management","id":16,"content":"Blog Category Management"},{"view_permission_id":"view-blog-tag","open_in_new_tab":0,"url_type":"route","url":"admin.blogTags.index","name":"Blog Tag Management","id":17,"content":"Blog Tag Management"},{"view_permission_id":"view-blog","open_in_new_tab":0,"url_type":"route","url":"admin.blogs.index","name":"Blog Management","id":18,"content":"Blog Management"}]},{"view_permission_id":"view-faq","icon":"fa-question-circle","open_in_new_tab":0,"url_type":"route","url":"admin.faqs.index","name":"Faq Management","id":19,"content":"Faq Management"}]',
            'created_by'            => 1,
            'created_at'            => Carbon::now(),
        ];

        DB::table(config('access.menus_table'))->insert($menu);
    }
}
