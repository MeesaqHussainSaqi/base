<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService extends BaseService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {}

    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return [
                'message' => 'Invalid credentials',
                'code' => 401,
                'status'=> 'failed'
            ];
        }

        // Create Sanctum token
        $token = $user->createToken('api-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
            'code' => 200,
            'message'=> 'User successfully login!',
            'status'=> 'success'
        ];
    }
}
