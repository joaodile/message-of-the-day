<?php

namespace App\Http\Controllers;

use App\Actions\CreateUserAction;
use App\Exceptions\User\UserWithGoogleIdAlreadyExists;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    
    /**
     * Redirects the user to the Google login page, requesting only the OpenID access scope and profile information (name, avatar, etc.).
     * 
     * @return RedirectResponse 
     */
    public function googleRedirect(): RedirectResponse
    {
        return Socialite::driver('google')
            ->setScopes(['openid', 'profile'])
            ->redirect();
    }

    /**
     * It retrieves user information using the OAuth2 token, attempts to create the account, and logs the user in. 
     * If a user with the same OpenID already exists, they are simply logged in.
     * 
     * @param CreateUserAction $createUserAction 
     * @return RedirectResponse 
     */
    public function googleCallback(CreateUserAction $createUserAction): RedirectResponse
    {
        $googleUser = Socialite::driver('google')->user();

        // Only a database insertion that relies on a constraint violation can guarantee 
        // that no user with the same "handle" or "openid" exists in a concurrency scenario.
        try {
            $user = $createUserAction->execute($googleUser->getId(), $googleUser->getName());
        } catch(UserWithGoogleIdAlreadyExists) {
            $user = User::query()->firstWhere('google_id', $googleUser->getId());
        }
        
        Auth::login($user, true);
        Session::regenerate();

        return to_route('home');
    }

    /**
     * Ends the user's authenticated session and redirects them to the home page.
     * @return RedirectResponse 
     */
    public function logout(): RedirectResponse
    {
        Auth::logout();

        Session::invalidate();
        Session::regenerateToken();

        return to_route('home');
    }

}
