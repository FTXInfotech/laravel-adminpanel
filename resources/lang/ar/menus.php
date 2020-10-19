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
            'title' => 'إدارة المستخدمين',

            'roles' => [
                'all' => 'جميع الأدوار',
                'create' => 'إنشاء دور جديد',
                'edit' => 'تعديل دور',
                'management' => 'إدارة الأدوار',
                'main' => 'أدوار المتسخدمين',
            ],

            'users' => [
                'all' => 'جميع المستخدمين',
                'active' => 'المستخدمين النشطين',
                'change-password' => 'تغيير كلمة السر',
                'create' => 'إنشاء مستخدم جديد',
                'deactivated' => 'المستخدمون المعطلون',
                'deleted' => 'المستخدمون المحذفون',
                'edit' => 'تعديل مستخدم',
                'main' => 'المستخدمين',
                'view' => 'View User',
            ],

            'permissions' => [
                'all' => 'جميع الأذونات',
                'create' => 'إنشاء إذن',
                'deactivated' => 'إذن معطل',
                'deleted' => 'الأذونات المحذوفة',
                'edit' => 'تحرير الإذن',
                'main' => 'أذونات',
                'view' => 'عرض الإذن',
                'management' => 'إدارة الإذن',
            ],

            'pages' => [
                'all' => 'كل الصفحات',
                'active' => 'صفحات نشطة',
                'create' => 'إنشاء صفحة',
                'deactivated' => 'الصفحات المعطلة',
                'deleted' => 'الصفحات المحذوفة',
                'edit' => 'تعديل الصفحة',
                'main' => 'الصفحات',
                'view' => 'عرض الصفحة',
            ],

            'blogs' => [
                'all' => 'جميع المدونات',
                'active' => 'مدونات نشطة',
                'create' => 'انشاء مدونة',
                'deactivated' => 'مدونات معطلة',
                'deleted' => 'المدونات المحذوفة',
                'edit' => 'تحرير مدونة',
                'main' => 'المدونات',
                'view' => 'عرض المدونة',
            ],

            'blog-categories' => [
                'all' => 'جميع فئات المدونة',
                'active' => 'فئات المدونة النشطة',
                'create' => 'إنشاء فئة مدونة',
                'deactivated' => 'فئات المدونات المعطلة',
                'deleted' => 'فئات المدونات المحذوفة',
                'edit' => 'تحرير فئة المدونة',
                'main' => 'فئات المدونة',
                'view' => 'عرض فئة المدونة',
            ],

            'blog-tags' => [
                'all' => 'جميع علامات المدونة',
                'active' => 'علامات بلوق النشطة',
                'create' => 'إنشاء علامة مدونة',
                'deactivated' => 'علامات المدونة المعطلة',
                'deleted' => 'علامات المدونات المحذوفة',
                'edit' => 'تحرير علامة المدونة',
                'main' => 'علامات المدونة',
                'view' => 'عرض علامة المدونة',
            ],

            'faqs' => [
                'all' => 'جميع الأسئلة الشائعة',
                'active' => 'الأسئلة الشائعة',
                'create' => 'إنشاء الأسئلة',
                'deactivated' => 'الأسئلة المتداولة',
                'deleted' => 'الأسئلة الشائعة المحذوفة',
                'edit' => 'تحرير الأسئلة المتكررة',
                'main' => 'أسئلة وأجوبة بلوق',
                'view' => 'عرض الأسئلة المتكررة',
            ],

            'email-templates' => [
                'all' => 'جميع قوالب البريد الإلكتروني',
                'active' => 'قوالب البريد الإلكتروني النشطة',
                'create' => 'إنشاء قالب البريد الإلكتروني',
                'deactivated' => 'قوالب البريد الإلكتروني المعطل',
                'deleted' => 'قوالب البريد الإلكتروني المحذوفة',
                'edit' => 'تحرير قالب البريد الإلكتروني',
                'main' => 'قوالب البريد الإلكتروني للمدونة',
                'view' => 'عرض قالب البريد الإلكتروني',
            ],
        ],

        'log-viewer' => [
            'main' => 'عارض السجلات',
            'dashboard' => 'اللوحة الرئيسية',
            'logs' => 'السجلات',
        ],

        'sidebar' => [
            'dashboard' => 'اللوحة الرئيسية',
            'general' => 'عام',
            'history' => 'التاريخ',
            'system' => 'النظام',
            'blogs' => 'إدارة المدونة',
            'pages' => 'إدارة الصفحات',
            'faqs' => 'إدارة الأسئلة المتداولة',
            'email-templates' => 'قوالب البريد الإلكتروني',
        ],
    ],

    'language-picker' => [
        'language' => 'اللغة',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'عربى (Arabic)',
            'en' => 'English',
        ],
    ],
];
