@extends('shop::layouts.master')
@section('shop_styles')
	{{ Html::style(mix('assets/common/css/parsley.css')) }}
@section('title','ÜRÜN |')
@section('content')
	<body class="animsition">

		<!-- Header -->
		@include('shop::partials._shopping_header')

		<!-- Cart -->
		@include('shop::partials._shopping_cart')

		<!-- breadcrumb -->
		<div class="container">
			<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
				<a href="{{route('shop.index')}}" class="stext-109 cl8 hov-cl1 trans-04">
					{{__('views.shop.menu_home')}}
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>

				<a href="{{route('categories.products',$product->category->slug)}}" class="stext-109 cl8 hov-cl1 trans-04">
					{{$product->category->name}}
					<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
				</a>

				<span class="stext-109 cl4">
					{{$product->name}}
				</span>
			</div>
		</div>


		<!-- Product Detail -->
		<section class="sec-product-detail bg0 p-t-65 p-b-60">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="{{asset('images/products/' . $product->images()->mainImage()->name)}}">
										<div class="wrap-pic-w pos-relative">
											<img src="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}" class="product-detail-photos" alt="IMG-PRODUCT">
											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
									@foreach($product->images()->featuredImages() as $image)
										<div class="item-slick3" data-thumb="{{asset('images/products/' . $image->name)}}">
											<div class="wrap-pic-w pos-relative">
												<img src="{{asset('images/products/' . $image->name)}}" class="product-detail-photos" alt="IMG-PRODUCT">

												<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
													<i class="fa fa-expand"></i>
												</a>
											</div>
										</div>
									@endforeach

								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							{!! Form::open(['route'=>['cart.store'],'data-parsley-validate' => '' ]) !!}
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								{{$product->name}}
								<input type="number" name="product_id" value="{{$product->id}}" hidden>
								<input type="text" name="product_name" value="{{$product->name}}" hidden>
							</h4>

							<span class="mtext-106 cl2">
								<span class="simge-tl">&#8378;</span> {{$product->price}}
								<input type="number" name="product_price" value="{{$product->price}}" hidden>

							</span>

							<p class="stext-102 cl3 p-t-23">
								{{$product->details}}
							</p>

							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										{{__('views.shop.shop_size')}}
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 size" name="size" required>
												<option  disabled selected value>{{__('views.shop.shop_choose_size')}}</option>
												@php
													$s = null;
												@endphp
												@foreach($product->sizes()->where('stock','!=',0)->get() as $size)
													@if($size->id == $s)
														@break
													@endif
													<option value="{{$size->id . '-' . $size->attribute_long}}">{{$size->attribute_long}}</option>

													@php
														$s = $size->id;
													@endphp
												@endforeach
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										{{__('views.shop.shop_color')}}
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 color" name="color" required>
												<option  disabled selected value>{{__('views.shop.shop_choose_color')}}</option>
												@php
													$c = null;
												@endphp
												@foreach($product->colors()->where('stock','>',0)->get() as $color)
													@if($color->id == $c)
														@break
													@endif
													<option value="{{$color->id . '-' . $color->attribute_long}}">{{$color->attribute_long}}</option>
													@php
														$c = $color->id;
													@endphp
												@endforeach
											</select>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="flex-w flex-r-m p-b-10">
								<div class="size-204 flex-w flex-m respon6-next">
									<div class="wrap-num-product flex-w m-r-20 m-tb-10">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity" value="1" required>

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
										{{__('views.shop.shop_add_to_cart')}}
									</button>
								</div>
							</div>
						</div>
						<!--  -->
						{{--	<div class="flex-w flex-m p-l-100 p-t-40 respon7">
						<div class="flex-m bor9 p-r-10 m-r-11">
						<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
						<i class="zmdi zmdi-favorite"></i>
					</a>
				</div>

				<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
				<i class="fa fa-facebook"></i>
			</a>

			<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
			<i class="fa fa-twitter"></i>
		</a>

		<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
		<i class="fa fa-google-plus"></i>
	</a>
</div>
--}}</div>
</div>
</div>

{{--
	<div class="bor10 m-t-50 p-t-43 p-b-40">
		<!-- Tab01 -->
		<div class="tab01">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item p-b-10">
					<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Description</a>
				</li>

				<li class="nav-item p-b-10">
					<a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
				</li>

				<li class="nav-item p-b-10">
					<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Reviews (1)</a>
				</li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content p-t-43">
				<!-- - -->
				<div class="tab-pane fade show active" id="description" role="tabpanel">
					<div class="how-pos2 p-lr-15-md">
						<p class="stext-102 cl6">
							Aenean sit amet gravida nisi. Nam fermentum est felis, quis feugiat nunc fringilla sit amet. Ut in blandit ipsum. Quisque luctus dui at ante aliquet, in hendrerit lectus interdum. Morbi elementum sapien rhoncus pretium maximus. Nulla lectus enim, cursus et elementum sed, sodales vitae eros. Ut ex quam, porta consequat interdum in, faucibus eu velit. Quisque rhoncus ex ac libero varius molestie. Aenean tempor sit amet orci nec iaculis. Cras sit amet nulla libero. Curabitur dignissim, nunc nec laoreet consequat, purus nunc porta lacus, vel efficitur tellus augue in ipsum. Cras in arcu sed metus rutrum iaculis. Nulla non tempor erat. Duis in egestas nunc.
						</p>
					</div>
				</div>

				<!-- - -->
				<div class="tab-pane fade" id="information" role="tabpanel">
					<div class="row">
						<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
							<ul class="p-lr-28 p-lr-15-sm">
								<li class="flex-w flex-t p-b-7">
									<span class="stext-102 cl3 size-205">
										Weight
									</span>

									<span class="stext-102 cl6 size-206">
										0.79 kg
									</span>
								</li>

								<li class="flex-w flex-t p-b-7">
									<span class="stext-102 cl3 size-205">
										Dimensions
									</span>

									<span class="stext-102 cl6 size-206">
										110 x 33 x 100 cm
									</span>
								</li>

								<li class="flex-w flex-t p-b-7">
									<span class="stext-102 cl3 size-205">
										Materials
									</span>

									<span class="stext-102 cl6 size-206">
										60% cotton
									</span>
								</li>

								<li class="flex-w flex-t p-b-7">
									<span class="stext-102 cl3 size-205">
										Color
									</span>

									<span class="stext-102 cl6 size-206">
										Black, Blue, Grey, Green, Red, White
									</span>
								</li>

								<li class="flex-w flex-t p-b-7">
									<span class="stext-102 cl3 size-205">
										Size
									</span>

									<span class="stext-102 cl6 size-206">
										XL, L, M, S
									</span>
								</li>
							</ul>
						</div>
					</div>
				</div>

				<!-- - -->
				<div class="tab-pane fade" id="reviews" role="tabpanel">
					<div class="row">
						<div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
							<div class="p-b-30 m-lr-15-sm">
								<!-- Review -->
								<div class="flex-w flex-t p-b-68">
									<div class="wrap-pic-s size-109 bor0 of-hidden m-r-18 m-t-6">
										<img src="images/avatar-01.jpg" alt="AVATAR">
									</div>

									<div class="size-207">
										<div class="flex-w flex-sb-m p-b-17">
											<span class="mtext-107 cl2 p-r-20">
												Ariana Grande
											</span>

											<span class="fs-18 cl11">
												<i class="zmdi zmdi-star"></i>
												<i class="zmdi zmdi-star"></i>
												<i class="zmdi zmdi-star"></i>
												<i class="zmdi zmdi-star"></i>
												<i class="zmdi zmdi-star-half"></i>
											</span>
										</div>

										<p class="stext-102 cl6">
											Quod autem in homine praestantissimum atque optimum est, id deseruit. Apud ceteros autem philosophos
										</p>
									</div>
								</div>

								<!-- Add review -->
								<form class="w-full">
									<h5 class="mtext-108 cl2 p-b-7">
										Add a review
									</h5>

									<p class="stext-102 cl6">
										Your email address will not be published. Required fields are marked *
									</p>

									<div class="flex-w flex-m p-t-50 p-b-23">
										<span class="stext-102 cl3 m-r-16">
											Your Rating
										</span>

										<span class="wrap-rating fs-18 cl11 pointer">
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<i class="item-rating pointer zmdi zmdi-star-outline"></i>
											<input class="dis-none" type="number" name="rating">
										</span>
									</div>

									<div class="row p-b-25">
										<div class="col-12 p-b-5">
											<label class="stext-102 cl3" for="review">Your review</label>
											<textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="review"></textarea>
										</div>

										<div class="col-sm-6 p-b-5">
											<label class="stext-102 cl3" for="name">Name</label>
											<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name" type="text" name="name">
										</div>

										<div class="col-sm-6 p-b-5">
											<label class="stext-102 cl3" for="email">Email</label>
											<input class="size-111 bor8 stext-102 cl2 p-lr-20" id="email" type="text" name="email">
										</div>
									</div>

									<button class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
										Submit
									</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	--}}
</div>

<div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
	<span class="stext-107 cl6 p-lr-25">
		{{__('views.shop.shop_product_number')}} : {{$product->product_id}}

	</span>

	<span class="stext-107 cl6 p-lr-25">
		{{__('views.shop.shop_category')}} : {{$product->category->name}}
	</span>
</div>
</section>


<!-- Related Products -->
<section class="sec-relate-product bg0 p-t-45 p-b-105">
	<div class="container">
		<div class="p-b-45">
			<h3 class="ltext-106 cl5 txt-center">
				{{__('views.shop.shop_related_products')}}
			</h3>
		</div>

		<!-- Slide2 -->
		<div class="row isotope-grid">
					@foreach($relatedproducts as $related_product)
					@if($product->images()->mainImage()->first())
						<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->category->name}}">
							<!-- Block2 -->
							<div class="block2">
								<div class="block2-pic hov-img0">
									<img src="{{asset('images/products/' . $related_product->images()->mainImage()->name)}}" style="width:255px; height:315px;"alt="IMG-PRODUCT">

									<a href="{{route('product.shop-detail',$product->slug)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
										{{__('views.shop.products_quickview')}}
									</a>
								</div>

								<div class="block2-txt flex-w flex-t p-t-14">
									<div class="block2-txt-child1 flex-col-l ">
										<a href="{{route('product.shop-detail',$product->slug)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
											{{$related_product->name}}
										</a>

										<span class="stext-105 cl3">
											<span class="simge-tl">&#8378;</span> {{$related_product->price}}

										</span>
									</div>
									{{--
										<div class="block2-txt-child2 flex-r p-t-3">
											<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
												<img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-01.png" alt="ICON">
												<img class="icon-heart2 dis-block trans-04 ab-t-l" src="images/icons/icon-heart-02.png" alt="ICON">
											</a>
										</div>--}}
									</div>
									</div>
								</div>
						@endif
					@endforeach
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

	<!-- Modal1 -->
	{{--<div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
		<div class="overlay-modal1 js-hide-modal1"></div>

		<div class="container">
			<div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
				<button class="how-pos3 hov3 trans-04 js-hide-modal1">
					<img src="images/icons/icon-close.png" alt="CLOSE">
				</button>

				<div class="row">
					<div class="col-md-6 col-lg-7 p-b-30">
						<div class="p-l-25 p-r-30 p-lr-0-lg">
							<div class="wrap-slick3 flex-sb flex-w">
								<div class="wrap-slick3-dots"></div>
								<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

								<div class="slick3 gallery-lb">
									<div class="item-slick3" data-thumb="images/product-detail-01.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-01.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-02.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-02.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>

									<div class="item-slick3" data-thumb="images/product-detail-03.jpg">
										<div class="wrap-pic-w pos-relative">
											<img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

											<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="images/product-detail-03.jpg">
												<i class="fa fa-expand"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-6 col-lg-5 p-b-30">
						<div class="p-r-50 p-t-5 p-lr-0-lg">
							<h4 class="mtext-105 cl2 js-name-detail p-b-14">
								Lightweight Jacket
							</h4>

							<span class="mtext-106 cl2">
								$58.79
							</span>

							<p class="stext-102 cl3 p-t-23">
								Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat.
							</p>

							<!--  -->
							<div class="p-t-33">
								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Size
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												<option>Size S</option>
												<option>Size M</option>
												<option>Size L</option>
												<option>Size XL</option>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-203 flex-c-m respon6">
										Color
									</div>

									<div class="size-204 respon6-next">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2" name="time">
												<option>Choose an option</option>
												@foreach($product->colors()->where('stock','>',0)->get() as $color)
													<option>{{$color->attribute_long}}</option>
												@endforeach
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</div>

								<div class="flex-w flex-r-m p-b-10">
									<div class="size-204 flex-w flex-m respon6-next">
										<div class="wrap-num-product flex-w m-r-20 m-tb-10">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product" value="1">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>

										<button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
											{{__('views.shop.shop_add_to_cart')}}
										</button>
									</div>
								</div>
							</div>

							<!--  -->
							{{--<div class="flex-w flex-m p-l-100 p-t-40 respon7">
								<div class="flex-m bor9 p-r-10 m-r-11">
									<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
										<i class="zmdi zmdi-favorite"></i>
									</a>
								</div>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
									<i class="fa fa-facebook"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
									<i class="fa fa-twitter"></i>
								</a>

								<a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
									<i class="fa fa-google-plus"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	--}}
@endsection
@section('shop_scripts')

	@include('shop::partials._shopping_javascript')
	{{ Html::script(mix('assets/common/js/parsley.min.js')) }}
	{{ Html::script(mix('assets/common/js/i18n/parsley-tr.js')) }}
	<script type="text/javascript">
		var $size_select = $('.size');
		var $color_select = $('.color');
		var $product_slug = "{{$product->slug}}";
		$('.size').on('change',function() {
			var $size = $('.size :selected').val();
			var $size = $size.split("-");
			var $attr = $size[0];
			var $attr_id = 2;
			getAttr($product_slug,$attr_id,$attr,$color_select);

		});
		$('.color').on('change',function() {
			var $color = $('.color :selected').val();
			var $color = $color.split("-");
			var $attr = $color[0];
			console.log($attr);
			var $attr_id = 1;
			getAttr($product_slug,$attr_id,$attr,$size_select);

		})

		function getAttr($product_slug,$attr_id,$attr,$selector) {
			$select = $selector;
			$select.empty();
			$.ajax({
				dataType:'json',
				type:'get',
				url:'{{url('api/attributes')}}' + '/' + $product_slug + '/' + $attr_id + '/' + $attr,
				data:'',
				success: function(attributes) {
					$.each(attributes,function(i,attribute) {
						if(attribute.pivot.stock > 0) {
							$attr_option = '<option value=' + attribute.id + '-' + attribute.attribute_long+'>' + attribute.attribute_long + ' </option>'
							$select.append($attr_option);
						}
					});
				}
			});
		}
	</script>

@endsection
