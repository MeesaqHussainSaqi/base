<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $user, Request $request)
    {
        $this->model = $user;
        $this->modelName = class_basename($this->model);
    }
    public function create(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return User::create($data);
    }

    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
    public function GetAll($req)
    {
        $search = $req['search'] ?? null;
        parent::SetPaginationDetails($req);
        $this->query = $this->model->newQuery();
        if (!empty($search)) {
            $search = $this->search;
            $this->query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            });
        }
        return parent::GetAll($req);
    }
    public function GetById($id){
        // $this->query = $this->model->newQuery();
        // $this->model = $this->model->find($id);
        return parent::GetById($id);
    }
}