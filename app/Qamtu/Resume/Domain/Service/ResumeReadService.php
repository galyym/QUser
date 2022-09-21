<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Repository\ReadRepository as Repository;

class ResumeReadService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($id)
    {
        return $this->repository->getReadResume($id);
    }
}
