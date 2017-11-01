<?php

return [
    /*
    *  Validation rules for all api.
    */
    'login' => [
        'rules' => [
            'email'    => 'required|email',
            'password' => 'required',
        ],
    ],

    'forgotpassword' => [
        'rules' => [
            'email' => 'required|email',
        ],
    ],

    'resetpassword' => [
        'rules' => [
            'email'                 => 'required|email',
            'password_confirmation' => 'required',
            'password'              => 'required|confirmed',
            'token'                 => 'required',
        ],
    ],

    'register' => [
        'rules' => [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|email|max:255|unique:users',
            'password'   => 'required|min:6|confirmed',
            'state_id'   => 'required',
            'city_id'    => 'required',
            'zip_code'   => 'required',
            'ssn'        => 'required',
        ],
    ],

    'confirmaccount' => [
         'rules' => [
             'email' => 'required|email',
             'otp'   => 'required',
         ],
    ],

];
