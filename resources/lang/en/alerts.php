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
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed' => 'The user was successfully confirmed.',
            'created' => 'The user was successfully created.',
            'deleted' => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored' => 'The user was successfully restored.',
            'session_cleared' => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated' => 'The user was successfully updated.',
            'updated_password' => "The user's password was successfully updated.",
        ],

        'blogs' => [
            'created'               => 'The blog was successfully created.',
            'deleted'               => 'The blog was successfully deleted.',
            'deleted_permanently'   => 'The blog was deleted permanently.',
            'restored'              => 'The blog was successfully restored.',
            'updated'               => 'The blog was successfully updated.'
        ],

        'blog-category' => [
            'created'               => 'The blog category was successfully created.',
            'deleted'               => 'The blog category was successfully deleted.',
            'deleted_permanently'   => 'The blog category was deleted permanently.',
            'restored'              => 'The blog category was successfully restored.',
            'updated'               => 'The blog category was successfully updated.'
        ],

        'blog-tags' => [
            'created'               => 'The blog tag was successfully created.',
            'deleted'               => 'The blog tag was successfully deleted.',
            'deleted_permanently'   => 'The blog tag was deleted permanently.',
            'restored'              => 'The blog tag was successfully restored.',
            'updated'               => 'The blog tag was successfully updated.'
        ],

        'pages' => [
            'created'               => 'The page was successfully created.',
            'deleted'               => 'The page was successfully deleted.',
            'deleted_permanently'   => 'The page was deleted permanently.',
            'restored'              => 'The page was successfully restored.',
            'updated'               => 'The page was successfully updated.'
        ],

        'faqs' => [
            'created'               => 'The faq was successfully created.',
            'deleted'               => 'The faq was successfully deleted.',
            'deleted_permanently'   => 'The faq was deleted permanently.',
            'restored'              => 'The faq was successfully restored.',
            'updated'               => 'The faq was successfully updated.'
        ],

        'email-templates' => [
            'created'               => 'The email template was successfully created.',
            'deleted'               => 'The email template was successfully deleted.',
            'deleted_permanently'   => 'The email template was deleted permanently.',
            'restored'              => 'The email template was successfully restored.',
            'updated'               => 'The email template was successfully updated.'
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];
