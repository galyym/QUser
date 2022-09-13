<?php

namespace App\Mrt\Service\Actions;

use App\Domain\Requests\DefaultRequest as Request;
use App\Mrt\Service\Domain\Services\DeleteService as Service;
use App\Responders\JsonResponder as Responder;

class DeleteAction
{

    public function __construct(Responder $responder, Service $service)
    {
        $this->responder = $responder;
        $this->service = $service;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->service_id)
        )->respond();
    }
}