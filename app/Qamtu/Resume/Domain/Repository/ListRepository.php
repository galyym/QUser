<?php

namespace App\Qamtu\Resume\Domain\Repository;

use App\Domain\Repositories\Repository;
use App\Qamtu\Resume\Domain\Models\Resume;
use App\Qamtu\Resume\Domain\Models\Resume as Model;
use App\Qamtu\Resume\Domain\Models\Education;
use App\Qamtu\Resume\Domain\Models\Work;
use Illuminate\Support\Facades\DB;

class ListRepository extends Repository
{
    protected $model;
    protected $education;
    protected $work;

    public function __construct(Model $model, Education $education, Work $work)
    {
        $this->model = $model;
        $this->education = $education;
        $this->work = $work;
    }

    public function getListResume()
    {
        return Resume::with('educations')
            ->with('works')
            ->with('privilegies')
            ->get();
    }

}
