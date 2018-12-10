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
            'title'  => 'Gestion des accès',
            'export' => 'Export',
            'copy'   => 'Copie',
            'print'  => 'Impression',

            'roles' => [
                'all'        => 'Tous les rôles',
                'create'     => 'Créer un rôle',
                'edit'       => 'Éditer un rôle',
                'management' => 'Gestion des rôles',
                'main'       => 'Rôles',
            ],

            'permissions' => [
                'all'        => 'Toutes les permissions',
                'create'     => 'Créer une permission',
                'edit'       => 'Modifier une permission',
                'management' => 'Gérer une permission',
                'main'       => 'Permissions',
            ],

            'users' => [
                'all'               => 'Tous les utilisateurs',
                'change-password'   => 'Changer le mot de passe',
                'create'            => 'Créer un utilisateur',
                'deactivated'       => 'Utilisateurs désactivés',
                'deleted'           => 'Utilisateurs supprimés',
                'edit'              => 'Éditer un utilisateur',
                'main'              => 'Utilisateurs',
                'view'              => 'Voir un utilisateur',
                'action'            => 'Action',
                'list'              => 'Liste',
                'add-new'           => 'Ajouter nouveau',
                'deactivated-users' => 'Utilisateurs désactivés',
                'deleted-users'     => 'Utilisateurs supprimés',
            ],
        ],

        'log-viewer' => [
            'main'      => 'Consulter les logs',
            'dashboard' => 'Tableau de bord',
            'logs'      => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Tableau de bord',
            'general'   => 'Général',
            'system'    => 'Système',
        ],

        'pages' => [
            'all'        => 'Toutes les pages',
            'create'     => 'Créer une page',
            'edit'       => 'Modifier une page',
            'management' => 'Gérer une page',
            'main'       => 'Pages',
        ],

        'blogs' => [
            'all'        => 'Tous les blogs',
            'create'     => 'Créer un blog',
            'edit'       => 'Modifier un blog',
            'management' => 'Gérer un blog',
            'main'       => 'Blogs',
        ],

        'blogcategories' => [
            'all'        => 'Toutes les catégories de blog',
            'create'     => 'Créer une catégories de blog',
            'edit'       => 'Modifier une catégories de blog',
            'management' => 'Gérer une catégories de blog',
            'main'       => 'Pages CMS',
        ],

        'blogtags' => [
            'all'        => 'Tous les tags de blog',
            'create'     => 'Créer un tags de blog',
            'edit'       => 'Modifier un tags de blog',
            'management' => 'Gérer un tags de blog',
            'main'       => 'Tags de blog',
        ],

        'blog' => [
            'all'        => 'Tous les blog',
            'create'     => 'Créer un blog',
            'edit'       => 'Modifier un blog',
            'management' => 'Gérer un blog',
            'main'       => 'Pages de blog',
        ],

        'faqs' => [
            'all'        => 'Toutes les FAQ',
            'create'     => 'Créer une FAQ',
            'edit'       => 'Modifier une FAQ',
            'management' => 'Gérer une FAQ',
            'main'       => 'Pages des FAQ',
        ],

        'settings' => [
            'all'        => 'Tous les réglages',
            'create'     => 'Créer un réglage',
            'edit'       => 'Modifier un réglage',
            'management' => 'Gérer un réglage',
            'main'       => 'Réglages',
        ],

        'menus' => [
            'all'        => 'Tous les menus',
            'create'     => 'Créer un menu',
            'edit'       => 'Modifier un menu',
            'management' => 'Gérer un menu',
            'main'       => 'Menus',
        ],

        'modules' => [
            'all'        => 'Tous les modules',
            'create'     => 'Créer un module',
            'management' => 'Gérer un module',
            'main'       => 'Pages des modules',
        ],
    ],

    'language-picker' => [
        'language' => 'Langue',
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
