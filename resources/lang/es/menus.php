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
            'title' => 'Administración de acceso',

            'roles' => [
                'all' => 'Todos los Roles',
                'create' => 'Nuevo Rol',
                'edit' => 'Modificar Rol',
                'management' => 'Administración de Roles',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'Todos los Usuarios',
                'change-password' => 'Cambiar la contraseña',
                'create' => 'Nuevo Usuario',
                'deactivated' => 'Usuarios Desactivados',
                'deleted' => 'Usuarios Eliminados',
                'edit' => 'Modificar Usuario',
                'main' => 'Usuario',
                'view' => 'Ver Usuario',
            ],

            'permissions' => [
                'all'           => 'Todos los permisos',
                'create'        => 'Crear permiso',
                'deactivated'   => 'Permiso desactivado',
                'deleted'       => 'Permisos eliminados',
                'edit'          => 'Editar permiso',
                'main'          => 'Permisos',
                'view'          => 'Ver permiso',
                'management'    => 'Gestión de permisos',
            ],

            'pages' => [
                'all'             => 'Todas las páginas',
                'active'          => 'Páginas activas',
                'create'          => 'Crear página',
                'deactivated'     => 'Páginas desactivadas',
                'deleted'         => 'Páginas eliminadas',
                'edit'            => 'Editar página',
                'main'            => 'Páginas',
                'view'            => 'Ver pagina',
            ],

            'blogs' => [
                'all'             => 'Todos los blogs',
                'active'          => 'Blogs activos',
                'create'          => 'Blog creativo',
                'deactivated'     => 'Blogs desactivados',
                'deleted'         => 'Blogs eliminados',
                'edit'            => 'Editar blog',
                'main'            => 'Blogs',
                'view'            => 'Ver blog',
            ],

            'blog-categories' => [
                'all'             => 'Todas las categorías del blog',
                'active'          => 'Categorías de blog activas',
                'create'          => 'Crear categoría de blog',
                'deactivated'     => 'Categorías de blog desactivadas',
                'deleted'         => 'Categorías de blog eliminadas',
                'edit'            => 'Editar categoría del blog',
                'main'            => 'Categorías de blog',
                'view'            => 'Ver categoría del blog',
            ],

            'blog-tags' => [
                'all'             => 'Todas las etiquetas de blog',
                'active'          => 'Etiquetas de blog activas',
                'create'          => 'Crear etiqueta de blog',
                'deactivated'     => 'Etiquetas de blog desactivadas',
                'deleted'         => 'Etiquetas de blog eliminadas',
                'edit'            => 'Editar etiqueta de blog',
                'main'            => 'Etiquetas de blog',
                'view'            => 'Ver etiqueta de blog',
            ],

            'faqs' => [
                'all'             => 'Todas las preguntas frecuentes',
                'active'          => 'Preguntas frecuentes activas',
                'create'          => 'Crear preguntas frecuentes',
                'deactivated'     => 'Preguntas frecuentes desactivadas',
                'deleted'         => 'Preguntas frecuentes eliminadas',
                'edit'            => 'Editar preguntas frecuentes',
                'main'            => 'Preguntas frecuentes del blog',
                'view'            => 'Ver preguntas frecuentes',
            ],

            'email-templates' => [
                'all'             => 'Todas las plantillas de correo electrónico',
                'active'          => 'Plantillas de correo electrónico activas',
                'create'          => 'Crear plantilla de correo electrónico',
                'deactivated'     => 'Plantillas de correo electrónico desactivadas',
                'deleted'         => 'Plantillas de correo electrónico eliminadas',
                'edit'            => 'Editar plantilla de correo electrónico',
                'main'            => 'Plantillas de correo electrónico de blog',
                'view'            => 'Ver plantilla de correo electrónico',
            ],
        ],

        'log-viewer' => [
            'main' => 'Gestor de Logs',
            'dashboard' => 'Principal',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard'             => 'Principal',
            'general'               => 'General',
            'history'               => 'Historia',
            'system'                => 'Sistema',
            'blogs'                 => 'Gestión de blogs',
            'pages'                 => 'Gestión de páginas',
            'faqs'                  => 'Gestión de preguntas frecuentes',
            'email-templates'       => 'Plantillas de correo electrónico'
        ],
    ],

    'language-picker' => [
        'language' => 'Idioma',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'العربية (Arabic)',
            'az' => 'Azerbaijan',
            'zh' => '(Chinese Simplified)',
            'zh-TW' => '(Chinese Traditional)',
            'da' => 'Danés (Danish)',
            'de' => 'Alemán (German)',
            'el' => '(Greek)',
            'en' => 'Inglés (English)',
            'es' => 'Español (Spanish)',
            'fa' => 'Persa (Persian)',
            'fr' => 'Francés (French)',
            'he' => 'Hebreo (Hebrew)',
            'id' => 'Indonesio (Indonesian)',
            'it' => 'Italiano (Italian)',
            'ja' => '(Japanese)',
            'nl' => 'Holandés (Dutch)',
            'no' => 'Noruego (Norwegian)',
            'pt_BR' => 'Portugués Brasileño',
            'ru' => 'Russian (Russian)',
            'sv' => 'Sueco (Swedish)',
            'th' => '(Thai)',
            'tr' => '(Turkish)',
            'uk' => '(Ukrainian)',
        ],
    ],
];
