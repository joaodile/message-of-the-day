<?php

namespace App\Actions;

use App\Exceptions\User\UserHandleAlreadyInUse;
use App\Exceptions\User\UserWithGoogleIdAlreadyExists;
use App\Models\User;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Action responsible for creating new users
 */
class CreateUserAction 
{

    /**
     * Creates the user or throws an exception
     * 
     * @param string $googleId Google's OpenID
     * @param string $name The name of user
     * @param string $handle The handle of user
     * @return User 
     * @throws UserWithGoogleIdAlreadyExists In case the Google OpenID is already registered to another account
     * @throws UserHandleAlreadyInUse If the handle is already being used by another user
     */
    private function createOrFail(string $googleId, string $name, string $handle): User
    {
        try {
            return User::query()->create([
                'google_id' => $googleId,
                'name' => $name,
                'handle' => $handle
            ]);
        } catch(UniqueConstraintViolationException $constraintViolation) {
            throw match(true) {
                Str::contains($constraintViolation->index, 'google_id') => new UserWithGoogleIdAlreadyExists,
                Str::contains($constraintViolation->index, 'handle') =>  new UserHandleAlreadyInUse,
                default => $constraintViolation
            };
        }
    }

    /**
     * Create a new user
     * 
     * @param string $googleId Google's OpenID
     * @param string $name The name of user — which is also used as the basis for the handle
     * @return User 
     * 
     * @throws UserWithGoogleIdAlreadyExists In case the Google OpenID is already registered to another account
     */
    public function execute(string $googleId, string $name): User
    {
        $name = Str::substr($name, 0, 45);
        $handle = Str::slug($name);

        while(true) {
            try {
                return DB::transaction(fn() => $this->createOrFail($googleId, $name, $handle));
            } catch(UserHandleAlreadyInUse) {
                $handle = str($name)->append('-', Str::random(4))->slug();
            }
        }
    }

}