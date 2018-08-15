<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">

  <style media="screen">
  .top-bar {
       background-color: #222;
      background-color:#717fe0;
      padding:5% 5%;
   }
  </style>
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>
    <div class="top-bar">
      <h2 class="text-center" style="color:white;">
    BEHİCESGLM</h2>
  </div>

    <div class="container mt-5">
      <p>Kargonuz yola çıkmıştır. Kargo numaranız aşağıda yer almaktadır. Siteye geri dönmek için aşağıda bulunan linke tıklayabilirisniz.</p>
      <p><a href="{{route('shop.index')}}">https://behicesglm.com</a> </p>
      <p>Kargo numaranız : {{$shipping_number}}</p>
      <h5>Kargo Bilgileri</h5>
      <p>Ülke : {{$adress->country}} </p>
      <p>Şehir : {{$adress->city}} </p>
      <p>Adres : {{$adress->adress}} </p>
      <p>İyi Günler</p>
    </div>
</div>
  </body>
</html>
