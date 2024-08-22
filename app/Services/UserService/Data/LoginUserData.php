<?php

namespace App\Services\UserService\Data;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class LoginUserData extends Data
{
    public string|Optional $email;

    public string|Optional $login;

    public function __construct(
        public string $password,
    ) {}
}
