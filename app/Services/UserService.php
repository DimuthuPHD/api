<?php

namespace App\Services;

use App\Models\User;
use App\Services\Base\BaseService;

class UserService extends BaseService
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data): User
    {
        return $this->model->create($data);
    }

    public function byRole(string $role)
    {
        return $this->model->with('role')->whereHas('role', function ($query) use ($role) {
            $query->where('name', $role);
        })->paginate(15);
    }
}
