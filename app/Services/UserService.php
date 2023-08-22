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

    public function byRole(string $role, string $sortBy = 'first_name', int $paginate = null)
    {
        $users = $this->model->with('role')->orderBy($sortBy)->whereHas('role', function ($query) use ($role) {
            $query->where('name', $role);
        });

        if ($paginate !== null) {
            $users = $users->paginate(15);
        } else {
            $users = $users->get();
        }

        return $users;
    }

    private function getAvailableConsultatns($date, $timeFrom, $timeTo)
    {
        return $this->model
            ->where(['role_id' => 2])
            ->whereDoesntHave('appointments', function ($query) use ($date, $timeFrom, $timeTo) {
                $query->where('date', $date)
                    ->where('time_from', '<', $timeTo)
                    ->where('time_to', '>', $timeFrom);
            })
            ->first();
    }
}
