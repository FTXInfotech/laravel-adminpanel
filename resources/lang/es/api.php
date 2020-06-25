<?php

return [

    'messages' => [
        'registration' => [
            'success' => 'Te has registrado exitosamente. Por favor revise su correo electrónico para la activación!',
        ],
        'login' => [
            'success' => 'Inicio de sesión exitoso.',
            'failed'  => '¡Credenciales no válidas! Inténtalo de nuevo.',
        ],
        'logout' => [
            'success' => 'Salió exitosamente.',
        ],
        'forgot_password' => [
            'success'    => 'Hemos enviado un correo electrónico con el enlace para restablecer la contraseña. Por favor revise su bandeja de entrada!.',
            'validation' => [
                'email_not_found' => 'Esta dirección de email no está registrada.',
            ],
        ],
        'refresh' => [
            'token' => [
                'not_provided' => 'Token no proporcionado.',
            ],
            'status' => 'Bueno',
        ],
    ],
];