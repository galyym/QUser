<?php
namespace App\Qamtu\User\Domain\Repositories;

use App\Domain\Payloads\GenericPayload;
use App\Domain\Repositories\Repository;
use App\Qamtu\User\Domain\Models\User as Model;
use App\Qamtu\User\Domain\Models\TempUser as TempModel;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class UserRepository extends Repository
{
    protected $model;

    protected $tempUser;

    private $language;

    public function __construct(Model $model, TempModel $tempUser)
    {
        $this->model = $model;
        $this->tempUser = $tempUser;
        $this->language = App::currentLocale();
    }

    /**
     * Берем список всех админов одного филиала
     *
     * @return array<mixed>
     */
    public function checkUser($iin)
    {
        $query = $this->model->select('*')
        ->where('iin', $iin)->first();

        if (!empty($query)){
            $query = $query->toArray();
            $this->updateVisit($query['id'], 'applicant');
        }
        return $query;
    }

    public function addTempUser(array $data){
        $query = $this->tempUser->updateOrCreate([
            'iin' => $data['iin'],
            'full_name' => $data['full_name'],
            'birthdate' => $data['birthdate'],
            'email' => $data['email'],
            'is_active' => 1
        ])->toArray();
        $this->updateVisit($query['id'], 'temp_users');
        return $query;
    }

    public function updateVisit($id, $table){
        DB::table($table)->where('id', $id)->update(array('last_visit' => date('Y-m-d H:i:s')));
    }
}
