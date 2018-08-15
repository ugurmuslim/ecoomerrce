@extends('shop::layouts.master')
@section('title','ADRES YARATMA |')
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
        <a href="{{route('account.create')}}" class="stext-109 cl8 hov-cl1 trans-04">
          {{__('views.shop.menu_adress_create')}}
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
            {!! Form::open(['route'=>['account.store'],'data-parsley-validate' => '','class' => 'w-full' ]) !!}
            <h5 class="mtext-108 cl2 p-b-7">
              {{__('views.shop.account_info_adress')}}
            </h5>
            <p class="stext-102 cl6">
              Adres Bilgileriniz ürünleri göndermemiz için gereklidir.
            </p>
            <div class="row p-b-25">
              <div class="col-12 p-b-5">
                <label class="stext-102 cl3" for="account_name">Adres İsmi</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="account_name" type="text" name="account_name" value="">
              </div>

              <div class="col-sm-6 p-b-5">
                <label class="stext-102 cl3" for="name">İsim</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name" value="">
              </div>

              <div class="col-sm-6 p-b-5">
                <label class="stext-102 cl3" for="lastname">Soyisim</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="lastname" type="text" name="lastname" value="">
              </div>

              <div class="col-12 p-b-5">
                <label class="stext-102 cl3" for="city">Şehir</label>
                <select class=" size-111 bor8 stext-102 cl2 p-lr-20" name="city" id="city">
                  <option disabled selected value>Şehir Seçin</option>
                </select>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20"  type="text" name="country" value="Türkiye" hidden>

              </div>
              <div class="col-12 p-b-5">
                <label class="stext-102 cl3" for="adress">Adres</label>
                <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="adress" name="adress"></textarea>
              </div>

              <div class="col-6 p-b-5">
                <label class="stext-102 cl3" for="zip_code">Posta Kodu</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="zip_code" type="text" name="zip_code" value="">
              </div>
              <div class="col-6 p-b-5">
                <label class="stext-102 cl3" for="phone">Telefon Numarası</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="phone" type="text" name="phone" value="">
              </div>

              <div class="col-6 p-b-5">
                <label class="stext-102 cl3" for="id_number">TC Kimlik No</label>
                <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="id_number" type="text" name="id_number" value="">
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

    <script type="text/javascript">
      $('.select2').select2();

      var select_city = $('#city');
      $.ajax({
        dataType:'json',
        type:'get',
        url:'{{asset('modules/account/js/cities_of_turkey.json')}}',
        data:'',
        success: function(cities) {
          $.each(cities,function(i,city) {
            var $city_name = city.name;
            select_city.append('<option value="' +$city_name + ' ">' +  $city_name +' </option>')
          });
        }
      });
    </script>

  @endsection
