<?php

namespace App\Exceptions\User;

use Exception;

/**
 * Exception thrown when a user is already using the same handle.
 */
class UserHandleAlreadyInUse extends Exception
{}
