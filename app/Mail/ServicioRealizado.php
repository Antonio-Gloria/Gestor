<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServicioRealizado extends Mailable
{
    use Queueable, SerializesModels;

    public $servicio;
    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.servicio_solicitado')
            ->subject('Servicio Realizado')
            ->with([
                'servicio' => $this->data,
            ]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('servicios@cucsh.com', 'Servicios CUCSH'),
            subject: 'Servicio Realizado',
        );
    }

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
