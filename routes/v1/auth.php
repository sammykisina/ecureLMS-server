<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RevokeLoginsController;
use App\Http\Controllers\Auth\UpdatePasswordController;
use App\Http\Controllers\Auth\VerifyTwoFactorCode;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class)->name('login');
Route::post('/{user}/verify-two-factor-code', VerifyTwoFactorCode::class)->name('verifyTwoFactorCode');
Route::post('/password-reset', UpdatePasswordController::class)->name('password-reset');
Route::post('/forgot-password', ForgotPasswordController::class)->name('forgot-password');
Route::get('{user}/revoke-logins', RevokeLoginsController::class)->name('revoke-logins');
