<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title'  => 'Access Management',
            'export' => 'Export',
            'copy'   => 'Copy',
            'print'  => 'Print',

            'roles' => [
                'all'        => 'All Roles',
                'create'     => 'Create Role',
                'edit'       => 'Edit Role',
                'management' => 'Role Management',
                'main'       => 'Roles',
            ],

            'permissions' => [
                'all'        => 'All Permissions',
                'create'     => 'Create Permission',
                'edit'       => 'Edit Permission',
                'management' => 'Permission Management',
                'main'       => 'Permissions',
            ],

            'users' => [
                'all'               => 'All Users',
                'change-password'   => 'Change Password',
                'create'            => 'Create User',
                'deactivated'       => 'Deactivated Users',
                'deleted'           => 'Deleted Users',
                'edit'              => 'Edit User',
                'main'              => 'Users',
                'view'              => 'View User',
                'action'            => 'Action',
                'list'              => 'List',
                'add-new'           => 'Add new',
                'deactivated-users' => 'Deactivated Users',
                'deleted-users'     => 'Deleted Users',
             ],
        ],

        'log-viewer' => [
            'main'      => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general'   => 'General',
            'system'    => 'System',
        ],

        'pages' => [
            'all'        => 'All Pages',
            'create'     => 'Create Page',
            'edit'       => 'Edit Page',
            'management' => 'Page Management',
            'main'       => 'Pages',
        ],

        'blogs' => [
            'all'        => 'All Blog',
            'create'     => 'Create Blog',
            'edit'       => 'Edit Blog',
            'management' => 'Blog Management',
            'main'       => 'Blogs',
        ],

        'blogcategories' => [
            'all'        => 'All Blog Categories',
            'create'     => 'Create Blog Category',
            'edit'       => 'Edit Blog Category',
            'management' => 'Blog Category Management',
            'main'       => 'CMS Pages',
        ],

        'blogtags' => [
            'all'        => 'All Blog Tag',
            'create'     => 'Create Blog Tag',
            'edit'       => 'Edit Blog Tag',
            'management' => 'Blog Tag Management',
            'main'       => 'Blog Tags',
        ],

        'blog' => [
            'all'        => 'All Blog Page',
            'create'     => 'Create Blog Page',
            'edit'       => 'Edit Blog Page',
            'management' => 'Blog Management',
            'main'       => 'Blog Pages',
        ],

        'faqs' => [
            'all'        => 'All Faq Page',
            'create'     => 'Create Faq Page',
            'edit'       => 'Edit Faq Page',
            'management' => 'Faq Management',
            'main'       => 'Faq Pages',
        ],

        'settings' => [
            'all'        => 'All Settings',
            'create'     => 'Create Settings',
            'edit'       => 'Edit Settings',
            'management' => 'Settings Management',
            'main'       => 'Settings',
        ],

        'menus' => [
            'all'        => 'All Menu',
            'create'     => 'Create Menu',
            'edit'       => 'Edit Menu',
            'management' => 'Menu Management',
            'main'       => 'Menus',
        ],

        'modules' => [
            'all'        => 'All Modules Page',
            'create'     => 'Create Module Page',
            'management' => 'Module Management',
            'main'       => 'Module Pages',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar'    => 'Arabic',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'nl'    => 'Dutch',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
        ],
    ],
];
