<?php

namespace App\Services;

use App\Constants\Tokens;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserService
{
    public function __construct(
        private User $user
    ){}

    public function login(array $credentials)
    {
        if(Auth::attempt($credentials)){
            $user = auth()->user();
            $token = $user->createToken(Tokens::LOGIN)->plainTextToken;
            return ["user" => $user, "token" => $token];
        }
        return false;
    }
}
