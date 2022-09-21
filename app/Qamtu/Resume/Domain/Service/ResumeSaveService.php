<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Models\Resume;
use Illuminate\Http\Request;
use App\Domain\Payloads\SuccessPayload;

class ResumeSaveService
{
    protected $resume;

    public function __construct(Resume $resume)
    {
        $this->resume = $resume;
    }

    public function handle(array $data, $id)
    {
        $res = Resume::find($id)->update($data);

        if ($res){
            return new SuccessPayload('Resume successfully updated');
        }

        return  [
            'message' => 'Error',
            'status_code' => 404
        ];
    }
}
