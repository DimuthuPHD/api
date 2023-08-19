<?php

namespace App\Services;

use App\Models\User;
use App\Services\Base\BaseService;

class UserService extends BaseService
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data) :User
    {
        return $this->model->create($data);
    }
}
