<?php

use Illuminate\Support\Facades\Route;
use Laraartisan\SsoClient\Http\Controllers\SsoController;

Route::middleware('web')->group(function () {
    Route::get('/login/sso',    [SsoController::class, 'redirect']);
    Route::get('/sso/callback', [SsoController::class, 'callback']);
});
