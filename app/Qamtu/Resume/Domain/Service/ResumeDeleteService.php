<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Models\Resume;
use Illuminate\Http\Response;

class ResumeDeleteService
{
    protected $resume;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function handle()
    {
        return $this->resume->delete();

       /* return response(null, Response::HTTP_NO_CONTENT);*/
    }
}
