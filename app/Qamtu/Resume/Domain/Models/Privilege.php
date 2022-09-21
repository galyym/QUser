<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $table = 'rb_privileges';

    protected $fillable = [
        'id',
        'name_kk',
        'name_ru',
        'description_kk ',
        'description_ru',
        'id_admin',
    ];

    public function resume()
    {
        return $this->belongsTo(App\Qamtu\Resume\Domain\Models\Resume::class);
    }
}
