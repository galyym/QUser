<?php
namespace App\Qamtu\Resume\Action;

use App\Responders\JsonResponder as Responder;
use App\Qamtu\Resume\Domain\Service\KatoListService as Service;

class KatoListAction
{
    protected $service;
    protected $responder;

    public function __construct(Service $service,Responder $responder)
    {
        $this->service = $service;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        return $this->service->handle();
    }
}
