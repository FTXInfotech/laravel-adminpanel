<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'Rol creado correctamente.',
            'deleted' => 'Rol eliminado correctamente.',
            'updated' => 'Rol actualizado correctamente.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'La aplicación está actualmente configurada para aprobación manual de usuarios.',
            'confirmation_email' => 'Un nuevo mensaje de confirmación ha sido enviado a su correo.',
            'confirmed' => 'El usuario fue confirmado correctamente.',
            'created' => 'El usuario fue creado correctamente.',
            'deleted' => 'El usuario fue eliminado correctamente.',
            'deleted_permanently' => 'El usuario fue eliminado de forma permanente.',
            'restored' => 'El usuario fue restaurado correctamente.',
            'session_cleared' => 'La sesión del usuario se borró correctamente.',
            'social_deleted' => 'La cuenta social fue eliminada correctamente.',
            'unconfirmed' => 'El usuario fue desconfirmado correctamente',
            'updated' => 'El usuario fue actualizado correctamente.',
            'updated_password' => 'La contraseña fue actualizada correctamente.',
        ],

        'blogs' => [
            'created'               => 'El blog fue creado exitosamente.',
            'deleted'               => 'El blog fue eliminado exitosamente.',
            'deleted_permanently'   => 'El blog fue eliminado permanentemente.',
            'restored'              => 'El blog fue restaurado exitosamente.',
            'updated'               => 'El blog se actualizó con éxito.'
        ],

        'blog-category' => [
            'created'               => 'La categoría del blog se creó con éxito.',
            'deleted'               => 'La categoría del blog se eliminó correctamente.',
            'deleted_permanently'   => 'La categoría del blog se eliminó de forma permanente.',
            'restored'              => 'La categoría del blog se restauró con éxito.',
            'updated'               => 'La categoría del blog se actualizó correctamente.'
        ],

        'blog-tags' => [
            'created'               => 'La etiqueta del blog se creó correctamente.',
            'deleted'               => 'La etiqueta del blog se eliminó correctamente.',
            'deleted_permanently'   => 'La etiqueta del blog se eliminó de forma permanente.',
            'restored'              => 'La etiqueta del blog se restauró correctamente.',
            'updated'               => 'La etiqueta del blog se actualizó correctamente.'
        ],

        'pages' => [
            'created'               => 'La página fue creada exitosamente.',
            'deleted'               => 'La página se eliminó correctamente.',
            'deleted_permanently'   => 'La página fue eliminada permanentemente.',
            'restored'              => 'La página fue restaurada exitosamente.',
            'updated'               => 'La página se actualizó correctamente.'
        ],

        'faqs' => [
            'created'               => 'El faq fue creado exitosamente.',
            'deleted'               => 'La faq se eliminó con éxito.',
            'deleted_permanently'   => 'La faq fue eliminada permanentemente.',
            'restored'              => 'El faq fue restaurado exitosamente.',
            'updated'               => 'Las preguntas frecuentes se actualizaron correctamente.'
        ],

        'email-templates' => [
            'created'               => 'La plantilla de correo electrónico se creó correctamente.',
            'deleted'               => 'La plantilla de correo electrónico se eliminó correctamente.',
            'deleted_permanently'   => 'La plantilla de correo electrónico se eliminó permanentemente.',
            'restored'              => 'La plantilla de correo electrónico se restauró correctamente.',
            'updated'               => 'La plantilla de correo electrónico se actualizó correctamente.'
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Su información fue enviada correctamente. Responderemos tan pronto sea posible al e-mail que proporcionó.',
        ],
    ],
];
