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
    $account->email = $request->email;
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
  }

  /**
  * Remove the specified resource from storage.
  * @return Response
  */
  public function destroy()
  {
  }
}
