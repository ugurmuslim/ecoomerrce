<?php

namespace Modules\Sale\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderShipped extends Mailable
{
  use Queueable, SerializesModels;

  /**
  * Create a new message instance.
  *
  * @return void
  */
  public function __construct($shipping_number,$adress)
  {

    $this->shipping_number = $shipping_number;
    $this->adress = $adress;
  }

  /**
  * Build the message.
  *
  * @return $this
  */
  public function build()
  {
    return $this->from('ugur@ugur.com')
    ->view('sale::emails.orderShipped')
    ->with(['shipping_number'=>$this->shipping_number,
    'adress'=>$this->adress]);
  }
}
