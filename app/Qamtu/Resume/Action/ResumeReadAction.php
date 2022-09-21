<?php
namespace App\Qamtu\Resume\Action;

use App\Responders\JsonResponder as Responder;
use App\Qamtu\Resume\Domain\Service\ResumeReadService as Service;

class ResumeReadAction
{
    protected $service;
    protected $responder;

    public function __construct(Service $service,Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke($id)
    {
        return $this->service->handle($id);
    }
}
