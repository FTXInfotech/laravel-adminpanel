<?php

return [

    'messages' => [
        'registeration' => [
            'success' => "Vous vous êtes enregistré avec succès. Veuillez vérifier vos emails pour l'activation !",
        ],
        'login' => [
            'success' => 'Vous vous êtes connecté avec succès.',
            'failed'  => 'Informations incorrectes. Veuille essayer à nouveau..',
        ],
        'logout' => [
            'success' => 'Vous vous êtes déconnecté avec succès.',
        ],
        'forgot_password' => [
            'success'    => 'Nous avons envoyé un email avec un lien pour le renouvellement du mot de passe. Veuillez consulter votre boîte de réception !',
            'validation' => [
                'email_not_found' => "Cette adresse email n'est pas enregistrée.",
            ],
        ],
        'refresh' => [
            'token' => [
                'not_provided' => 'Jeton non fourni.',
            ],
            'status' => 'Ok',
        ],
    ],

];
