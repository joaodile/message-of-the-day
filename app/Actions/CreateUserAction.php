<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Support\Str;

class CreateUserAction 
{

    private function generateUserHandle(string $name): string 
    {
        $handle = null;

        do {
            if(!$handle) {
                $handle = Str::slug($name);
                continue;
            }

            $handle = str($name)
                ->limit(45, '')
                ->append('-' . Str::random(4))
                ->slug()
                ->toString();
        } while(User::query()->where('handle', $handle)->exists());

        return $handle;
    }

    public function execute(string $googleId, string $name): User
    {
        $name = Str::limit($name, 50, '');

        return User::query()->create([
            'google_id' => $googleId,
            'name' => $name,
            'handle' => $this->generateUserHandle($name)
        ]);
    }

}