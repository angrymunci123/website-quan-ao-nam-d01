<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;


    public $password_token;
    public $email;
    public function __construct($password_token, $email)
    {
        $this->password_token = $password_token;
        $this->email = $email;
    }


    public function build()
    {
        return $this->subject("Thiết lập lại mật khẩu đăng nhập KTC Store")->view('customer.mail.passwordResetMail');
    }
}
