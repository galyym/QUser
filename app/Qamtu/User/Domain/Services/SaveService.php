<?php

namespace App\Qamtu\User\Domain\Services;

use App\Qamtu\User\Domain\Repositories\UserRepository as Repository;
use App\Domain\Payloads\SuccessPayload;
use App\Exceptions\MainException;

class SaveService
{

    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($admin_id = 0, $data = [])
    {
        $admin = $this->repository->updateById($admin_id, $data);
        if($admin != null)
            return new SuccessPayload(__("User success saved"));

        throw new MainException("Error to save admin");
    }

}
