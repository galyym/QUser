<?php

namespace App\Qamtu\Resume\Domain\Service;

use App\Qamtu\Resume\Domain\Models\Kato;

class KatoListService
{
    protected $kato;

    public function __construct(Kato $kato)
    {
        $this->kato = $kato;
    }

    public function handle()
    {
        return $this->kato::all();
    }
}
