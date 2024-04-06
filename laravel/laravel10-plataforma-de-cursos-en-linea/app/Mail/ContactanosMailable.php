<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactanosMailable extends Mailable
{
    use Queueable, SerializesModels;

    // Ponemos el nombre del asunto del correo que enviaremos
    public $subject = "Asunto de prueba";

    // Ponemos el cuerpo del mensaje del correo
    public $contacto;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contacto)
    {
        $this->contacto = $contacto;
    }



    public function build()
    {
        return $this->view('emails.contactanos');
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contactanos Mailable',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    /*public function content()
    {
        return new Content(
            view: 'view.name',
            //view: 'emails.contactanos',
        );
         
    }*/

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }

    
    
}
