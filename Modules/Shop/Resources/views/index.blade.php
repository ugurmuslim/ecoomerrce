@extends('shop::layouts.master')
@section('title','MAĞAZA|')
@section('content')
	<body class="animsition">
		<!-- Header -->
		@include('shop::partials._shopping_header')
		<!-- Cart -->
		@include('shop::partials._shopping_cart')
		<!-- Slider -->
		@include('shop::partials._slider')
		<!-- Banner -->
		<div class="sec-banner bg0 p-t-80 p-b-50">
			<div class="container">

				<div class="row isotope-grid">
					@foreach($categories as $category)
						@if($category->image()->where('type',2)->first())

							<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
								<!-- Block2 -->
								<div class="block2">
									<a href="{{route('categories.products',$category->slug)}}">
										<div class="block2-pic hov-img0">
											<img src="{{asset('images/categories/' . $category->image()->where('type',2)->first()->name)}}" style="width:255px; height:315px;" alt="{{$category->slug}}">
											<a href="{{route('categories.products',$category->slug)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
												{{ $category->name}}
											</a>
											<a href="{{route('categories.products',$category->slug)}}" class="btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 category-name">
												{{ $category->name}}
											</a>
										</div>

									</div>
								</div>
							@endif
						@endforeach
					</div>
				</div>
			</div>
			<!-- Product -->
			<section class="bg0 p-t-23 p-b-140">
				<div class="container">
					<div class="p-b-10 text-center"  id="products">
						<h3 class="ltext-103 cl5">
							{{ __('views.shop_most_seller') }}
						</h3>
					</div>
					<!-- Filter -->
					@include('shop::partials._products_filter')
					<div class="row isotope-grid">
						@foreach($products as $product)
							@if($product->images()->mainImage()->first())

								<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->category->name}}">
									<!-- Block2 -->
									<div class="block2">
										<div class="block2-pic hov-img0">
											<a href="{{route('product.shop-detail',$product->slug)}}">
											<img src="{{asset('images/products/' . $product->images()->mainImage()->name)}}" style="width:255px; height:315px;" alt="{{$product->slug}}">
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

					<div class="p-b-10 text-center">
						<h3 class="ltext-103 cl5 ">
							{{ __('views.shop.instagram_products') }}
						</h3>
					</div>

					<div class="row isotope-grid mt-5">
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
					<!-- Load more -->
					<div class="flex-c-m flex-w w-full p-t-45">
						<a href="{{route('products.products')}}" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
							{{__('views.shop_load_more')}}
						</a>
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
