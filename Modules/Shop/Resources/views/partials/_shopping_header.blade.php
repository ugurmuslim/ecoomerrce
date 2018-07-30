<header class="header-v4">
  <!-- Header desktop -->
  <div class="container-menu-desktop">
    <!-- Topbar -->
    <div class="top-bar">
      <div class="content-topbar flex-sb-m h-full container">
        <div class="left-top-bar">
          {{__('views.shop.free_shipping')}}
        </div>

        <div class="right-top-bar flex-w h-full">
          @if (Route::has('login'))
            @if (!Auth::check())
              @if(config('auth.users.registration'))
                <a href="{{ url('/register') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.register') }}</a>
              @endif
              <a href="{{ url('/login') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.login') }}</a>
            @else
              @if(auth()->user()->hasRole('administrator'))
                <a href="{{ url('/admin') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.admin.dashboard.title') }}</a>
              @endif
              <a href="{{ url('/logout') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.logout') }}</a>
              <a href="#" class="flex-c-m trans-04 p-lr-25">

                {{Auth::user()->name}}
              </a>

            @endif
          @endif
        </div>
      </div>
    </div>

    <div class="wrap-menu-desktop how-shadow1">
      <nav class="limiter-menu-desktop container">

        <!-- Logo desktop -->
        <a href="{{route('shop.index')}}" class="logo">
          <h5><strong>BEHİCE SGLM</strong></h5>
        </a>

        <!-- Menu desktop -->
        <div class="menu-desktop">
          <ul class="main-menu">
            <li>
              <a href="{{route('shop.index')}}">{{__('views.shop.menu_home')}}</a>
              <ul class="sub-menu">
                <li><a href="{{route('shop.index')}}">Anasayfa</a></li>

              </ul>
            </li>

            <li>
              <a href="#">{{__('views.shop.menu_contact')}}</a>
            </li>
          </ul>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m">
          <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
            <i class="zmdi zmdi-search"></i>
          </div>

          <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="{{Cart::count()}}">
            <i class="zmdi zmdi-shopping-cart"></i>
          </div>

          {{--  <a href="#" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
          <i class="zmdi zmdi-favorite-outline"></i>
        </a>--}}
      </div>
    </nav>
  </div>
</div>

<!-- Header Mobile -->
<div class="wrap-header-mobile">
  <!-- Logo moblie -->
  <div class="logo-mobile">
    <a href="index.html"><h3>BehiceSglm</a>
  </div>

  <!-- Icon header -->
  <div class="wrap-icon-header flex-w flex-r-m m-r-15">
    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
      <i class="zmdi zmdi-search"></i>
    </div>

    <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
      <i class="zmdi zmdi-shopping-cart"></i>
    </div>

    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
      <i class="zmdi zmdi-favorite-outline"></i>
    </a>
  </div>

  <!-- Button show menu -->
  <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
    <span class="hamburger-box">
      <span class="hamburger-inner"></span>
    </span>
  </div>
</div>


<!-- Menu Mobile -->
<div class="menu-mobile">
  <ul class="topbar-mobile">
    <li>
      <div class=" text-center">
        {{__('views.shop.free_shipping')}}

      </div>
    </li>

    <li>
      <div class="right-top-bar flex-w h-full">
        @if (Route::has('login'))
          @if (!Auth::check())
            @if(config('auth.users.registration'))
              <a href="{{ url('/register') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.register') }}</a>
            @endif
            <a href="{{ url('/login') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.login') }}</a>
          @else
            @if(auth()->user()->hasRole('administrator'))
              <a href="{{ url('/admin') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.admin.dashboard.title') }}</a>
            @endif
            <a href="{{ url('/logout') }}" class="flex-c-m trans-04 p-lr-25">{{ __('views.welcome.logout') }}</a>
            <a href="#" class="flex-c-m trans-04 p-lr-25">

              {{Auth::user()->name}}
            </a>

          @endif
        @endif
        </a>

      </div>
    </li>
  </ul>

  <ul class="main-menu-m">
    <li>
      <a href="index.html">Home</a>
      <ul class="sub-menu-m">
        <li><a href="index.html">Homepage 1</a></li>

      </ul>
      <span class="arrow-main-menu-m">
        <i class="fa fa-angle-right" aria-hidden="true"></i>
      </span>
    </li>

    <li>
      <a href="product.html">Shop</a>
    </li>

    <li>
      <a href="contact.html">Contact</a>
    </li>
  </ul>
</div>

<!-- Modal Search -->
<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
  <div class="container-search-header">
    <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
      <img src="images/icons/icon-close2.png" alt="CLOSE">
    </button>

    <form action="{{route('products.search')}}" method="GET" class="wrap-search-header flex-w p-l-15">
      <button class="flex-c-m trans-04">
        <i class="zmdi zmdi-search"></i>
      </button>
      <input class="plh3" type="text" name="search" value="{{request()->input('query')}}" placeholder="Search...">
    </form>
  </div>
</div>
</header>
