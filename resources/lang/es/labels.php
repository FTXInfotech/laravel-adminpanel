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
        'all' => 'Todos',
        'yes' => 'Sí',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Personalizado',
        'actions' => 'Acciones',
        'active' => 'Activo',
        'buttons' => [
            'save' => 'Guardar',
            'update' => 'Actualizar',
        ],
        'hide' => 'Ocultar',
        'inactive' => 'Inactivo',
        'none' => 'Ningúno',
        'show' => 'Mostrar',
        'toggle_navigation' => 'Abrir/Cerrar menú de navegación',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Crear Rol',
                'edit' => 'Modificar Rol',
                'management' => 'Administración de Roles',

                'table' => [
                    'number_of_users' => 'Número de Usuarios',
                    'permissions' => 'Permisos',
                    'role' => 'Rol',
                    'sort' => 'Orden',
                    'total' => 'Todos los Roles',
                ],
            ],

            'users' => [
                'active' => 'Usuarios activos',
                'all_permissions' => 'Todos los Permisos',
                'change_password' => 'Cambiar la contraseña',
                'change_password_for' => 'Cambiar la contraseña para :user',
                'create' => 'Crear Usuario',
                'deactivated' => 'Usuarios desactivados',
                'deleted' => 'Usuarios eliminados',
                'edit' => 'Modificar Usuario',
                'management' => 'Administración de Usuarios',
                'no_permissions' => 'Sin Permisos',
                'no_roles' => 'No hay Roles disponibles.',
                'permissions' => 'Permisos',

                'table' => [
                    'confirmed' => 'Confirmado',
                    'created' => 'Creado',
                    'email' => 'Correo',
                    'id' => 'ID',
                    'last_updated' => 'Última modificación',
                    'name' => 'Nombre',
                    'first_name' => 'Nombre',
                    'last_name' => 'Apellidos',
                    'no_deactivated' => 'Ningún Usuario desactivado disponible',
                    'no_deleted' => 'Ningún Usuario eliminado disponible',
                    'other_permissions' => 'Otros Permisos',
                    'permissions' => 'Permisos',
                    'roles' => 'Roles',
                    'social' => 'Cuenta Social',
                    'total' => 'Todos los Usuarios',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Resúmen',
                        'history' => 'Historia',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmado',
                            'created_at' => 'Creación',
                            'deleted_at' => 'Eliminación',
                            'email' => 'E-mail',
                            'last_login_at' => 'Último login',
                            'last_login_ip' => 'IP último login',
                            'last_updated' => 'Última Actualización',
                            'name' => 'Nombre',
                            'first_name' => 'Nombre',
                            'last_name' => 'Apellidos',
                            'status' => 'Estado',
                            'timezone' => 'Zona horaria',
                        ],
                    ],
                ],

                'view' => 'Ver Usuario',
            ],

            'blogs' => [
                'all'                   => 'Todos los blogs',
                'active'                => 'Lista de blogs',
                'create'                => 'Blog creativo',
                'deactivated'           => 'Blogs desactivados',
                'deleted'               => 'Blog eliminado',
                'edit'                  => 'Editar blog',
                'management'            => 'Gestión de blogs',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'title'             => 'Titulo de Blog',
                    'category'          => 'Categorías de blog',
                    'published'         => 'Fecha y hora de publicación',
                    'featured_image'    => 'Foto principal',
                    'content'           => 'Contenido',
                    'tags'              => 'Etiquetas',
                    'meta_title'        => 'Meta título',
                    'slug'              => 'Babosa',
                    'cannonical_link'   => 'Enlace canónico',
                    'meta_keywords'     => 'Meta palabras clave',
                    'meta_description'  => 'Metadescripción',
                    'status'            => 'Estado',
                    'createdby'         => 'Creado por',
                    'createdat'         => 'Creado en',
                    'total'             => 'total de blogs|total de blogs',
                ],
            ],

            'blog-category' => [
                'all'                   => 'Todas las categorías del blog',
                'active'                => 'Lista de categorías del blog',
                'create'                => 'Crear categoría de blog',
                'deactivated'           => 'Categoría de blog desactivada',
                'deleted'               => 'Categoría de blog eliminada',
                'edit'                  => 'Editar categoría del blog',
                'management'            => 'Categorías de blog',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'name'              => 'nombre de la categoría',
                    'category'          => 'Categorías de blog',
                    'status'            => 'Estado',
                    'createdby'         => 'Creado por',
                    'createdat'         => 'Creado en',
                    'total'             => 'categorías totales|categorías totales',
                ],
            ],

            'blog-tag' => [
                'all'                   => 'Todas las etiquetas de blog',
                'active'                => 'Lista de etiquetas de blog',
                'create'                => 'Crear etiqueta de blog',
                'deactivated'           => 'Etiqueta de blog desactivada',
                'deleted'               => 'Etiqueta de blog eliminada',
                'edit'                  => 'Editar etiqueta de blog',
                'management'            => 'Etiquetas de blog',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'name'              => 'nombre de la categoría',
                    'tag'               => 'Etiquetas de blog',
                    'status'            => 'Estado',
                    'createdby'         => 'Creado por',
                    'createdat'         => 'Creado en',
                    'total'             => 'total de etiquetas de blog|total de etiquetas de blog',
                ],
            ],

            'pages' => [
                'all'                   => 'Todas las páginas',
                'active'                => 'Lista de páginas',
                'create'                => 'Crear página',
                'deactivated'           => 'Página desactivada',
                'deleted'               => 'Página eliminada',
                'edit'                  => 'Editar página',
                'management'            => 'Gestión de páginas',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'page_slug'         => 'Babosa de página',
                    'name'              => 'Nombre de la página',
                    'description'       => 'Descripción',
                    'cannonical_link'   => 'Enlace canónico',
                    'seo_title'         => 'Título de SEO',
                    'seo_keyword'       => 'Palabra clave SEO',
                    'seo_description'   => 'Descripción de SEO',
                    'status'            => 'Estado',
                    'createdby'         => 'Creado por',
                    'createdat'         => 'Creado en',
                    'total'             => 'total de páginas|total de páginas',
                ],
            ],

            'faqs' => [
                'all'                   => 'Todas las preguntas frecuentes',
                'active'                => 'Lista de preguntas frecuentes',
                'create'                => 'Crear preguntas frecuentes',
                'deactivated'           => 'Preguntas frecuentes desactivadas',
                'deleted'               => 'Preguntas frecuentes eliminadas',
                'edit'                  => 'Editar preguntas frecuentes',
                'management'            => 'Gestión de preguntas frecuentes',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'question'          => 'Pregunta',
                    'answer'            => 'Responder',
                    'status'            => 'Estado',
                    'createdat'         => 'Creado en',
                    'total'             => 'preguntas frecuentes totales|preguntas frecuentes totales',
                ],
            ],

            'email-templates' => [
                'all'                   => 'Todas las plantillas de correo electrónico',
                'active'                => 'Lista de plantillas de correo electrónico',
                'create'                => 'Crear plantilla de correo electrónico',
                'deactivated'           => 'Plantilla de correo electrónico desactivado',
                'deleted'               => 'Plantilla de correo electrónico eliminada',
                'edit'                  => 'Editar plantilla de correo electrónico',
                'management'            => 'Gestión de plantillas de correo electrónico',

                'table' => [
                    'created'           => 'Creada',
                    'id'                => 'CARNÉ DE IDENTIDAD',
                    'last_updated'      => 'Última actualización',
                    'slug'              => 'Babosa',
                    'title'             => 'Título de plantilla de correo electrónico',
                    'content'           => 'Contenido',
                    'status'            => 'Estado',
                    'createdat'         => 'Creado en',
                    'createdby'         => 'Creado por',
                    'total'             => 'total de plantillas de correo electrónico|total de plantillas de correo electrónico',
                ],
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Iniciar Sesión',
            'login_button' => 'Iniciar Sesión',
            'login_with' => 'Iniciar Sesión mediante :social_media',
            'register_box_title' => 'Registrarse',
            'register_button' => 'Registrarse',
            'remember_me' => 'Recordarme',
        ],

        'contact' => [
            'box_title' => 'Contáctenos',
            'button' => 'Enviar información',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Su contraseña ha expirado',
            'forgot_password' => '¿Ha olvidado su contraseña?',
            'reset_password_box_title' => 'Reiniciar contraseña',
            'reset_password_button' => 'Reiniciar contraseña',
            'update_password_button' => 'Actualizar contraseña',
            'send_password_reset_link_button' => 'Enviar el correo de verificación',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Cambiar la contraseña',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Creado el',
                'edit_information' => 'Modificar la información',
                'email' => 'Correo',
                'last_updated' => 'Última modificación',
                'name' => 'Nombre',
                'first_name' => 'Nombre',
                'last_name' => 'Apellidos',
                'update_information' => 'Actualizar la información',
            ],
        ],
    ],
];
