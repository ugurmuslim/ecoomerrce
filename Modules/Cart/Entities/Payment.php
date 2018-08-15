<?php

namespace Modules\Cart\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Sale\Entities\Productsale;
use Modules\Account\Entities\Accountinfo as Account;
use Modules\Cart\Entities\Onlineorder;
use Modules\Cart\Emails\SendSaleSuccess;
use Modules\Cart\Emails\AdminSaleSuccess;
use App\Models\Auth\User\User;
use Cart;
use Session;
use Auth;
use Carbon\Carbon;
use Config;
use Mail;


class Payment extends Model

{
  protected $fillable = [];


  public function __construct() {
    \IyzipayBootstrap::init();
    $this->iyzico_options = new \Iyzipay\Options();
    $this->iyzico_options->setApiKey(Config::get('services.iyizico.apikey'));
    $this->iyzico_options->setSecretKey(Config::get('services.iyizico.secretkey'));
    $this->iyzico_options->setBaseUrl(Config::get('services.iyizico.baseurl'));
  }

  public function options() {
    return $this->iyzico_options;
  }

  public function iyizipay($request) {
    $online_order = new Onlineorder;
    $basketId = 1;
    if(count($online_order->get())) {
      $basketId = $online_order->nextBasketId();
    }

    $contact_name = $request->name . ' ' . $request->lastname;
    $contact_email = $request->email;
    $shipment_city = $request->city;
    $shipment_country = "Türkiye";
    $shipment_adress = $request->adress;
    $shipment_zipcode = $request->zip_code;

    $user = User::find(Auth::user()->id);
    Session::flash('adress', $request->adress_id);
    $products =  $request->product_id;
    $account = Account::find($request->adress_id);
    $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setConversationId("123456789");
    $request->setPrice(Cart::subtotal());
    $request->setPaidPrice(Cart::total());
    $request->setCurrency(\Iyzipay\Model\Currency::TL);
    $request->setBasketId($basketId);
    $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
    $request->setCallbackUrl(Config::get('services.iyizico.callbackurl'));
    $request->setEnabledInstallments(array(2, 3, 6, 9));
    $buyer = new \Iyzipay\Model\Buyer();
    $buyer->setId("232323232");
    $buyer->setName($account->first_name);
    $buyer->setSurname($account->last_name);
    $buyer->setGsmNumber("+9" . $account->phone_number);
    $buyer->setEmail(Auth::user()->email);
    $buyer->setIdentityNumber($account->id_number);
    $buyer->setLastLoginDate(Carbon::now()->toDateTimeString());
    $buyer->setRegistrationDate($user->created_at->toDateTimeString());
    $buyer->setRegistrationAddress($account->adress);
    $buyer->setIp("85.34.78.112");
    $buyer->setCity($account->city);
    $buyer->setCountry("Turkey");
    $buyer->setZipCode($account->zip_code);
    $request->setBuyer($buyer);
    $shippingAddress = new \Iyzipay\Model\Address();
    $shippingAddress->setContactName($contact_name);
    $shippingAddress->setCity($shipment_city);
    $shippingAddress->setCountry($shipment_country);
    $shippingAddress->setAddress($shipment_adress);
    $shippingAddress->setZipCode($shipment_zipcode);
    $request->setShippingAddress($shippingAddress);
    $billingAddress = new \Iyzipay\Model\Address();
    $billingAddress->setContactName($contact_name);
    $billingAddress->setCity($shipment_city);
    $billingAddress->setCountry($shipment_country);
    $billingAddress->setAddress($shipment_adress);
    $billingAddress->setZipCode($shipment_zipcode);
    $request->setBillingAddress($billingAddress);
    $basketItems = array();
    $i = 0;
    foreach(Cart::content() as $row) {
      $product = Product::find($row->id);
      $basketItem = new \Iyzipay\Model\BasketItem();
      $basketItem->setId($product->id);
      $basketItem->setName($product->name);
      $basketItem->setCategory1($product->category->name);
      $basketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
      $basketItem->setPrice($row->price * $row->qty);
      $basketItems[$i] = $basketItem;
      $i++;
    }
    $request->setBasketItems($basketItems);
    # make request
    $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request,  $this->iyzico_options);
    # print result
    print_r($checkoutFormInitialize->getcheckoutFormContent());
    return $checkoutFormInitialize;
  }

  public function getPayment($checkoutForm) {
    switch ($checkoutForm->getStatus()) {
      case 'success':
      $product_sale = new Productsale;
      $last_package = $product_sale->orderBy('id','DESC')->first();
      $sale_package = $product_sale->createSalePackageNumber($last_package);
      $total_price = 0;
      $customer_id = Auth::user()->id;
      $middleman_id = 1;
      $payment_id = 5;
      $sale_array = array();

      foreach(Cart::content() as $row) {
        $product = Product::find($row->id);
        $product_sale = new ProductSale;
        $product_sale->product_id = $product->id;
        $product_sale->product_human_id = $product->product_id;
        $product_sale->product_name = $product->name;
        $product_sale->sale_id = 5;
        $product_sale->size_id =  $row->options->size['size_id'];
        $product_sale->color_id = $row->options->color['color_id'];
        $product_sale->sale_quantity = $row->qty;
        $product_sale->category_id = $product->category_id;
        $product_sale->sale_price = $row->price * $row->qty;
        $product_sale->statu = 1;
        $product_sale->campaign_id = null;
        $product_sale->payment_id = 2;
        $product_sale->created_at = Carbon::now();
        $product_sale->seller_id = 1;
        $product_sale->customer_id = $customer_id;
        $product_sale->middleman_id = $middleman_id;
        $product_sale->sale_package = $sale_package;
        $product_sale->save();
        $product->sizes()->where('size_id', $row->size['size_id'])
        ->where('color_id',$row->color['color_id'])
        ->decrement('stock',$row->qty);
        $online_order = new OnlineOrder;
        $adress_id = Session::get('adress');
        $online_order->createOrder($checkoutForm,$adress_id,$product_sale);
        Cart::destroy();
      }
      Mail::to(Auth::user())->send(new SendSaleSuccess($sale_package,$adress_id));
      Mail::to(User::where('email','ugur.muslim@gmail.com')->first())->send(new AdminSaleSuccess($sale_package,$adress_id));

      Session::flash('success','Ödemeniz Alındı');
      break;
      default:
      $online_order = new OnlineOrder;
      $adress_id = Session::get('adress');
      $online_order->createOrder($checkoutForm,$adress_id,$product_sale->id);
      Session::flash('error','Ödeme alınamadı, Tekrar deneyin.');
      break;
    }
  }


}
