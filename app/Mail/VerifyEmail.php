<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use App\Models\User;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Markdown;

class VerifyEmail extends Mailable
{
    
    public $otp;
    public $user;
    /**
     * Create a new message instance.
     */
    public function __construct(User $user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
        $this->to($user->email);
        $this->subject('Verify Your Email Address');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Email',
        );
    }

 
  

    public function build()
    {
        $otp = $this->otp;

        $markdown = new Markdown(view(), config('mail.markdown'));

        return $this->view(
            'verify-otp',
            compact('otp')
        )->with('text', 'Your OTP: ' . $otp);
    }
}
