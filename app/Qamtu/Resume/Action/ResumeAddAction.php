<?php
namespace App\Qamtu\Resume\Action;

use App\Qamtu\Resume\Domain\Service\ResumeAddService as Service;
use App\Qamtu\Resume\Domain\Requests\AddRequest as Request;
use App\Responders\JsonResponder as Responder;

class ResumeAddAction
{
    protected $service;
    protected $responder;

    public function __construct(Service $service, Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke(Request $request)
    {
        return $this->responder->withResponse(
            $this->service->handle($request->validate())
        )->respond();
    }
}
