<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Qamtu\Resume\Domain\Models\Education;

class Language extends Model
{
    use HasFactory;

    protected $table = 'rb_language';

    protected $fillable = [
        'id',
        'name_kk',
        'name_ru',
    ];

    public function resume()
    {
        return $this->belongsTo(Education::class);
    }
}
