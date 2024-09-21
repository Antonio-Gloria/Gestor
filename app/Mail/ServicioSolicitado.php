<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Servicio;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServicioSolicitado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

     public $servicio;
     
    public function __construct(Servicio $servicio)
    {
        $this->servicio = $servicio;
    }

    public function build()
    {
        return $this->view('emails.servicio_solicitado')
                    ->subject('Nuevo Servicio Solicitado')
                    ->with([
                        'servicio' => $this->servicio,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('servicios@cucsh.com', 'Servicios'),
            subject: 'Servicio Solicitado',

        );
        
    }

        
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.servicio_solicitado',
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
