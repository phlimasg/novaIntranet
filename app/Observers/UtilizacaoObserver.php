<?php

namespace App\Observers;

use App\Mail\UtilizacaoMail;
use App\Model\Utilizacao;
use Illuminate\Support\Facades\Mail;

class UtilizacaoObserver
{
    public function creating(Utilizacao $utilizacao)
    {
        Mail::send(new UtilizacaoMail($utilizacao));
    }
}
