<?php

namespace App\Qamtu\Request\Actions;

use App\Qamtu\Request\Domain\Requests\FormRequest as Request;
use App\Qamtu\Request\Domain\Services\SentRequestService as Service;
use App\Responders\JsonResponder as Responder;

class SentRequestAction
{

    public function __construct(Responder $responder, Service $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->validated())
        )->respond();
    }
}
