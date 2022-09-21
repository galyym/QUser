<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Models\Resume;

class ResumeAddService
{
    protected $resume;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function handle(array $data)
    {
        return $this->resume::create($data);
    }
}
