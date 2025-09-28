<?php
namespace App\Repositories;

use App\Configurations\Constant;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BaseRepository 
{
    protected $model;
    protected $modelName = '';
    protected $whereData = array();
    protected $query;
    protected $data;
    protected $total=0;
    protected $pageSize = 15;
    protected $page = '';
    protected $orderBy = 'id';
    protected $orderDirection = 'desc';
    protected $pageIndex = '1';
    protected $search = '';
    protected $baseWith = [
        'createdBy:id,full_name,created_at',
        'updatedBy:id,full_name,created_at',
        'deletedBy:id,full_name,created_at'
    ];
    public function create(array $data)
    {
        // $data['password'] = bcrypt($data['password']);
        // return User::create($data);
    }

    public function findByEmail(string $email)
    {
        // return User::where('email', $email)->first();
    }
    public function GetAll($req)
    {
        // DB::enableQueryLog();

        // $result = $this->query->orderBy($this->orderBy, $this->orderDirection)
        //             ->paginate($this->pageSize, ['*'], 'page', $this->page);

        // Log::info(DB::getQueryLog()); // shows count + select queries
        return $this->query->orderBy($this->orderBy, $this->orderDirection)
                     ->paginate($this->pageSize, ['*'], 'page', $this->page);
    }
    protected function SetPaginationDetails($request)
    {
        $this->orderBy = $request['order_by'] ?? $this->orderBy;
        $this->orderDirection = $request['order_direction'] ?? $this->orderDirection;
        $this->pageSize = $request['page_size'] ?? $this->pageSize;
        $this->page = $request['page'] ?? $this->page;
        $this->search = $request['search'] ?? $this->search;
        // $this->total = $request->total ?? $this->orderBy;
    }
}