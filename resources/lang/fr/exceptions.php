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
                'already_exists'    => 'Un rôle portant ce nom existe déjà.',
                'cant_delete_admin' => 'Le rôle Administrator ne peut être supprimé.',
                'create_error'      => 'Un problème est survenu lors de la création du rôle. Veuillez réessayer.',
                'delete_error'      => 'Un problème est survenu lors de la suppression du rôle. Veuillez réessayer.',
                'has_users'         => 'Ce rôle est associé à des utilisateurs et ne peut être supprimé.',
                'needs_permission'  => 'Vous devez sélectionner au moins une permission pour ce rôle.',
                'not_found'         => "Ce rôle n'existe pas.",
                'update_error'      => 'Un problème est survenu lors de la mise à jour du rôle. Veuillez réessayer.',
            ],

            'permissions' => [
                'already_exists' => 'Cette permission existe déjà. Veuillez choisir un autre nom.',
                'create_error'   => 'Il y a eu un problème lors de la création de cette permission. Veuillez essayer à nouveau.',
                'delete_error'   => 'Il y a eu un problème lors de la suppression de cette permission. Veuillez essayer à nouveau.',
                'not_found'      => "Cette permission n'existe pas.",
                'update_error'   => 'Il y a eu un problème lors de la mise à jour de cette permission. Veuillez essayer à nouveau.',
            ],

            'users' => [
                'cant_deactivate_self'    => "Vous ne pouvez pas désactiver votre propre compte d'utilisateur.",
                'cant_delete_admin'       => "Vous ne pouvez pas supprimer le compte d'utilisateur du super administrateur.",
                'cant_delete_self'        => "Vous ne pouvez pas supprimer votre propre compte d'utilisateur.",
                'cant_delete_own_session' => 'Vous ne pouvez pas supprimer votre propre session.',
                'cant_restore'            => "Cet utilisateur n'est pas effacé et ne peut être restauré.",
                'create_error'            => "Un problème est survenu lors de la création de l'utilisateur. Veuillez réessayer.",
                'delete_error'            => "Un problème est survenu lors de la suppression de l'utilisateur. Veuillez réessayer.",
                'delete_first'            => "Cet utilisateur doit d'abord être supprimé avant de pouvoir être supprimé de façon permanente.",
                'email_error'             => 'Cette adresse email appartient à un autre utilisateur.',
                'mark_error'              => "Un problème est survenu lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'not_found'               => "Cet utilisateur n'existe pas.",
                'restore_error'           => "Un problème est survenu lors de la restauration de l'utilisateur. Veuillez réessayer.",
                'role_needed_create'      => 'Vous devez sélectionner au moins un rôle.',
                'role_needed'             => 'Vous devez sélectionner au moins un rôle.',
                'session_wrong_driver'    => 'Votre pilote de session doit être configuré avec une base de données pour utiliser cette fonctionalité.',
                'change_mismatch'         => "Ce n'est pas votre ancien mot de passe.",
                'update_error'            => "Un problème est survenu lors de la mise à jour de l'utilisateur. Veuillez réessayer.",
                'update_password_error'   => "Un problème est survenu lors du changement du mot de passe de l'utilisateur. Veuillez réessayer.",
            ],
        ],
        'pages' => [
            'already_exists' => 'Cette page existe déjà. Veuillez choisr un autre nom.',
            'create_error'   => 'Il y a eu un problème lors de la création de cette page. Veuillez essayer à nouveau.',
            'delete_error'   => 'Il y a eu un problème lors de la suppression de cette page. Veuillez essayer à nouveau.',
            'not_found'      => "Cette page n'existe pas.",
            'update_error'   => 'Il y a eu un problème lors de la mise à jour de cette page. Veuillez essayer à nouveau.',
        ],

        'blogcategories' => [
            'already_exists' => 'Cette catégorie de blog existe déjà. Veuillez choisr un autre nom.',
            'create_error'   => 'Il y a eu un problème lors de la création de cette catégorie de blog. Veuillez essayer à nouveau.',
            'delete_error'   => 'Il y a eu un problème lors de la suppression de cette catégorie de blog. Veuillez essayer à nouveau.',
            'not_found'      => "Cette catégorie de blog n'existe pas.",
            'update_error'   => 'Il y a eu un problème lors de la mise à jour de cette catégorie de blog. Veuillez essayer à nouveau.',
        ],

        'blogtags' => [
            'already_exists' => 'Ce tag de blog existe déjà. Veuillez choisr un autre nom.',
            'create_error'   => 'Il y a eu un problème lors de la création de ce tag de blog. Veuillez essayer à nouveau.',
            'delete_error'   => 'Il y a eu un problème lors de la suppression de ce tag de blog. Veuillez essayer à nouveau.',
            'not_found'      => "Ce tag de blog n'existe pas.",
            'update_error'   => 'Il y a eu un problème lors de la mise à jour de ce tag de blog. Veuillez essayer à nouveau.',
        ],

        'settings' => [
            'update_error' => 'Il y a eu un problème lors de la mise à jour de ces réglages. Veuillez essayer à nouveau.',
        ],

        'menus' => [
            'already_exists' => 'Ce menu existe déjà. Veuillez choisr un autre nom.',
            'create_error'   => 'Il y a eu un problème lors de la création de ce menu. Veuillez essayer à nouveau.',
            'delete_error'   => 'Il y a eu un problème lors de la suppression de ce menu. Veuillez essayer à nouveau.',
            'not_found'      => "Ce menu n'existe pas.",
            'update_error'   => 'Il y a eu un problème lors de la mise à jour de ce menu. Veuillez essayer à nouveau.',
         ],

        'modules' => [
            'already_exists' => 'Ce module existe déjà. Veuillez choisr un autre nom.',
            'create_error'   => 'Il y a eu un problème lors de la création de ce module. Veuillez essayer à nouveau.',
            'delete_error'   => 'Il y a eu un problème lors de la suppression de ce module. Veuillez essayer à nouveau.',
            'not_found'      => "Ce module n'existe pas.",
            'update_error'   => 'Il y a eu un problème lors de la mise à jour de ce module. Veuillez essayer à nouveau.',
          ],

    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Votre compte est déjà confirmé.',
                'confirm'           => 'Confirmez votre compte !',
                'created_confirm'   => 'Votre compte a été créé avec succès.  Un email de confirmation vous a été envoyé.',
                'created_pending'   => 'Votre compte a été créé avec succès et est en attente de validation. Un email vous sera envoyé quand votre compte sera validé.',
                'mismatch'          => 'Votre code de confirmation est invalide.',
                'not_found'         => "Votre code de confirmation n'existe pas.",
                'resend'            => 'Votre compte n\'est pas confirmé. Veuillez utiliser le lien qui vous a été envoyé par email, ou <a href=":url">cliquez ici </a> pour recevoir un nouvel email.',
                'success'           => 'Votre compte est maintenant confirmé !',
                'resent'            => "Un nouvel email a été envoyé à l'adresse enregistrée.",
            ],

            'deactivated' => 'Votre compte a été désactivé.',
            'email_taken' => 'Cet email est déjà utilisé par un compte existant.',

            'password' => [
                'change_mismatch' => "L'ancien mot de passe est incorrect.",
            ],

            'registration_disabled' => 'Registration is currently closed.',
        ],
    ],
];
