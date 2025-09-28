<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authService) {}

    public function login(LoginRequest $request)
    {
        // return "login";
        return response()->json($this->authService->login($request->validated()));
    }

    public function logout()
    {
        // auth()->user()->tokens()->delete();
        // return response()->json(['message' => 'Logged out']);
    }
}

