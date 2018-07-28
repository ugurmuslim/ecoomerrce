@extends('shop::layouts.master')
@section('title','MAĞAZA RAPOR |')
@section('content')
	<body class="animsition">

		<!-- Header -->
		@include('shop::partials._shopping_header')


    <div class="container mt-5">

    @include('partials._messages')
  </div>


			<!-- Footer -->

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
