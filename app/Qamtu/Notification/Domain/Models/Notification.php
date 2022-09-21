<?php

namespace App\Qamtu\Notification\Domain\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class Notification extends Model
{
    use Notifiable;

    protected $table = 'notification_messages';

//    protected $guard = "branch_admin";

    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at'];
}
