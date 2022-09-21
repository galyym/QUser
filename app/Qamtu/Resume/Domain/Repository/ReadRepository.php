<?php

namespace App\Qamtu\Resume\Domain\Repository;

use App\Qamtu\Resume\Domain\Models\Resume;
use App\Qamtu\Resume\Domain\Models\Resume as Model;
use App\Qamtu\Resume\Domain\Models\Work;
use App\Qamtu\Resume\Domain\Models\Education;

class ReadRepository
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

    public function showResume($id)
    {
        $query = $this->model->select(
            'id',
            'iin',
            'full_name',
            'birthdate',
            'privilege_id',
            'email',
            'phone_number',
            'second_phone_number',
            'is_have_whatsapp',
            'is_have_telegram',
            'is_active',
            'family_status',
            'sex',
            'kato_location',
            'education',
            'exp_work'
        )
            ->find($id);

        return $query;
    }

    public function getReadResume($id)
    {
        return Resume::with('educations')
            ->with('works')
            ->with('privilegies')
            ->find($id)
            ->toArray();
    }
}
