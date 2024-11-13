<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SupportEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $name_student;
    public $code_student;
    public $content_support;
    public $created_at;
    public $problem_support;
    public $who_support;
    public $supported_at;
    /**
     * Create a new message instance.
     */
    public function __construct($name_student,$code_student,$content_support,$created_at,$who_support,$problem_support,$supported_at)
    {
        $this->name_student = $name_student;
        $this->code_student = $code_student;
        $this->content_support = $content_support;
        $this->created_at = $created_at;
        $this->who_support = $who_support;
        $this->problem_support = $problem_support;
        $this->supported_at = $supported_at;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Email hỗ trợ sinh viên',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.email_support',
            with: [
               'name_student' => $this->name_student,
               'code_student' => $this->code_student,
               'content_support' => $this->content_support,
               'created_at' => $this->created_at,
               'who_support' => $this->who_support,
               'problem_support' => $this->problem_support,
               'supported_at' => $this->supported_at,
            ],
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
