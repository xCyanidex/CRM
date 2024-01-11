<?php

/**
 * VerifyEmail
 * 
 * Mailable class for sending email verification messages.
 * This class extends Laravel's Mailable class and is used to create
 * and send email messages containing an OTP (One-Time Password) for email verification.
 *
 *
 * @category Mailable
 * @package  App\Mail
 */

namespace App\Mail;

use Illuminate\Mail\Mailable;
use App\Models\User;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Markdown;

class VerifyEmail extends Mailable
{
    // The OTP (One-Time Password) to be included in the email
    public $otp;

    // The user instance to whom the email is sent
    public $user;

    /**
     * Create a new message instance.
     *
     * @param  User  $user  The user instance to whom the email is sent
     * @param  string  $otp  The OTP (One-Time Password) to be included in the email
     */
    public function __construct(User $user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;

        // Set the recipient email address and subject of the email
        $this->to($user->email);
        $this->subject('Verify Your Email Address');
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verify Email',
        );
    }

    /**
     * Build the email message.
     *
     * @return $this
     */
    public function build()
    {
        // Extract OTP for use in the email content
        $otp = $this->otp;

        // Create a new Markdown instance for rendering the email view
        $markdown = new Markdown(view(), config('mail.markdown'));

        // Return the email view with the OTP included in the email content
        return $this->view(
            'verify-otp',
            compact('otp')
        )->with('text', 'Your OTP: ' . $otp);
    }
}
