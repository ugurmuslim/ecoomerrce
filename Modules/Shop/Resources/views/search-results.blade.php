@extends('shop::layouts.master')
@section('title','ARAMA SONUÇLARI |')
@section('content')
	<body class="animsition">

		<!-- Header -->
		@include('shop::partials._shopping_header')

		<!-- Cart -->
		@include('shop::partials._shopping_cart')

		<!-- Product Detail -->

	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10 text-center">
				<h3 class="ltext-103 cl5">
					{{ __('views.shop.products_general') }}</br>
					<h5>{{count($products)}} ürün eşleşiyor</h5>
				</h3>
			</div>
			<div class="row isotope-grid">
				@foreach($products as $product)
					@if($product->images()->mainImage(1)->first())
				<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->category->name}}">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img src="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}" style="width:255px; height:315px;" alt="{{$product->slug}}">

							<a href="{{route('shop.product-detail',$product->slug)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
								{{__('views.shop.products_quickview')}}
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="{{route('product.shop-detail',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">

								{{$product->name}}
								</a>
								<span class="stext-105 cl3">
								<span class="simge-tl">&#8378;</span> {{$product->price}}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="modules/shop/images/icons/icon-heart-01.png" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="modules/shop/images/icons/icon-heart-02.png" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
			@endif
			@endforeach
		</div>

			<!-- Load more -->

		</div>
	</section>
	<!-- Footer -->
	@include('shop::partials._footer')
	<!-- Back to top -->


@endsection
@section('shop_scripts')
	@include('shop::partials._shopping_javascript')


@endsection
