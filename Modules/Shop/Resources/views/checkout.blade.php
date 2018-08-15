@extends('shop::layouts.master')
@section('title','SEPET GÖRÜNTÜLE|')
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
				<span class="stext-109 cl4">
					{{__('views.shop.shopping_cart')}}
				</span>
			</div>
		</div>
		<!-- Shoping Cart -->
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">{{__('views.shop_product')}}</th>
									<th class="column-2"></th>
									<th class="column-3">{{__('views.shop_price')}}</th>
									<th class="column-4">{{__('views.shop_quantity')}}</th>
									<th class="column-5">{{__('views.shop_total')}}</th>
								</tr>
								@foreach(Cart::content() as $row)
									@php
									$product = Modules\Product\Entities\Product::find($row->id);
								@endphp
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$product->name}}<br>	<span>{{$row->options->color['color_name']}}</span>
										<span>{{$row->options->size['size_name']}}</span>
									</td>
									<td class="column-3"><span class="simge-tl">&#8378;</span>{{$product->price}}</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0" data-id = {{$product->price}}>
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>

											<input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product1"
											value="{{$row->qty}}" data-id = {{$row->rowId}} readonly>

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									<td class="column-5"><span class="row_total_price">{{$product->price*$row->qty}}</span> <span class="simge-tl">&#8378;</span> </td>
								</tr>
								<input type="number" name="row_id[]" value="{{$row->id}}" hidden>
								<input type="number" name="product_human_id[]" value="{{$product->product_id}}" hidden>
								<input type="number" name="product_id[]" value="{{$product->id}}" hidden>
								<input type="text" name="product_name[]" value="{{$product->name}}" hidden>
								<input type="number" name="product_price[]" value="{{$product->price}}" hidden>
								<input type="number" name="product_qty[]" value="{{$row->qty}}" hidden>
								<input type="number" name="qty_price[]" value="{{$row->price}}" hidden>
								<input type="number" name="product_color[]" value="{{$row->options->color['color_id']}}" hidden>
								<input type="number" name="product_size[]" value="{{$row->options->size['size_id']}}" hidden>
							@endforeach
						</table>
					</div>


				</div>
			</div>

			<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
				<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
					<h4 class="mtext-109 cl2 p-b-30">
						{{__('views.shop.cart_totals')}}
					</h4>

					<div class="flex-w flex-t bor12 p-b-13">
						<div class="size-208">
							<span class="stext-110 cl2">
								{{__('views.shop.sub_totals')}}

							</span>
						</div>

						<div class="size-209">
							<span class="mtext-110 cl2">
								<span class="simge-tl">&#8378;</span><span class="subtotal">{{Cart::subtotal()}}</span>
							</span>
						</div>
					</div>

					<div class="flex-w flex-t bor12 p-t-15 p-b-30">
						<div class="size-208 w-full-ssm">
							<span class="stext-110 cl2">
								{{__('views.shop.shipping')}}
							</span>
						</div>

						<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
							<p class="mtext-110 cl6 p-t-2">
								Kapıda Ödeme - <span class="simge-tl">&#8378;</span>8
							</p>
							{{--
							<div class="p-t-15">
							<span class="stext-112 cl8">
							Calculate Shipping
						</span>

						<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
						<select class="js-select2" name="time">
						<option>Select a country...</option>
						<option>USA</option>
						<option>UK</option>
					</select>
					<div class="dropDownSelect2"></div>
				</div>

				<div class="bor8 bg0 m-b-12">
				<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="state" placeholder="State /  country">
			</div>

			<div class="bor8 bg0 m-b-22">
			<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="postcode" placeholder="Postcode / Zip">
		</div>

		<div class="flex-w">
		<div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
		Update Totals
	</div>
</div>

</div>
--}}
</div>
</div>

<div class="flex-w flex-t p-t-27 p-b-33">
	<div class="size-208">
		<span class="mtext-101 cl2">
		<p>	{{__('views.shop.cart_total')}}</p>
		</span>
		<span class="mtext-101 cl2 mt-2">
		<p class="mt-2 ">	{{__('views.shop.cart_tax')}}</p>
		</span>
	</div>

	<div class="size-209 p-t-1">
		<span class="mtext-110 cl2">
			<span class="simge-tl">&#8378;</span><span class="total">{{Cart::total()}}</span></br>
		<p class="mt-2"><span class="simge-tl">&#8378;</span><span class="tax">{{Cart::tax()}}</span></p>
		</span>
	</div>
</div>
<a href="{{route('checkout.index')}}">
	<button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
		{{__('views.buttons.proceed_to_checkout')}}
	</button>
</a>
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

		$('.wrap-num-product').on('click change keyup',function(){
			var	$row_id = $(this).find('.num-product').attr('data-id');
			var	$row_qty = $(this).find('.num-product').val();
			var	$row_price = $(this).attr('data-id');
				$.ajax({
					dataType:'json',
					url: '{{url('cart/update')}}',
					type: 'post',
					data: { _token: '{{csrf_token()}}',
					row_id : $row_id,
					row_qty : $row_qty},
					dataType: 'JSON',
					success: function(response) {
						$.ajax({
							dataType:'json',
							url: '{{url('api/cart')}}',
							type: 'get',
							dataType: 'JSON',
							success: function(response) {
								$('.subtotal').html(response.subtotal);
								$('.total').html(response.total);
								$('.tax').html(response.tax);
								$('.row_total_price').html($row_price*$row_qty);
							}
						});
					}
				});
			});

			function getCartTotal() {
				window.location.replace('{{route('shop.checkout')}}');
			}

			$('.how-itemcart1').on('click',function() {
				var	$parent_tr = $(this).parents('tr');
				var $row_id = $parent_tr.find('.num-product').attr('data-id');
				$.ajax({
					dataType:'json',
					url: '{{url('cart/remove')}}' + '/' + $row_id,
					type: 'get',
					dataType: 'JSON',
					success: function(response) {
						window.location.replace('{{route('shop.checkout')}}');
					}
				});
			})
	</script>
	<!--===============================================================================================-->
	<script src="{{asset('modules/shop/js/main.js')}}"></script>

@endsection
