<?php

namespace App\Qamtu\Resume\Domain\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Qamtu\Resume\Domain\Models\Resume;

class Kato extends Model
{
    use HasFactory;

    protected $table = 'kato_log';

    protected $fillable = [
        'id',
        'kato',
        'name_kk',
        'name_ru'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
