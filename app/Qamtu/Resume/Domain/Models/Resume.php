<?php

namespace App\Qamtu\Resume\Domain\Models;

use App\Qamtu\Resume\Domain\Models\Education;
use App\Qamtu\Resume\Domain\Models\Work;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Qamtu\Resume\Domain\Models\Sex;
use App\Qamtu\Resume\Domain\Models\Privilege;
use App\Qamtu\Resume\Domain\Models\Kato;

class Resume extends Model
{
    use HasFactory;

    protected $table = 'applicant';

    protected $fillable = [
        'id',
        'raiting_number',
        'status_id',
        'iin',
        'full_name',
        'birthdate',
        'privilege_id',
        'positions',
        'email',
        'phone_number',
        'address',
        'second_phone_number',
        'is_have_whatsapp',
        'is_have_telegram',
        'comment',
        'last_visit',
    ];

    public function educations()
    {
        return $this->hasMany(Education::class, 'id', 'education');
    }

    public function works()
    {
        return $this->hasMany(Work::class, 'id', 'exp_work');
    }

    public function sexies()
    {
        return $this->hasMany(Sex::class);
    }

    public function privilegies()
    {
        return $this->hasMany(Privilege::class, 'id', 'privilege_id');
    }


    public function katoes()
    {
        return $this->hasMany(Kato::class);
    }
}
