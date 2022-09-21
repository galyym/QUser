<?php

namespace App\Qamtu\Resume\Action;

use App\Qamtu\Resume\Domain\Service\ResumeDeleteService;
use App\Responders\JsonResponder as Responder;
use App\Qamtu\Resume\Domain\Models\Resume;
use Illuminate\Support\Facades\Request;

class ResumeDeleteAction
{
    protected $service;
    protected $responder;

    public function __construct(ResumeDeleteService $service, Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return $this->service->handle();
/*        return $this->responder->withResponse(
            $this->service->handle()
        )->respond();*/
    }
}
