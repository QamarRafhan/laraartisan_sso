<?php

return [
    /*
    | Where the parent / SSO provider lives.
    */
    'provider_url' => env('SSO_PROVIDER_URL', 'https://dev.performancehorsehotline.com'),

    /*
    | The client_id this child app uses with the provider.
    */
    // 'client_id' => env('SSO_CLIENT_ID'),

    /*
    | The callback URL on THIS child app. Leave null to auto-detect
    | as url('/sso/callback') on the current host.
    */

    'callback_url' => env('SSO_CALLBACK_URL'),

    /*
    | Given the verified user data from the provider, return the local
    | User model. This is the User::updateOrCreate part of your old code.
    | Edit it to match this app's User model.
    */
    'resolve_user' => function (array $data) {

        return \App\Models\User::findOrFail($data['id']);
        // return \App\Models\User::updateOrCreate(
        //     ['central_user_id' => $data['id']],
        //     [
        //         'first_name'         => $data['name'],
        // //         'is_active'          => $data['is_active'],
        //         'auth_type'          => 'sso',
        //         'displaylevel'       => 'Public',
        //         'managed_by'         => $data['id'],
        //         'username'           => $data['name'],
        //         'email_verified_at'  => now(),
        //         'password'           => \Illuminate\Support\Facades\Hash::make('Password'),
        //         'password_encrypted' => 0,
        //     ]
        // );
    },

    /*
    | Where to send the user after a successful login.
    | Can be a string ('/dashboard') or a closure receiving the user.
    */
    'redirect_after_login' => function ($user) {
        // return '/profile/' . $user->id;
        return '/';
    },
];
