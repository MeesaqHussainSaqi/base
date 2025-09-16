<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function create(array $data)
    {
        // $data['status'] = 'active';
        return $this->userRepository->create($data);
        // $user = $this->userRepository->create($data);
        // $token = $user->createToken('auth_token')->plainTextToken;
        // return ['user' => $user, 'token' => $token];
    }
    public function GetAll()
    {
        // $data['status'] = 'active';
        return $this->userRepository->GetAll();
        // $user = $this->userRepository->create($data);
        // $token = $user->createToken('auth_token')->plainTextToken;
        // return ['user' => $user, 'token' => $token];
    }
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Create Sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }
}
