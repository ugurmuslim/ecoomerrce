<div class="flex-w flex-sb-m p-b-52">
  @include('shop::partials._categories_select')
  <div class="flex-w flex-c-m m-tb-10">
    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
      <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
      <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
      {{__('views.shop_filter')}}
    </div>

    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
      <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
      <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
      {{__('views.shop_search')}}
    </div>
  </div>

  <!-- Search product -->
  <div class="dis-none panel-search w-full p-t-10 p-b-15">
    <div class="bor8 dis-flex p-l-15">
      <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
        <i class="zmdi zmdi-search"></i>
      </button>
      <form action="{{route('products.search')}}" method="GET">
      <input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="{{__('views.shop_search')}}">
    </form>
    </div>
  </div>

  <!-- Filter -->
  <div class="dis-none panel-filter w-full p-t-10">
    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
      <div class="filter-col1 p-r-15 p-b-27">
{{--
        <div class="mtext-102 cl2 p-b-15">
          Sort By
        </div>

        <ul>
          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              Default
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              Average rating
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
              Newness
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              Price: Low to High
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              Price: High to Low
            </a>
          </li>
        </ul>
      </div>

      <div class="filter-col2 p-r-15 p-b-27">
        <div class="mtext-102 cl2 p-b-15">
          Price
        </div>

        <ul>
          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04 filter-link-active">
              All
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              $0.00 - $50.00
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              $50.00 - $100.00
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              $100.00 - $150.00
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              $150.00 - $200.00
            </a>
          </li>

          <li class="p-b-6">
            <a href="#" class="filter-link stext-106 trans-04">
              $200.00+
            </a>
          </li>

        </ul>
        --}}

      </div>

      <div class="filter-col8 p-b-27">
        <div class="mtext-102 cl2 p-b-15">
          {{__('views.shop.shop_category')}}

        </div>
        <div class="flex-w p-t-4 m-r--5">
          @foreach($categories as $category)
          <a href="{{route('categories.products',$category->slug)}}" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5" >
            {{$category->name}}
          </a>
        @endforeach

        </div>
      </div>
    </div>
  </div>
</div>
