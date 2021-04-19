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
                'already_exists' => 'That role already exists. Please choose a different name.',
                'create_error' => 'There was a problem creating this role. Please try again.',
                'delete_error' => 'There was a problem deleting this role. Please try again.',
                'update_error' => 'There was a problem updating this role. Please try again.',
                'cant_delete_admin' => 'You can not delete the Administrator role.',
                'has_users' => 'You can not delete a role with associated users.',
                'needs_permission' => 'You must select at least one permission for this role.',
            ],

            'users' => [
                'create_error' => 'There was a problem creating this user. Please try again.',
                'delete_error' => 'There was a problem deleting this user. Please try again.',
                'update_error' => 'There was a problem updating this user. Please try again.',
                'already_confirmed' => 'This user is already confirmed.',
                'cant_confirm' => 'There was a problem confirming the user account.',
                'cant_deactivate_self' => 'You can not do that to yourself.',
                'cant_delete_admin' => 'You can not delete the super administrator.',
                'cant_delete_self' => 'You can not delete yourself.',
                'cant_delete_own_session' => 'You can not delete your own session.',
                'cant_restore' => 'This user is not deleted so it can not be restored.',
                'cant_unconfirm_admin' => 'You can not un-confirm the super administrator.',
                'cant_unconfirm_self' => 'You can not un-confirm yourself.',
                'delete_first' => 'This user must be deleted first before it can be destroyed permanently.',
                'email_error' => 'That email address belongs to a different user.',
                'mark_error' => 'There was a problem updating this user. Please try again.',
                'not_confirmed' => 'This user is not confirmed.',
                'not_found' => 'That user does not exist.',
                'restore_error' => 'There was a problem restoring this user. Please try again.',
                'role_needed_create' => 'You must choose at lease one role.',
                'role_needed' => 'You must choose at least one role.',
                'social_delete_error' => 'There was a problem removing the social account from the user.',
                'update_password_error' => 'There was a problem changing this users password. Please try again.',
            ],
        ],

        'blogs' => [
            // 'already_exists' => 'That Blog already exists. Please choose a different name.',
            'create_error' => 'There was a problem creating this Blog. Please try again.',
            'delete_error' => 'There was a problem deleting this Blog. Please try again.',
            'update_error' => 'There was a problem updating this Blog. Please try again.',
        ],

        'blog-category' => [
            'already_exists' => 'That Blog Category already exists. Please choose a different name.',
            'create_error' => 'There was a problem creating this Blog Category. Please try again.',
            'delete_error' => 'There was a problem deleting this Blog Category. Please try again.',
            'update_error' => 'There was a problem updating this Blog Category. Please try again.',
        ],

        'blog-tag' => [
            'already_exists' => 'That Blog Tag already exists. Please choose a different name.',
            'create_error' => 'There was a problem creating this Blog Tag. Please try again.',
            'delete_error' => 'There was a problem deleting this Blog Tag. Please try again.',
            'update_error' => 'There was a problem updating this Blog Tag. Please try again.',
        ],

        'pages' => [
            'already_exists' => 'That Page already exists. Please choose a different name.',
            'create_error' => 'There was a problem creating this Page. Please try again.',
            'delete_error' => 'There was a problem deleting this Page. Please try again.',
            'update_error' => 'There was a problem updating this Page. Please try again.',
        ],

        'faqs' => [
            // 'already_exists' => 'That Faq already exists. Please choose a different name.',
            'create_error' => 'There was a problem creating this Faq. Please try again.',
            'delete_error' => 'There was a problem deleting this Faq. Please try again.',
            'update_error' => 'There was a problem updating this Faq. Please try again.',
        ],
        'email-templates' => [
            'already_exists' => 'That Email Template already exists. Please choose a different title.',
            'create_error' => 'There was a problem creating this Email Template. Please try again.',
            'delete_error' => 'There was a problem deleting this Email Template. Please try again.',
            'update_error' => 'There was a problem updating this Email Template. Please try again.',
        ],
    ],

    'frontend' => [
        'auth' => [
            'confirmation' => [
                'already_confirmed' => 'Your account is already confirmed.',
                'confirm' => 'Confirm your account!',
                'created_confirm' => 'Your account was successfully created. We have sent you an e-mail to confirm your account.',
                'created_pending' => 'Your account was successfully created and is pending approval. An e-mail will be sent when your account is approved.',
                'mismatch' => 'Your confirmation code does not match.',
                'not_found' => 'That confirmation code does not exist.',
                'pending' => 'Your account is currently pending approval.',
                'resend' => 'Your account is not confirmed. Please click the confirmation link in your e-mail, or <a href=":url">click here</a> to resend the confirmation e-mail.',
                'success' => 'Your account has been successfully confirmed!',
                'resent' => 'A new confirmation e-mail has been sent to the address on file.',
            ],

            'deactivated' => 'Your account has been deactivated.',
            'email_taken' => 'That e-mail address is already taken.',

            'password' => [
                'change_mismatch' => 'That is not your old password.',
                'reset_problem' => 'There was a problem resetting your password. Please resend the password reset email.',
            ],

            'registration_disabled' => 'Registration is currently closed.',
        ],
    ],
];
