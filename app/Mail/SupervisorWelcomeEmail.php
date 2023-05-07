<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupervisorWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Admin $supervisor;
    private $decoded_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $supervisor, $decoded_password)
    {
        //
        $this->supervisor = $supervisor;
        $this->decoded_password = $decoded_password;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //from: auth("supervisor")->user()->email,
        return new Envelope(
            subject: 'Supervisor Welcome Email',
            from: auth('supervisor')->user()->email,
            cc: 'admin@ucas.ps'
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.supervisor_welcome_email',
            with: [
                'name' => $this->supervisor->name,
                'email' => $this->supervisor->email,
                'password' => $this->decoded_password,
                'account_id' => $this->supervisor->id,

            ],
        );
    }

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
