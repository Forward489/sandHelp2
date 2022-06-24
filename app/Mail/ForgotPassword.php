<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $action_link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($action_link)
    {
        $this->action_link = $action_link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('testing.layouts.email_forgot_template');
    }
}
