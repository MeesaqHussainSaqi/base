<?php
namespace App\Repositories\User;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function findByEmail(string $email);
    public function GetAll(array $data);
}