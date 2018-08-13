@extends('shop::layouts.master')
@section('title','MAĞAZA RAPOR |')
@section('content')
	<body class="animsition">
		@include('shop::partials._shopping_header')
		<!-- Cart -->
		@include('shop::partials._shopping_cart')
		<!-- Product -->
		<div class="bg0 m-t-23 p-b-140">
			<div class="container">
				@include('shop::partials._products_filter')

				<div class="row isotope-grid">
					@foreach($products as $product)
						@if($product->images()->mainImage()->first())
							<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->category->name}}">
								<!-- Block2 -->
								<div class="block2">
									<div class="block2-pic hov-img0">
										<a href="{{route('product.shop-detail',$product->slug)}}">
											<img src="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}" style="width:255px; height:315px;" alt="{{$product->slug}}">
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
									</div>
								</div>
							</div>
						@endif
					@endforeach
				</div>
				{{ $products->links() }}
				<!-- Load more -->
				<div class="flex-c-m flex-w w-full p-t-45">
					<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
						{{__('views.shop_load_more')}}
					</a>
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
