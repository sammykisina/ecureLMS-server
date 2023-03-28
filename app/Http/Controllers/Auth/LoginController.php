<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Notifications\TwoFactorCode;
use Illuminate\Support\Facades\Hash;
use JustSteveKing\StatusCode\Http;

class LoginController extends Controller {
    public function __invoke(LoginRequest $request) {
        $user = User::query()->where('regNumber', $request->get(key: 'id'))->first();

        if (! $user || ! Hash::check(value: $request->get(key: 'password'), hashedValue: $user->password)) {
            return response()->json(
                data: [
                    'error' => 1,
                    'message' => 'The credentials do not match our records.',
                ],
                status: Http::NOT_FOUND()
            );
        }

        $user->tokens()->delete();

        $user->generateTwoFactorCode();
        $user->notify(new TwoFactorCode);


        return response()->json(
            data: [
                'error' => 0,
                'message' => 'Welcome. Check you email for verification code.',
                'user' => [
                    'id' => $user->id
                ],
            ]
        );
    }
}
