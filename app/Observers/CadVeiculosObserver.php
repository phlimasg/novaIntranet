<?php

namespace App\Observers;

use App\Model\Veiculo;
use Illuminate\Support\Facades\Auth;

class CadVeiculosObserver
{
    public function creating(Veiculo $veiculo)
    {
        $veiculo->user_id = Auth::user()->id;
    }
}
