<?php
namespace App\Qamtu\Request\Domain\Repositories;

use App\Domain\Payloads\GenericPayload;
use App\Domain\Repositories\Repository;
use App\Qamtu\Request\Domain\Models\Request as Model;
use App\Qamtu\Notification\Domain\Models\Notification as NotifiModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class RequestRepository extends Repository
{
    protected $model;

    protected $n_model;

    public function __construct(Model $model, NotifiModel $n_model)
    {
        $this->model = $model;
        $this->language = App::currentLocale();
        $this->n_model = $n_model;
    }

    public function createRequest(array $data){
        $query = $this->model->updateOrCreate([
            'status_id' => $data['status_id'],
            'iin' => $data['iin'],
            'full_name' => $data['full_name'],
            'birthdate' => $data['birthdate'],
            'privilege_id' => $data['privilege_id'],
            'positions' => $data['positions'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'address' => $data['address'],
            'second_phone_number' => $data['second_phone_number'],
            'family_status' => $data['family_status'],
            'sex' => $data['sex'],
            'comment' => $data['comment'],
            'is_active' => 1,
            'kato_location' => 470000000,
            'education' => 1,
            'exp_work' => 1,
        ])->toArray();
        $this->updateVisit($query['id'], 'user_request');
        return $query;
    }

    public function checkRequest($iin){
        $query = $this->model->select('*')->where('iin', $iin)->get()->toArray();
        return empty($query) ? false : true;
    }

    public function updateVisit($id, $table){
        DB::table($table)->where('id', $id)->update(array('last_visit' => date('Y-m-d H:i:s')));
    }

    public function sentMessage($id, $text_id){
        $query = $this->n_model->insert([
            'text_id' => $text_id,
            'user_id' => $id,
            'status_read_id' => 1,
            'company_admins_id' => 1,
            'center_admins_id' => 1,
            'company_id' => 45
        ]);

        return response('Ваше сообщение было отправлено');
    }
}
