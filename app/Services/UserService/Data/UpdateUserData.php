<?php

namespace App\Services\UserService\Data;

use Illuminate\Support\Optional;
use Spatie\LaravelData\Data;

class UpdateUserData extends Data
{
    public string|Optional $name;

    public string|Optional $email;

    public string|Optional $login;

    public string|Optional $about;
}
