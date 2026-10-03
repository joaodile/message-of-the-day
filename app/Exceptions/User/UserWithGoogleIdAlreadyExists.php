<?php

namespace App\Exceptions\User;

use Exception;

/**
 * Exception thrown when a user is already registered with the same Google OpenID.
 */
class UserWithGoogleIdAlreadyExists extends Exception
{}
