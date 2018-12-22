<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => "Le champ :attribute n'est pas une URL valide.",
    'after'                => 'Le champ :attribute doit être une date postérieure au :date.',
    'after_or_equal'       => 'Le champ :attribute doit être une date postérieure ou égale au :date.',
    'alpha'                => 'Le champ :attribute doit seulement contenir des lettres.',
    'alpha_dash'           => 'Le champ :attribute doit seulement contenir des lettres, des chiffres et des tirets.',
    'alpha_num'            => 'Le champ :attribute doit seulement contenir des chiffres et des lettres.',
    'array'                => 'Le champ :attribute doit être un tableau.',
    'before'               => 'Le champ :attribute doit être une date antérieure au :date.',
    'before_or_equal'      => 'Le champ :attribute doit être une date antérieure ou égale au :date.',
    'between'              => [
        'numeric' => 'La valeur de :attribute doit être comprise entre :min et :max.',
        'file'    => 'La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.',
        'string'  => 'Le texte :attribute doit contenir entre :min et :max caractères.',
        'array'   => 'Le tableau :attribute doit contenir entre :min et :max éléments.',
    ],
    'boolean'              => 'Le champ :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champ de confirmation :attribute ne correspond pas.',
    'date'                 => "Le champ :attribute n'est pas une date valide.",
    'date_format'          => 'Le champ :attribute ne correspond pas au format :format.',
    'different'            => 'Les champs :attribute et :other doivent être différents.',
    'digits'               => 'Le champ :attribute doit contenir :digits chiffres.',
    'digits_between'       => 'Le champ :attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => 'Les dimensions de l\'image :attribute ne sont pas conformes.',
    'distinct'             => 'Le champ :attribute doit être une valeur unique.',
    'email'                => 'Le champ :attribute doit être une adresse email valide.',
    'exists'               => 'Le champ :attribute n\'existe pas.',
    'file'                 => 'Le champ :attribute doit être un fichier.',
    'filled'               => 'Le champ :attribute est obligatoire.',
    'image'                => 'Le champ :attribute doit être une image.',
    'in'                   => 'Le champ :attribute est invalide.',
    'in_array'             => "Le champ :attribute n'existe pas dans :other.",
    'integer'              => 'Le champ :attribute doit être un entier.',
    'ip'                   => 'Le champ :attribute doit être une adresse IP valide.',
    'json'                 => 'Le champ :attribute doit être un document JSON valide.',
    'max'                  => [
        'numeric' => 'La valeur de :attribute ne peut être supérieure à :max.',
        'file'    => 'La taille du fichier de :attribute ne peut pas dépasser :max kilo-octets.',
        'string'  => 'Le texte de :attribute ne peut contenir plus de :max caractères.',
        'array'   => 'Le tableau :attribute ne peut contenir plus de :max éléments.',
    ],
    'mimes'                => 'Le champ :attribute doit être un fichier de type : :values.',
    'mimetypes'            => 'Le champ :attribute doit être un fichier de type : :values.',
    'min'                  => [
        'numeric' => 'La valeur de :attribute doit être supérieure ou égale à :min.',
        'file'    => 'La taille du fichier de :attribute doit être supérieure à :min kilo-octets.',
        'string'  => 'Le texte :attribute doit contenir au moins :min caractères.',
        'array'   => 'Le tableau :attribute doit contenir au moins :min éléments.',
    ],
    'not_in'               => "Le champ :attribute sélectionné n'est pas valide.",
    'numeric'              => 'Le champ :attribute doit contenir un nombre.',
    'present'              => 'Le champ :attribute doit être présent.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => 'Le champ :attribute est obligatoire.',
    'required_if'          => 'Le champ :attribute est obligatoire lorsque :other est :value.',
    'required_unless'      => 'Le champ :attribute est obligatoire sauf si :other est :value.',
    'required_with'        => 'Le champ :attribute est obligatoire lorsque :values a une valeur.',
    'required_with_all'    => 'Le champ :attribute est obligatoire lorsque :values existe.',
    'required_without'     => 'Le champ :attribute est obligatoire lorsque :values n\'a pas de valeur.',
    'required_without_all' => 'Le champ :attribute est obligatoire lorsque :values n\'existe pas.',
    'same'                 => 'Les champs :attribute et :other doivent être identiques.',
    'size'                 => [
        'numeric' => 'Le champ :attribute doit avoir une taille de :size.',
        'file'    => 'La taille du fichier de :attribute doit être de :size kilo-octets.',
        'string'  => 'Le texte de :attribute doit contenir :size caractères.',
        'array'   => 'Le tableau :attribute doit contenir :size éléments.',
    ],
    'string'               => 'Le champ :attribute doit être une chaîne de caractères.',
    'timezone'             => 'Le champ :attribute doit être un fuseau horaire valide.',
    'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded'             => 'Le fichier du champ :attribute n\'a pu être téléchargé.',
    'url'                  => 'Le format de \'URL de :attribute n\'est pas valide.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [

        'backend' => [
            'access' => [
                'permissions' => [
                    'associated_roles' => 'Rôles associés',
                    'dependencies'     => 'Dépendances',
                    'display_name'     => 'Nom affiché',
                    'group'            => 'Groupe',
                    'group_sort'       => 'Ordre du groupe',
                    'name'             => 'Nom',
                    'sort'             => 'Ordre',

                    'groups' => [
                        'name' => 'Nom du groupe',
                    ],

                    'name'   => 'Nom complet',
                    'system' => 'Système',
                ],

                'roles' => [
                    'associated_permissions' => 'Permissions associées',
                    'name'                   => 'Nom',
                    'sort'                   => 'Ordre',
                    'active'                 => 'Actif',
                ],

                'users' => [
                    'active'                  => 'Actif',
                    'associated_roles'        => 'Rôles associés',
                    'confirmed'               => 'Confirmé',
                    'email'                   => 'Adresse email',
                    'firstName'               => 'Prénom',
                    'lastName'                => 'Nom',
                    'other_permissions'       => 'Autres permissions',
                    'old_password'            => 'Ancien mot de passe',
                    'password'                => 'Mot de passe',
                    'password_confirmation'   => 'Confirmation du mot de passe',
                    'send_confirmation_email' => 'Envoyer un email de confirmation',
                ],
            ],

            'pages' => [
                'title'           => 'Titre',
                'description'     => 'Description',
                'cannonical_link' => 'Lien canonique',
                'seo_title'       => 'Titre SEO',
                'seo_keyword'     => 'Mot-clé EO',
                'seo_description' => 'Description SEO',
                'is_active'       => 'Actif',
            ],

            'blogcategories' => [
                'title'     => 'Catégorie de blog',
                'is_active' => 'Actif',
            ],

            'blogtags' => [
                'title'     => 'Tag de blog',
                'is_active' => 'Actif',
            ],

            'blogs' => [
                'title'            => 'Titre de blog',
                'category'         => 'Catégorie de blog',
                'publish'          => 'Date et heure de publication',
                'image'            => 'Image mise en avant',
                'content'          => 'Contenu',
                'tags'             => 'Tags',
                'meta-title'       => 'Titre Meta',
                'slug'             => 'Slug',
                'cannonical_link'  => 'Lien canonique',
                'meta_keyword'     => 'Mot-clé Meta',
                'meta_description' => 'Description Meta',
                'status'           => 'Statut',
            ],

            'settings' => [
                'sitelogo'        => 'Logo du site',
                'favicon'         => 'Icône',
                'metatitle'       => 'Titre Meta',
                'metakeyword'     => 'Mots-clés Meta',
                'metadescription' => 'Description Meta',
                'companydetails'  => [
                    'address'       => 'Adresse de la société',
                    'contactnumber' => 'Numéro de contact',
                ],
                'mail' => [
                    'fromname'  => 'Nom origine',
                    'fromemail' => 'Email origine',
                ],
                'footer' => [
                    'text'      => 'Texte de bas de page',
                    'copyright' => 'Texte de copyright',
                ],
                'termscondition' => [
                    'terms'      => 'Termes & Conditione',
                    'disclaimer' => 'Avertissement',
                ],
                'google' => [
                    'analytic' => 'Google Analytics',
                ],
            ],
            'faqs' => [
                'question' => 'Question',
                'answer'   => 'Réponse',
                'status'   => 'Statut',
            ],
        ],

        'frontend' => [
            'register-user' => [
                'email'                     => 'Adresse E-mail',
                'firstName'                 => 'Prénom',
                'lastName'                  => 'Nom',
                'password'                  => 'Mot de passe',
                'address'                   => 'Adresse',
                'country'                   => 'Pays',
                'state'                     => 'Etat',
                'city'                      => 'Ville',
                'zipcode'                   => 'Code postal',
                'ssn'                       => 'SSN',
                'password_confirmation'     => 'Confirmation du mot de passe',
                'old_password'              => 'Ancien mot de passe',
                'new_password'              => 'Nouveau mot de passe',
                'new_password_confirmation' => 'Confirmation du nouveau mot de passe',
                'terms_and_conditions'      => 'termes et conditions',
            ],
        ],
    ],

    'api' => [
        'login' => [
            'email_required'                => 'Veuillez entrer votre email.',
            'valid_email'                   => 'Veuillez entrer une adresse email valide.',
            'password_required'             => 'Veuillez entrer un mot de passe.',
            'username_password_didnt_match' => 'Veuillez entrer des données valides.',
        ],

        'forgotpassword' => [
            'email_required'  => 'Veuillez entrer votre email.',
            'valid_email'     => 'Veuillez entrer une adresse email valide.',
            'email_not_valid' => "L'email que vous avez entrée n'est pas enregistré",
        ],

        'resetpassword' => [
            'email_required'            => 'Veuillez entrer votre email.',
            'valid_email'               => 'Veuillez entrer une adresse email valide.',
            'password_required'         => 'Veuillez entrer un mot de passe.',
            'password_confirmed'        => 'Le mot de passe et sa confirmation ne concordent pas.',
            'token_required'            => 'Veuillez entrer un jeton.',
            'confirm_password_required' => 'Veuillez confirmer cotre mot de passe.',
            'token_not_valid'           => "Le jeton n'est pas valide.",
            'email_not_valid'           => "L'email que vous avez entrée n'est pas enregistré",
        ],
        'register' => [
            'state_required' => 'Veuillez entrer un Etat.',
            'city_required'  => 'Veuillez entrer une ville.',
        ],
        'confirmaccount' => [
        'already_confirmed' => 'Le compte est déjà confirmé.',
        'invalid_otp'       => 'Veuillez entrer un otp valide.',
        'invalid_email'     => "L'email que vous avez entrée n'est pas enregistré",
        ],
    ],
];
