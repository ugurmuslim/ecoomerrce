@extends('shop::layouts.master')
@section('title','İLETİŞİM |')
@section('content')
	<body class="animsition">
		<!-- Header -->
		@include('shop::partials._shopping_header')
		<!-- Cart -->
		@include('shop::partials._shopping_cart')
	<!-- Title page -->
	<!-- Content page -->
	<section class="bg0 p-t-104 p-b-116">
		<div class="container">
			<div class="flex-w flex-tr">
				<div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
					<form>
						<h4 class="mtext-105 cl2 txt-center p-b-30">
							Mail Gönderin
						</h4>

						<div class="bor8 m-b-20 how-pos4-parent">
							<input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="email" placeholder="Email Adresiniz">
							<img class="how-pos4 pointer-none" src="{{asset('modules/shop/images/icons/icon-email.png')}}" alt="ICON">
						</div>

						<div class="bor8 m-b-30">
							<textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25" name="msg" placeholder="Nasıl yardımcı olabiliriz?"></textarea>
						</div>

						<button class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
							Gönder
						</button>
					</form>
				</div>

				<div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-map-marker"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Adres
							</span>

							<p class="stext-115 cl6 size-213 p-t-18">
								Beşiktaş Sinanpaşa Pasajı No : 4 Beşiktaş / İstanbul
							</p>
						</div>
					</div>

					<div class="flex-w w-full p-b-42">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-phone-handset"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Telefon
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								0850 444 77 88
							</p>
						</div>
					</div>

					<div class="flex-w w-full">
						<span class="fs-18 cl5 txt-center size-211">
							<span class="lnr lnr-envelope"></span>
						</span>

						<div class="size-212 p-t-2">
							<span class="mtext-110 cl2">
								Müşteri Hizmetleri
							</span>

							<p class="stext-115 cl1 size-213 p-t-18">
								iletişim@behicesglm.com
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
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
