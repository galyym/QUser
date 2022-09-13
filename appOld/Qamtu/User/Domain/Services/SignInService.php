<?php

namespace App\Qamtu\User\Domain\Services;

use App\Qamtu\User\Domain\Repositories\Repository;
use App\Mrt\Admin\Domain\Models\User as Model;
use Illuminate\Support\Facades\App;

class SignInServicedfd{
    protected $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($data = [])
    {

    }
}
