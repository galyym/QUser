<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Qamtu\Resume\Domain\Models\Language;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
        'id',
        'iin',
        'level_list',
        'language_list',
        'education_name',
        'profession',
        'first_time',
        'last_time'
    ];

    public function languages()
    {
        return $this->hasMany(Language::class);
    }

    public function resume()
    {
        return $this->belongsTo(App\Qamtu\Resume\Domain\Models\Resume::class);
    }
}
