<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <meta charset="utf-8">
    <title></title>
  </head>

  <body>
    <div class="text-center" style="background-color:#717fe0; padding:5% 5%">
      <h2 style="color:white;">
    BEHİCESGLM</h2>
    </div>

    <div class="container mt-5">
      <p>Müşteri Sipariş Verdi.</p>
      <p><a href="{{route('shop.index')}}">https://behicesglm.com</a> </p>
      <p>Sipariş Numarası : {{$product_sale[0]->sale_package}}</p>
      <p>Müşteri Adı : {{$adress->first_name . ' ' . $adress->first_name}}</p>
      </div>
      <table class="table">
        <thead>
          <tr>
            <th>Kod</th>
            <th>İsim</th>
            <th>Beden</th>
            <th>Renk</th>
            <th>Adet</th>
            <th>Tutar</th>
          </tr>
        </thead>
        <tbody>
          @foreach($product_sale as $sale)
          <tr>
            <td>{{$sale->product_human_id}}</td>
            <td>{{$sale->product_name}}</td>
            <td>{{ $sale->size->attribute_long }}</td>
            <td>{{ $sale->color->attribute_long }}</td>
            <td>{{ $sale->sale_quantity }}</td>
            <td>{{ $sale->sale_price }}</td>
            <td></td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <h5>Kargo Bilgileri</h5>
      <p>Ülke : {{$adress->country}} </p>
      <p>Şehir : {{$adress->city}} </p>
      <p>Adres : {{$adress->adress}} </p>
      <p>İyi Günler</p>
    </div>
  </body>
</html>
