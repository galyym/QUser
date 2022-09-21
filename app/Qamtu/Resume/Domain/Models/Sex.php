<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sex extends Model
{
    use HasFactory;

    protected $table = 'rb_sex';

    protected $fillable = [
        'id',
        'name_kz',
        'name_ru',
    ];

    public function resume()
    {
        return $this->belongsTo(App\Qamtu\Resume\Domain\Models\Resume::class);
    }
}
