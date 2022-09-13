<?php

namespace App\Qamtu\User\Actions;

use App\Qamtu\User\Domain\Requests\SignInEcpRequest as Request;
use App\Qamtu\User\Domain\Services\SignInService as Service;
use App\Responders\JsonResponder as Responder;

class SignInAction2
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
