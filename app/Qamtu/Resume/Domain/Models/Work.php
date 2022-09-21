<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $table = 'exp_work';

    protected $fillable = [
        'id',
        'iin',
        'location_work',
        'status_work',
        'position_work',
        'skills',
        'about_work',
        'first_time',
        'last_time'
    ];
}
