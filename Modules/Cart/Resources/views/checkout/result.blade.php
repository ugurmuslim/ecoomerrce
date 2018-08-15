@extends('shop::layouts.master')
@section('title','MAĞAZA RAPOR |')
@section('content')
	<body class="animsition">

		<!-- Header -->
		@include('shop::partials._shopping_header')

		<div class="text-center" style="background-color:#717fe0; padding:5% 5%">
			<h2 style="color:white;">
				BEHİCESGLM</h2>
				<div class="mt-5">
					@if(Session::has('success'))
						<h1 style="color:white;">TEBRİKLER! ÖDEMENİZ BAŞARI İLE GERÇEKLEŞTİRİLDİ</h1>
					@else
						<h1 style="color:white;">ÜZGÜNÜZ! ÖDEME SIRASINDA BİR HATA OLUŞTU. LÜTFEN TEKRAR DENEYİN</h1>
					@endif
				</div>
			</div>
			<div class="container mt-5">
				<a href="{{route('shop.index')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer mt-5">
					{{__('views.buttons.continue_to_shopping')}}
				</a>
			</div>


			<div class="mt-5">
				<!-- Footer -->
				@include('shop::partials._footer')
			</div>

			<!-- Back to top -->
			<div class="btn-back-to-top" id="myBtn">
				<span class="symbol-btn-back-to-top">
					<i class="zmdi zmdi-chevron-up"></i>
				</span>
			</div>
		@endsection

		@section('shop_scripts')
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/animsition/js/animsition.min.js')}}"></script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/bootstrap/js/popper.js')}}"></script>
			<script src="{{asset('modules/shop/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/select2/select2.min.js')}}"></script>
			<script>
			$('body').bind('beforeunload',function(){
				window.location.replace('{{route('shop.checkout')}}');
			});
				$(".js-select2").each(function(){
					$(this).select2({
						minimumResultsForSearch: 20,
						dropdownParent: $(this).next('.dropDownSelect2')
					});
				})
			</script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
			<script>
				$('.js-pscroll').each(function(){
					$(this).css('position','relative');
					$(this).css('overflow','hidden');
					var ps = new PerfectScrollbar(this, {
						wheelSpeed: 1,
						scrollingThreshold: 1000,
						wheelPropagation: false,
					});

					$(window).on('resize', function(){
						ps.update();
					})
				});


			</script>
			<!--===============================================================================================-->
			<script src="{{asset('modules/shop/js/main.js')}}"></script>

		@endsection
