<?php

namespace App\Mail;

use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResponseAddedEmail extends Mailable
{
    use Queueable, SerializesModels;

    private Feedback $feedback;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedback $feedback)
    {
        //
        $this->feedback = $feedback;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        //from: auth('supervisor)->user()
        return new Envelope(
            subject: 'Your Feedback Has Been Responded To',
            from: "feedback-center@ucas.ps",
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
            markdown: 'emails.response_added_email',
            with: [
                'name' => $this->feedback->student_name,
                'email' => $this->feedback->student_email,
                'std_id' => $this->feedback->student_university_id,
                'feedback_id' => $this->feedback->id,
                'response' => $this->feedback->response,
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
