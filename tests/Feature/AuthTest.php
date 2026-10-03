<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;
use Laravel\Socialite\Two\User as SocialUser;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;

it('should redirect to the Google login page', function () {
    Socialite::fake('google');

    get(route('auth.google.redirect'))->assertRedirect();
});

it('should redirect to home page if already authenticated', function () {
    Socialite::fake('google');

    actingAs(User::factory()->create());

    get(route('auth.google.redirect'))->assertRedirect();
    get(route('auth.google.callback'))->assertRedirectToRoute('home');
});

it('should login the user who is already registered via Google', function () {
    $fakeUser = User::factory()->createMany(2)->random();
    Socialite::fake('google', SocialUser::fake(['id' => $fakeUser->google_id]));
    
    get(route('auth.google.callback'))->assertRedirectToRoute('home');
    assertAuthenticatedAs($fakeUser);
    assertDatabaseCount('users', 2);
});

it('should create a new user via Google and login', function () {
    Socialite::fake('google', SocialUser::fake());
    
    get(route('auth.google.callback'))->assertRedirectToRoute('home');

    assertAuthenticated();
    assertDatabaseCount('users', 1);
});

it('should create a user with a different handle, even if the names are the same, and login', function () {
    $existingUser = User::factory()->create();
    Socialite::fake('google', SocialUser::fake(['name' => $existingUser->name]));
    
    get(route('auth.google.callback'))->assertRedirectToRoute('home');
    assertAuthenticated();
    assertDatabaseCount('users', 2);
    expect(Auth::user())->not->toBe($existingUser);
    expect(Auth::user()->handle)->not->toBe($existingUser->handle);
});

it('should be possible to log out if you are logged in.', function() {
    actingAs(User::factory()->create());

    get(route('auth.logout'))->assertRedirectToRoute('home');
    
    assertGuest();
});
