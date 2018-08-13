@extends('shop::layouts.master')
@section('title','ŞİFRE DEĞİŞTİRME |')
@section('content')
  <body class="animsition">
    <!-- Header -->
    @include('shop::partials._shopping_header')
    <!-- Cart -->
    @include('shop::partials._shopping_cart')
    <!-- breadcrumb -->
    @include('partials._messages')

    <div class="container">
      <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{route('shop.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
          {{__('views.shop.menu_home')}}
          <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <a href="{{route('account.details')}}" class="stext-109 cl8 hov-cl1 trans-04">
          {{__('views.shop.menu_account')}}
          <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <a href="{{route('account.password')}}" class="stext-109 cl8 hov-cl1 trans-04">
          {{__('views.shop.menu_account_edit')}}
        </a>


      </div>
      <div class="row">
        <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
          <div class="p-b-30 m-lr-15-sm">
            <!-- Review -->
            <div class="flex-w flex-t p-b-68">
              <div class="size-207">
                <div class="flex-w flex-sb-m p-b-17">
                  <span class="mtext-107 cl2 p-r-20">
                    {{Auth::user()->name}}
                  </span>
                </div>
              </div>
            </div>
            <!-- Add review -->
            {!! Form::open(['route'=>['account.password_update'],'data-parsley-validate' => '','class' => 'w-full' ]) !!}
            <h5 class="mtext-108 cl2 p-b-7">
              {{__('views.shop.account_info_password')}}
            </h5>
            <p class="stext-102 cl6">
              Kullanıcı Bilgileri
            </p>
            <div class="row p-b-25">
              <div class="col-sm-12 p-b-5">
                <label class="stext-102 cl3" for="e-mail">E-mail</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="e-mail" type="e-mail" name="email" value="{{Auth::user()->email}}">
              </div>

              <div class="col-sm-12 p-b-5">
                <label class="stext-102 cl3" for="old_password">Şifrenizi Girin</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="old_password" type="password" name="old_password" value="">
              </div>

              <div class="col-sm-12 p-b-5">
                <label class="stext-102 cl3" for="new_password">Yeni Şifre</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="new_password" type="password" name="new_password" value="">
              </div>

              <div class="col-sm-12 p-b-5">
                <label class="stext-102 cl3" for="new_password_confirm">Tekrar Girin</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="new_password_confirm" type="password" name="new_password_confirm" value="">
              </div>

            </div>
            {{Form::submit(__('views.buttons.submit'),['class' => 'flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10']) }}
            {{Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    @include('shop::partials._footer')
    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
      <span class="symbol-btn-back-to-top">
        <i class="zmdi zmdi-chevron-up"></i>
      </span>
    </div>
  @endsection
  @section('shop_scripts')
    @include('shop::partials._shopping_javascript')
  @endsection
