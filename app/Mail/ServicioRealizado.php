<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\Servicio;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServicioRealizado extends Mailable
{
    use Queueable, SerializesModels;

    public $servicio;
    public $data;

    /*public function __construct($data)
    {
        $this->data = $data;
    } */
    public function __construct(array $data)
    {
        $this->data = $data;
    }
    

  
    public function build()
    {
        return $this->view('emails.servicio_solicitado')
                    ->subject('Nuevo Servicio Solicitado')
                    ->with([
                        'servicio' => $this->data,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Servicio Realizado',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.servicio_realizado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
