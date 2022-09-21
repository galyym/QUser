<?php

namespace App\Qamtu\Request\Domain\Services;

use App\Domain\Payloads\GenericPayload;
use App\Domain\Services\Service;
use App\Qamtu\Request\Domain\Repositories\RequestRepository as Repository;


class SentRequestService extends Service
{
    protected $repository;


    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle($data = [])
    {
//        проверяем дублируется ли заявка. Проверка через ИИН.
        $check_request = $this->repository->checkRequest($data['iin']);
        if ($check_request){

            $this->repository->sentMessage($data['jwt']['id'], 5);

            return new GenericPayload([
                'status' => 'error',
                'message' => 'Ваша заявка дублируется. Подождите ответ от Центра занятости',
                'data' => [],
            ]);
        }

        //если заявка не дублируется то создаем новую заявку.
        $result = $this->repository->createRequest($data);

        if (!empty($result) && gettype($result) === 'array'){
            $this->repository->sentMessage($data['jwt']['id'], 1);
        }

        return new GenericPayload([
            'status' => 'success',
            'message' => 'Ваша заявка была принята',
            'data' => $result,
        ]);
    }
}
