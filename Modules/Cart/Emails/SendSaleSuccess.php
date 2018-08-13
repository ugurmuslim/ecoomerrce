<?php

namespace Modules\Cart\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\Account\Entities\Accountinfo as Account;
use Modules\Sale\Entities\Productsale;

class SendSaleSuccess extends Mailable
{
  use Queueable, SerializesModels;

  /**
  * Create a new message instance.
  *
  * @return void
  */
  public function __construct($sale_package,$adress_id)
  {
    $this->product_sale = Productsale::where('sale_package',$sale_package)->get();
    $this->adress = AccounT::find($adress_id);
  }

  /**
  * Build the message.
  *
  * @return $this
  */
  public function build()
  {
    return $this->from('iletisim@behicesglm.com')
    ->subject('Siparişi Verildi!')
    ->view('cart::emails.salesuccess')
    ->with(['product_sale'=>$this->product_sale,
    'adress'=>$this->adress]);

  }
}
