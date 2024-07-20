<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order_mail_data;
    public function __construct($order_mail_data)
    {
        $this->order_mail_data = $order_mail_data;
    }
    public function build()
    {
        return $this->subject("Cảm ơn bạn đã đặt hàng")->view('customer.mail.orderMail');
    }
}
