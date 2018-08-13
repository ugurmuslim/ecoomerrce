@extends('shop::layouts.master')
@section('title','HESAP DETAYI |')
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
        </a>
      </div>
      <div class="row mt-5">
        <div class="col-sm-10 col-md-8 col-lg-6 ">
          <div class="p-b-30 m-lr-15-sm">

            <ul class="with-bullets">
              <li class="with-bullets mt-3"><a href="{{route('account.create')}}"><h6>Yeni Adres Bilgisi Yarat</h6></a></li>
              <li class="with-bullets mt-3"><a href="{{route('account.edit')}}">Adres Bilgilerini Değiştir</a></li>
              <li class="with-bullets mt-3"><a href="{{route('account.password')}}">Kullanıcı Bilgileri</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
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
