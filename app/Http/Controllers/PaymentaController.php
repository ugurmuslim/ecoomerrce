<?php

namespace App\Http\Controllers;
require (base_path('vendor/iyzico/iyzipay-php/IyzipayBootstrap.php'));
use Auth;
use Modules\Cart\Entities\Payment;
use App\Models\Auth\User\User;
use Cart;
use Config;

use Illuminate\Http\Request;

class PaymentaController extends Controller
{


    public function __construct() {
      \IyzipayBootstrap::init();
      $this->iyzico_options = new \Iyzipay\Options();
      $this->iyzico_options->setApiKey(Config::get('services.iyizico.apikey'));
      $this->iyzico_options->setSecretKey(Config::get('services.iyizico.secretkey'));
      $this->iyzico_options->setBaseUrl(Config::get('services.iyizico.baseurl'));

    }

  public function checkoutRequest(Request $request) {
    $token = $request->token;
    $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
    $request->setLocale(\Iyzipay\Model\Locale::TR);
    $request->setToken($token);
    $shoppingPay = new Payment(null, null);
    $iyzico_options = $shoppingPay->options();
    # make request
    $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $iyzico_options);
    # print result
    //dd($checkoutForm);
    $user = User::find(Auth::user()->id);
    $shoppingPay->getPayment($checkoutForm,$user);

    return redirect()->route('shoppingcart.index');

  }
  public function create(Request $request)
  {
    $request = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest();
  $request->setLocale(\Iyzipay\Model\Locale::TR);
  $request->setConversationId("123456789");
  $request->setPrice("1");
  $request->setPaidPrice("1.2");
  $request->setCurrency(\Iyzipay\Model\Currency::TL);
  $request->setBasketId("B67832");
  $request->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
  $request->setCallbackUrl("http://localhost:8000/payment/callback");
  $request->setEnabledInstallments(array(2, 3, 6, 9));
  $buyer = new \Iyzipay\Model\Buyer();
  $buyer->setId("BY789");
  $buyer->setName("John");
  $buyer->setSurname("Doe");
  $buyer->setGsmNumber("+905350000000");
  $buyer->setEmail("email@email.com");
  $buyer->setIdentityNumber("74300864791");
  $buyer->setLastLoginDate("2015-10-05 12:43:35");
  $buyer->setRegistrationDate("2013-04-21 15:12:09");
  $buyer->setRegistrationAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
  $buyer->setIp("85.34.78.112");
  $buyer->setCity("Istanbul");
  $buyer->setCountry("Turkey");
  $buyer->setZipCode("34732");
  $request->setBuyer($buyer);
  $shippingAddress = new \Iyzipay\Model\Address();
  $shippingAddress->setContactName("Jane Doe");
  $shippingAddress->setCity("Istanbul");
  $shippingAddress->setCountry("Turkey");
  $shippingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
  $shippingAddress->setZipCode("34742");
  $request->setShippingAddress($shippingAddress);
  $billingAddress = new \Iyzipay\Model\Address();
  $billingAddress->setContactName("Jane Doe");
  $billingAddress->setCity("Istanbul");
  $billingAddress->setCountry("Turkey");
  $billingAddress->setAddress("Nidakule Göztepe, Merdivenköy Mah. Bora Sok. No:1");
  $billingAddress->setZipCode("34742");
  $request->setBillingAddress($billingAddress);
  $basketItems = array();
  $firstBasketItem = new \Iyzipay\Model\BasketItem();
  $firstBasketItem->setId("BI101");
  $firstBasketItem->setName("Binocular");
  $firstBasketItem->setCategory1("Collectibles");
  $firstBasketItem->setCategory2("Accessories");
  $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
  $firstBasketItem->setPrice("0.3");
  $basketItems[0] = $firstBasketItem;
  $secondBasketItem = new \Iyzipay\Model\BasketItem();
  $secondBasketItem->setId("BI102");
  $secondBasketItem->setName("Game code");
  $secondBasketItem->setCategory1("Game");
  $secondBasketItem->setCategory2("Online Game Items");
  $secondBasketItem->setItemType(\Iyzipay\Model\BasketItemType::VIRTUAL);
  $secondBasketItem->setPrice("0.5");
  $basketItems[1] = $secondBasketItem;
  $thirdBasketItem = new \Iyzipay\Model\BasketItem();
  $thirdBasketItem->setId("BI103");
  $thirdBasketItem->setName("Usb");
  $thirdBasketItem->setCategory1("Electronics");
  $thirdBasketItem->setCategory2("Usb / Cable");
  $thirdBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
  $thirdBasketItem->setPrice("0.2");
  $basketItems[2] = $thirdBasketItem;
  $request->setBasketItems($basketItems);
  # make request
  $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($request, $this->iyzico_options);
  # print result
print_r($checkoutFormInitialize);
  }



  /**
   * Store a newly created resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function store(Request $request)
  {
  }

  /**
   * Show the specified resource.
   * @return Response
   */
  public function show()
  {
      return view('cart::show');
  }

  /**
   * Show the form for editing the specified resource.
   * @return Response
   */
  public function edit()
  {
      return view('cart::edit');
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @return Response
   */
  public function update(Request $request)
  {
  }

  /**
   * Remove the specified resource from storage.
   * @return Response
   */
  public function destroy()
  {
  }

}
