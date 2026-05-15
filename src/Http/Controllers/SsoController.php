<?php

namespace Laraartisan\SsoClient\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SsoController extends Controller
{
    public function redirect()
    {
        $providerUrl = rtrim(config('sso-client.provider_url'), '/');
        $callback    = config('sso-client.callback_url') ?: url('/sso/callback');

        $url = $providerUrl . '/sso/login?' . http_build_query([
            'sso_redirect_url' => $callback,
        ]);

        return redirect($url);
    }

    public function callback(Request $request)
    {
        $providerUrl = rtrim(config('sso-client.provider_url'), '/');

        $response = Http::post($providerUrl . '/api/sso/verify', [
            'token'     => $request->token,
        ]);

        if (!$response->successful()) {
            abort(401);
        }

        $data = $response->json();

        $resolver = config('sso-client.resolve_user');
        $user = $resolver($data);

        Auth::login($user);

        $redirect = config('sso-client.redirect_after_login');
        $to = is_callable($redirect) ? $redirect($user) : $redirect;

        return redirect($to);
    }
}
