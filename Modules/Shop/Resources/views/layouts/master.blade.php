<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') BEHİCESGLM</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @include('shop::partials._shopping_head')
  @yield('shop_styles')


</head>
<body>
  @yield('content')

  @yield('shop_scripts')
  @include('shop::partials._cart_panel_delete_javascript')
  {{-- Laravel Mix - JS File --}}
  {{-- <script src="{{ mix('js/shop.js') }}"></script> --}}
</body>
</html>
