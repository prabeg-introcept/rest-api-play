<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    public function __construct(
        private UserService $userService
    ){}

    /**
     * Store a newly created resource in storage.
     *
     * @param LoginUserRequest $request
     * @return JsonResponse
     */
    public function store(LoginUserRequest $request)
    {
        $user = $this->userService->login($request->validated());
        if(!$user) {
            return response()->json([
                "status" => "Login Failed",
                "message" => "Invalid Credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }
        return response()->json([
            "status" => "Login Success",
            "tokenType" => "Bearer",
            "token" => $user["token"],
            "user" => $user["user"],
        ], Response::HTTP_OK);
    }
}
