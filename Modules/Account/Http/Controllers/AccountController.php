<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Account\Entities\Accountinfo;
use Auth;
use App\Models\Auth\User\User;


class AccountController extends Controller
{

  public function detail()
  {
    return view('account::detail');
  }
  /**
  * Show the form for creating a new resource.
  * @return Response
  */
  public function create()
  {
    $user = User::find(Auth::user()->id);
    return view('account::information.create')->withUser($user);
  }

  /**
  * Store a newly created resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function store(Request $request)
  {
    $request->validate(array(
      'name' => 'required|max:15',
      'lastname' => 'required|max:20',
    ));
    $account = new Accountinfo;
    $account->user_id = Auth::user()->id;
    $account->account_name = $request->account_name;
    $account->first_name = $request->name;
    $account->last_name = $request->lastname;
    $account->adress = $request->adress;
    $account->country = $request->country;
    $account->city = $request->city;
    $account->phone_number = $request->phone;
    $account->zip_code = $request->zip_code;
    $account->id_number = $request->id_number;
    $account->save();
    $request->session()
    ->flash('success',"Tebrikler. Bilgileirniz Kaydedildi.");
    return redirect()->back();

  }

  /**
  * Show the specified resource.
  * @return Response
  */

  public function getAdresses($adress_id)
  {
    $account = AccountInfo::find($adress_id);
    return $account;
  }
  public function show()
  {
    return view('account::show');
  }

  /**
  * Show the form for editing the specified resource.
  * @return Response
  */
  public function edit()
  {
    $user = User::find(Auth::user()->id);
    $adresses = $user->accounts()->get();
    return view('account::information.edit')->withUser($user)
    ->withAdresses($adresses);
  }

  /**
  * Update the specified resource in storage.
  * @param  Request $request
  * @return Response
  */
  public function update(Request $request)
  {
    $request->validate(array(
    'name' => 'required|max:15',
    'lastname' => 'required|max:20',
    ));
    $account = Accountinfo::find($request->account_name);
    $account->account_name = $request->account_name_change;
    $account->first_name = $request->name;
    $account->last_name = $request->lastname;
    $account->adress = $request->adress;
    $account->country = $request->country;
    $account->city = $request->city;
    $account->phone_number = $request->phone;
    $account->zip_code = $request->zip_code;
    $account->id_number = $request->id_number;
    $account->save();
    $request->session()
    ->flash('success',"Tebrikler. Bilgileirniz Değiştirildi.");
    return redirect()->back();

  }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy()
  {
  }

  public function passwordEdit()
  {
    return view('account::information.password');
  }


  public function passwordUpdate(Request $request)
  {
    $request->validate(array(
    'email' => 'required|email',
    ));
    $user = User::find(Auth::user()->id);
    $user->email = $request->email;
    if($old_password = $request->old_password) {
      $request->validate(array(
      'email' => 'required|email',
      'old_password' => 'required',
      'new_password' => 'required',
      'new_password_confirm' => 'required',
      ));
      if($user->checkPassword($old_password)) {
        $user->password = bcrypt($request['new_password']);
        $user->save();
        $request->session()
        ->flash('success',"Tebrikler. Bilgileirniz Değiştirildi.");
        return redirect()->back();
      }
      $request->session()
      ->flash('error',"Eski Şifrenizi doğru girmediniz.");
      return redirect()->back();
    }
    $user->save();
    $request->session()
    ->flash('success',"Tebrikler. Bilgileirniz Değiştirildi.");
    return redirect()->back();




  }

}
