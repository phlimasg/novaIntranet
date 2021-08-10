<?php

namespace App\Mail;

use App\Model\Utilizacao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitacaoStatusMail extends Mailable
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
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Agendamento de veículos - Atualização em ' .date('d/m/Y H:i'))
        ->to($this->utilizacao->getUser->email)
        ->replyTo('atendimento.abel@lasalle.org.br')
        ->view('mail.solicitacaoStatus',[
            'utilizacao' => $this->utilizacao,
        ]);
    }
}
