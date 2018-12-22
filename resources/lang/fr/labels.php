<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all'     => 'Tout',
        'yes'     => 'Oui',
        'no'      => 'Non',
        'custom'  => 'Personnalisé',
        'actions' => 'Actions',
        'active'  => 'Active',
        'buttons' => [
            'save'   => 'Enregistrer',
            'update' => 'Mettre à jour',
        ],
        'hide'              => 'Cacher',
        'inactive'          => 'Inactive',
        'none'              => 'Aucun',
        'show'              => 'Voir',
        'toggle_navigation' => 'Navigation',
    ],

    'backend' => [
        'profile_updated' => 'Votre profil a été mis à jour.',
        'access'          => [
            'roles' => [
                'create'     => 'Créer un rôle',
                'edit'       => 'Editer un rôle',
                'management' => 'Gestion des rôles',

                'table' => [
                    'number_of_users' => "Nombre d'utilisateurs",
                    'permissions'     => 'Permissions',
                    'role'            => 'Rôle',
                    'sort'            => 'Ordre',
                    'total'           => 'rôle total|rôles totaux',
                ],
            ],

            'permissions' => [
                'create'     => 'Crée une permission',
                'edit'       => 'Modifier une permission',
                'management' => 'Gestion des permissions',

                'table' => [
                    'permission'   => 'Permission',
                    'display_name' => 'Afficher le nom',
                    'sort'         => 'Ordre',
                    'status'       => 'Statut',
                    'total'        => 'rôle total|rôles totaux',
                ],
            ],

            'users' => [
                'active'              => 'Utilisateurs actifs',
                'all_permissions'     => 'Toutes les permissions',
                'change_password'     => 'Modifier le mot de passe',
                'change_password_for' => 'Modifier le mot de passe pour :user',
                'create'              => 'Créer un utilisateur',
                'deactivated'         => 'Utilisateurs désactivés',
                'deleted'             => 'Utilisateurs supprimés',
                'edit'                => 'Éditer un utilisateur',
                'edit-profile'        => 'Éditer un profil',
                'management'          => 'Gestion des utilisateurs',
                'no_permissions'      => 'Aucune permission',
                'no_roles'            => 'Aucun rôle à affecter.',
                'permissions'         => 'Permissions',

                'table' => [
                    'confirmed'      => 'Confirmé',
                    'created'        => 'Création',
                    'email'          => 'Adresse email',
                    'id'             => 'ID',
                    'last_updated'   => 'Mise à jour',
                    'first_name'     => 'Prénom',
                    'last_name'      => 'Nom',
                    'no_deactivated' => "Pas d'utilisateurs désactivés",
                    'no_deleted'     => "Pas d'utilisateurs supprimés",
                    'roles'          => 'Rôles',
                    'total'          => 'utilisateur total|utilisateurs totaux',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Résumé',
                        'history'  => 'Historique',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar'       => 'Avatar',
                            'confirmed'    => 'Confirmé',
                            'created_at'   => 'Créé le',
                            'deleted_at'   => 'Supprimé le',
                            'email'        => 'Adresse email',
                            'last_updated' => 'Mise à jour',
                            'name'         => 'Nom complet',
                            'status'       => 'Statut',
                        ],
                    ],
                ],

                'view' => 'Voir un utilisateur',
            ],
        ],

        'pages' => [
            'create'     => 'Créer une page',
            'edit'       => 'Modifier une page',
            'management' => 'Gérer une page',
            'title'      => 'Pages',

            'table' => [
                'title'     => 'Titre',
                'status'    => 'Statut',
                'createdat' => 'Créée le',
                'updatedat' => 'Modifiée le',
                'createdby' => 'Créée par',
                'all'       => 'Tout',
            ],
        ],

        'blogcategories' => [
            'create'     => 'Créer une catégorie de blog',
            'edit'       => 'Modifier une catégorie de blog',
            'management' => 'Gérer une catégorie de blog',
            'title'      => 'Catégorie de blog',

            'table' => [
                'title'     => 'Catégorie de blog',
                'status'    => 'Statut',
                'createdat' => 'Créée le',
                'createdby' => 'Créée par',
                'all'       => 'Tout',
            ],
        ],

        'blogtags' => [
            'create'     => 'Créer un tag de blog',
            'edit'       => 'Modifier un tag de blog',
            'management' => 'Gérer un tag de blog',
            'title'      => 'Tags de blog',

            'table' => [
                'title'     => 'Tag de blog',
                'status'    => 'Statut',
                'createdat' => 'Créé le',
                'createdby' => 'Créé par',
                'all'       => 'Tout',
            ],
        ],

        'blogs' => [
            'create'     => 'Créer un blog',
            'edit'       => 'Modifier un blog',
            'management' => 'Gérer un blog',
            'title'      => 'Blogs',

            'table' => [
                'title'     => 'Blog',
                'status'    => 'Statut',
                'createdat' => 'Créé le',
                'createdby' => 'Créé par',
                'all'       => 'Tout',
            ],
        ],

        'settings' => [
            'edit'           => 'Modifier les réglages',
            'management'     => 'Gérer les réglages',
            'title'          => 'Réglages',
            'seo'            => 'Réglages SEO',
            'companydetails' => 'Détails pour le contact de la société',
            'mail'           => 'Réglages des emails',
            'footer'         => 'Réglages du bas de page',
            'terms'          => 'Réglages des termes et conditions',
            'google'         => 'Google Analytics Track Code',
        ],

        'faqs' => [
            'create'     => 'Créer une FAQ',
            'edit'       => 'Modifier une FAQ',
            'management' => 'Gérer une FAQ',
            'title'      => 'FAQ',

            'table' => [
                'title'     => 'FAQS',
                'publish'   => 'DatePublication',
                'status'    => 'Statut',
                'createdat' => 'Créé le',
                'createdby' => 'Créé par',
                'answer'    => 'Réponse',
                'question'  => 'Question',
                'updatedat' => 'Modifié le',
                'all'       => 'Tout',
            ],
        ],

        'menus' => [
            'create'     => 'Créer un menu',
            'edit'       => 'Modifier un menu',
            'management' => 'Gérer un menu',
            'title'      => 'Menus',

            'table' => [
                'name'      => 'Nom',
                'type'      => 'Type',
                'createdat' => 'Créé le',
                'createdby' => 'Créé par',
                'all'       => 'Tout',
            ],
            'field' => [
                'name'      => 'Nom',
                'type'      => 'Type',
                'items'     => 'Elements de menu',
                'url'       => 'URL',
                'url_type'  => 'URL Type',
                'url_types' => [
                  'route'  => 'Route',
                  'static' => 'Statique',
                ],
                'open_in_new_tab'    => 'Ouvrir dans un nouvel onglet',
                'view_permission_id' => 'Permission',
                'icon'               => 'Icon Class',
                'icon_title'         => 'Font Awesome Class. eg. fa-edit',
            ],
        ],

        'modules' => [
            'create'     => 'Créer un oodule',
            'management' => 'Gérer un module',
            'title'      => 'Module',
            'edit'       => 'Modifier un module',

            'table' => [
                'name'               => 'Nom du module',
                'url'                => 'Routes du module',
                'view_permission_id' => 'Permissions de vue',
                'created_by'         => 'Créé par',
            ],

            'form' => [
                'name'                  => 'Nom du module',
                'url'                   => 'Route',
                'view_permission_id'    => 'Voir permissions',
                'directory_name'        => 'Nom du dossier',
                'namespace'             => 'Espace de nom',
                'model_name'            => 'Nom du modèle',
                'controller_name'       => 'Nom du contrôleur',
                'resource_controller'   => 'Contrôleur de ressource',
                'table_controller_name' => 'Nom du contrôleur',
                'table_name'            => 'Nom de la table',
                'route_name'            => 'Nom de la route',
                'route_controller_name' => 'Nom du contrôleur',
                'resource_route'        => 'Routes de ressource',
                'views_directory'       => 'Nom du dossier',
                'index_file'            => 'Index',
                'create_file'           => 'Création',
                'edit_file'             => 'Modification',
                'form_file'             => 'Formulaire',
                'repo_name'             => 'Nom du repository',
                'event'                 => "Nom de l'événement",
            ],
        ],

    ],

    'frontend' => [

        'auth' => [
            'login_box_title'    => 'Connexion',
            'login_button'       => 'Entrer',
            'login_with'         => 'Se connecter avec :social_media',
            'register_box_title' => "S'enregistrer",
            'register_button'    => 'Créer le compte',
            'remember_me'        => 'Se souvenir de moi',
        ],

        'passwords' => [
            'forgot_password'                 => 'Avez-vous oublié votre mot de passe&nbsp;?',
            'reset_password_box_title'        => 'Réinitialisation du mot de passe',
            'reset_password_button'           => 'Réinitialiser le mot de passe',
            'send_password_reset_link_button' => 'Envoyer le lien de réinitialisation',
        ],

        'macros' => [
            'country' => [
                'alpha'   => 'Country Alpha Codes',
                'alpha2'  => 'Country Alpha 2 Codes',
                'alpha3'  => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Exemples de macros',

            'state' => [
                'mexico' => 'Mexico State List',
                'us'     => [
                    'us'       => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed'    => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Modifier le mot de passe',
            ],

            'profile' => [
                'avatar'             => 'Avatar',
                'created_at'         => 'Date de création',
                'edit_information'   => 'Éditer les informations',
                'email'              => 'Adresse email',
                'last_updated'       => 'Date de mise à jour',
                'first_name'         => 'Prénom',
                'last_name'          => 'Nom',
                'address'            => 'Addesse',
                'state'              => 'Eata',
                'city'               => 'Ville',
                'zipcode'            => 'Code postal',
                'ssn'                => 'SSN',
                'update_information' => 'Mettre à jour les informations',
            ],
        ],

    ],
];
