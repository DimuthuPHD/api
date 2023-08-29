<?php

namespace App\Services;

use App\Models\Consultant;
use App\Services\Base\BaseService;

class ConsultantService extends BaseService
{
    public function __construct(Consultant $consultant)
    {
        $this->model = $consultant;
    }

    public function store(array $data): Consultant
    {
        return $this->model->create($data);
    }
}
