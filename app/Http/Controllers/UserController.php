<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected UserService $userService) {}

    public function create(RegisterRequest $request)
    {
        // return response()->json($this->userService->register($request->validated()), 201);
        return new UserResource($this->userService->create($request->validated()));
    }
    public function GetAll(Request $req)
    {
        return response()->json($this->userService->GetAll($req));
    }
    public function GetById(Request $req)
    {
        return response()->json($this->userService->GetById($req));
    }
    public function profile()
    {
        // return response()->json(auth()->user());
    }

    public function logout()
    {
        // auth()->user()->tokens()->delete();
        // return response()->json(['message' => 'Logged out']);
    }
}

