<?php

namespace App\Mail;

use App\Model\Coordenador;
use App\Model\Utilizacao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UtilizacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Utilizacao $utilizacao)
    {
        $this->utilizacao = $utilizacao;
        $this->coordenadores = Coordenador::select('email')->get();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        return $this->subject('Agendamento de veículos - Nova solicitação para entrega até ' .date('d/m/Y H:i',strtotime($this->utilizacao->dt_entrega)))
        ->to($this->coordenadores)
        ->replyTo('atendimento.abel@lasalle.org.br')
        ->view('mail.UtilizacaoMail',[
            'utilizacao' => $this->utilizacao,
        ]);
    }
}
