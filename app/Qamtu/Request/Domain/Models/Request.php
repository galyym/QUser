<?php

namespace App\Qamtu\Request\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Request extends Model
{
    use Notifiable;

    protected $table = 'user_request';

//    protected $guard = "branch_admin";

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];
}
