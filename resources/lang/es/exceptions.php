<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Exception Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in Exceptions thrown throughout the system.
    | Regardless where it is placed, a button can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'roles' => [
                'already_exists' => 'Este Rol ya existe. Por favor, especifique un nombre de Rol diferente.',
                'cant_delete_admin' => 'No puede eliminar el Rol de Administrador.',
                'create_error' => 'Hubo un problema al crear el Rol. Inténtelo de nuevo.',
                'delete_error' => 'Hubo un problema al eliminar el Rol. Inténtelo de nuevo.',
                'has_users' => 'No puede eliminar un Rol que tenga Usuarios asignados.',
                'needs_permission' => 'Debe seleccionar al menos un permiso para cada Rol.',
                'not_found' => 'El Rol requerido no existe.',
                'update_error' => 'Hubo un problema al modificar el Rol. Inténtelo de nuevo.',
            ],

            'users' => [
                'already_confirmed' => 'Este Usuario ya fue confirmado.',
                'cant_confirm' => 'Hubo un problema al confirmar la cuenta de Usuario.',
                'cant_deactivate_self' => 'No puede desactivarse a sí mismo.',
                'cant_delete_admin' => 'No puede eliminar el superadministrador.',
                'cant_delete_self' => 'No puede eliminarse a sí mismo.',
                'cant_delete_own_session' => 'No puedes borrar su propia sesión.',
                'cant_restore' => 'Este Usuario no fue eliminado, por lo que no se puede restaurar.',
                'cant_unconfirm_admin' => 'No puede anular la confirmación del superadministrador.',
                'cant_unconfirm_self' => 'No puede anular su propia confirmación.',
                'create_error' => 'Hubo un problema al crear el Usuario. Inténtelo de nuevo.',
                'delete_error' => 'Hubo un problema al eliminar el Usuario. Inténtelo de nuevo.',
                'delete_first' => 'Este Usuario debe ser eliminado primero antes de que pueda ser destruido permanentemente.',
                'email_error' => 'Ya hay un Usuario con la dirección de e-mail especificada.',
                'mark_error' => 'Hubo un problema al modificar el Usuario. Inténtelo de nuevo.',
                'not_confirmed' => 'Este Usuario no está confirmado.',
                'not_found' => 'El Usuario requerido no existe.',
                'restore_error' => 'Hubo un problema al restaurar el Usuario. Inténtelo de nuevo.',
                'role_needed_create' => 'Los Usuarios deben tener al menos un Rol.',
                'role_needed' => 'Debe elegir al menos un Rol.',
                'social_delete_error' => 'Hubo un problema al eliminar la cuenta social del Usuario.',
                'update_error' => 'Hubo un problema al modificar el Usuario. Inténtelo de nuevo.',
                'update_password_error' => 'Hubo un problema al cambiar la contraseña. Inténtelo de nuevo.',
            ],

            'blogs' => [
                'already_exists' => 'Ese blog ya existe. Por favor elige un nombre diferente.',
                'create_error'   => 'Hubo un problema al crear este Blog. Inténtalo de nuevo.',
                'delete_error'   => 'Hubo un problema al eliminar este Blog. Inténtalo de nuevo.',
                'not_found'      => 'Ese blog no existe.',
                'update_error'   => 'Hubo un problema al actualizar este Blog. Inténtalo de nuevo.',
            ],

            'blog-category' => [
                'already_exists' => 'Esa categoría de blog ya existe. Por favor elige un nombre diferente.',
                'create_error'   => 'Se produjo un problema al crear esta categoría de blog. Inténtalo de nuevo.',
                'delete_error'   => 'Hubo un problema al eliminar esta categoría de blog. Inténtalo de nuevo.',
                'not_found'      => 'Esa categoría de blog no existe.',
                'update_error'   => 'Hubo un problema al actualizar esta categoría de blog. Inténtalo de nuevo.',
            ],

            'blog-tag' => [
                'already_exists' => 'Esa etiqueta de blog ya existe. Por favor elige un nombre diferente.',
                'create_error'   => 'Se produjo un problema al crear esta etiqueta de blog. Inténtalo de nuevo.',
                'delete_error'   => 'ubo un problema al eliminar esta etiqueta de blog. Inténtalo de nuevo.',
                'not_found'      => 'Esa etiqueta de blog no existe.',
                'update_error'   => 'Hubo un problema al actualizar esta etiqueta de blog. Inténtalo de nuevo.',
            ],

            'pages' => [
                'already_exists' => 'Esa página ya existe. Por favor elige un nombre diferente.',
                'create_error'   => 'Hubo un problema al crear esta página. Inténtalo de nuevo.',
                'delete_error'   => 'Hubo un problema al eliminar esta página. Inténtalo de nuevo.',
                'not_found'      => 'Esa página no existe.',
                'update_error'   => 'Hubo un problema al actualizar esta página. Inténtalo de nuevo.',
            ],

            'faqs' => [
                'already_exists' => 'Ese Faq ya existe. Por favor elige un nombre diferente.',
                'create_error'   => 'Hubo un problema al crear este Faq. Inténtalo de nuevo.',
                'delete_error'   => 'Hubo un problema al eliminar este Faq. Inténtalo de nuevo.',
                'not_found'      => 'Que las preguntas frecuentes no existen.',
                'update_error'   => 'Hubo un problema al actualizar este Faq. Inténtalo de nuevo.',
            ],

            'email-templates' => [
                'already_exists' => 'Esa plantilla de correo electrónico ya existe. Por favor elige un título diferente.',
                'create_error'   => 'Hubo un problema al crear esta plantilla de correo electrónico. Inténtalo de nuevo.',
                'delete_error'   => 'Hubo un problema al eliminar esta plantilla de correo electrónico. Inténtalo de nuevo.',
                'not_found'      => 'Esa plantilla de correo electrónico no existe.',
                'update_error'   => 'Hubo un problema al actualizar esta plantilla de correo electrónico. Inténtalo de nuevo.',
            ],
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Su cuenta ya ha sido verificada.',
                'confirm' => '¡Revise su correo y verifique su cuenta!',
                'created_confirm' => 'Su cuenta ha sido creada. Le hemos enviado un e-mail con un enlace de verificación.',
                'created_pending' => 'Su cuenta fue creada con éxito y está pendiente de aprobación. Se enviará un correo electrónico cuando su cuenta sea aprobada.',
                'mismatch' => 'El código de verificación no coincide.',
                'not_found' => 'El código de verificación especificado no existe.',
                'pending' => 'Su cuenta esta actualmente pendiente de aprobación',
                'resend' => 'Su cuenta no ha sido verificada todavía. Por favor, revise su e-mail, o <a href=":url">pulse aquí</a> para re-enviar el correo de verificación.',
                'success' => '¡Su cuenta ha sido verificada satisfactoriamente!',
                'resent' => 'Un nuevo correo de verificación le ha sido enviado.',
            ],

            'deactivated' => 'Su cuenta ha sido desactivada.',
            'email_taken' => 'El correo especificado ya está registrado.',

            'password' => [
                'change_mismatch' => 'La contraseña antigua no coincide.',
                'reset_problem' => 'Hubo un problema al restablecer su contraseña. Por favor, vuelva a enviar el correo electrónico de restablecimiento de contraseña',
            ],

            'registration_disabled' => 'Los registros se encuentran actualmente cerrados.',
        ],
    ],
];
