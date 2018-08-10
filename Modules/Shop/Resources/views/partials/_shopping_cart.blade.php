<div class="wrap-header-cart js-panel-cart">
  <div class="s-full js-hide-cart"></div>

  <div class="header-cart flex-col-l p-l-65 p-r-25">
    <div class="header-cart-title flex-w flex-sb-m p-b-8">
      <span class="mtext-103 cl2">
        {{__('views.shop.shop_your_cart')}}
      </span>

      <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
        <i class="zmdi zmdi-close"></i>
      </div>
    </div>

    <div class="header-cart-content flex-w js-pscroll">
      <ul class="header-cart-wrapitem w-full">
        @foreach(Cart::content() as $row)

        @php
          $product = Modules\Product\Entities\Product::find($row->id);

        @endphp
      <li class="header-cart-item flex-w flex-t m-b-15">

        <div class="header-cart-item-img">
          <img src="{{asset('images/products/' . $product->images()->mainImage(1)->name)}}" data-id="{{$row->rowId}}" alt="IMG">
        </div>

        <div class="header-cart-item-txt p-t-8">
          <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
            {{$product->name}}
          </a>

          <span class="header-cart-item-info">
            {{$row->qty}} x {{$row->price}} <span class="simge-tl">&#8378;</span>
          </span>

          <span class="header-cart-item-info">
            {{$row->options->size['size_name']}}
          </span>

          <span class="header-cart-item-info">
            {{$row->options->color['color_name']}}
          </span>

        </div>
      </li>
    @endforeach
      <div class="header-cart-buttons flex-w w-full">
        <a href="{{route('shop.checkout')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
          {{__('views.shop.shop_go_to_cart')}}
        </a>
      </div>
    </div>
  </div>
</div>
