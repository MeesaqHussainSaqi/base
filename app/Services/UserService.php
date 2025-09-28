<?php
namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService extends BaseService
{
    public function __construct(protected UserRepositoryInterface $userRepository){}

    public function create(array $data)
    {
        // $data['status'] = 'active';
        return $this->userRepository->create($data);
        // $user = $this->userRepository->create($data);
        // $token = $user->createToken('auth_token')->plainTextToken;
        // return ['user' => $user, 'token' => $token];
    }
    public function GetAll($req)
    {
        $users = $this->userRepository->GetAll($req->all());
        return $this->SetGridResponse(UserResource::collection($users),$users->count());
    }
}
