<?php

namespace Modules\Cart\Http\Controllers;


require (base_path('vendor/iyzico/iyzipay-php/IyzipayBootstrap.php'));
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use Modules\Cart\Entities\Payment;
use App\Models\Auth\User\User;
use Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      if(!Auth::user()){
        return redirect()->back()->withError('Önce Kayıt olun veya giriş yapın');
      }
        $user = User::find(Auth::user()->id);
        if(!$user->accounts) {
          return redirect()->route('account.create')->withError("Adres Bilgilerinizin olması Gerekli");
        }
        return view('cart::checkout.index')->withUser($user);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */

    public function checkoutRequest(Request $request) {

      $token = $request->token;
      $request = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
      $request->setLocale(\Iyzipay\Model\Locale::TR);
      $request->setToken($token);
      $shoppingPay = new Payment;
      $iyzico_options = $shoppingPay->options();
      # make request
      $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($request, $iyzico_options);
      # print result
      $user = User::find(Auth::user()->id);
      $shoppingPay->getPayment($checkoutForm);
      $status = $checkoutForm->getStatus();

      return view('cart::checkout.result')->withStatus($status);

    }
    public function create(Request $request)
    {

      $user = User::find(Auth::user()->id);
      $shopPay = new Payment();
       $a = $shopPay->iyizipay($request);
      $payment_form = '<div id="iyzipay-checkout-form" class="popup"></div>';
      return view('cart::checkout.payment')->withPaymentform($payment_form);
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

     public function result()
     {
       return view('cart::checkout.result');
     }


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
