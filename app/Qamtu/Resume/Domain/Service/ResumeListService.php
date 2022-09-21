<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Repository\ListRepository as Repository;

class ResumeListService
{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle()
    {
        return $this->repository->getListResume();
    }
}
