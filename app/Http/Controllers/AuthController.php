<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    
    public function googleRedirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->setScopes(['openid', 'https://www.googleapis.com/auth/userinfo.profile'])
            ->redirect();
    }

    public function googleCallback(CreateUserAction $createUserAction): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::query()->firstWhere('google_id', $googleUser->getId()) ?? $createUserAction->execute($googleUser->getId(), $googleUser->getName());
        
        Auth::login($user, true);
        Session::regenerate();

        return to_route('home');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return to_route('home');
    }

}
