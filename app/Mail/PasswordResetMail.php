<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;


    public $passwordtoken;

    public function __construct($passwordtoken)
    {
        $this->passwordtoken = $passwordtoken;
    }


    public function build()
    {
        return $this->subject("Cảm ơn bạn đã đặt hàng")->view('customer.mail.passwordResetMail');
    }
}
