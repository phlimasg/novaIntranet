<?php

namespace App\Mail;

use App\Model\Utilizacao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCoordenador extends Mailable
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
        return $this->subject('Agendamento de veículos - Nova solicitação em ' .date('d/m/Y H:i'))
        ->to($this->utilizacao->coordenador_email)
        ->replyTo('atendimento.abel@lasalle.org.br')
        ->view('mail.autorizacaoCoordenador',[
            'utilizacao' => $this->utilizacao,
        ]);
    }
}
