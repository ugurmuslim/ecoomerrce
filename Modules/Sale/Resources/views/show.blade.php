@extends('admin.layouts.admin')
@section('title', __('views.admin.users.product.show'))
@section('content')

  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well text-center">
        <h1><strong>Satış No : {{$sale_package[0]->sale_package}}</strong></h1>
        @if($adress)
        <h3><strong>Müşteri İsmi : {{$adress->first_name . $adress->last_name}}</strong></h3>
        <h3><strong>Email : {{$adress->email}}</strong></h3>
        <h3><strong>Şehir : {{$adress->city}}</strong></h3>
        <p>{{$adress->adress}}</p>
      @endif
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            @if($sale_package[0]->statu == 1)
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 2])}}" class="btn btn-sm btn-primary">Kargoya Ver</a>
            @else
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 1])}}" class="btn btn-sm btn-danger">Kargoyu Geri Al</a>
            @endif
            <a href="#myModal" data-toggle="modal" class="btn btn-sm btn-danger">Kargo Maili Gönder</a>
                  <div class="modal fade form-spacing-top" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <div class="modal-body text-center">
                          <h4> Kargo Nosunu Girin.</h4>
                          <div class="form-spacing-top">
                            {!! Form::open(['route'=>['sales.deliveryMail',$adress]]) !!}

                            {{ Form::label('shipping_number','Kargo No :',['class'=>'form-spacing-top']) }}
                            {{ Form::text('shipping_number',null,['class'=>'form-control name','required' => ''])}}

                            {!! Form::submit('Gönder',['class'=>'btn btn-danger btn-sm mt-3']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

            @if($sale_package[0]->statu == 3)
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 2])}}" class="btn btn-sm btn-danger">Tammamlamayı Geri Al</a>
            @else
              <a href="{{route('sales.delivery',['sale_package'=>$sale_package[0]->sale_package,'statu' => 3])}}" class="btn btn-sm btn-success">Tammamla</a>
            @endif
          </div>
        </div>
      </div>
      <table class="table">
        <thead>
          <th>Ürün Kodu</th>
          <th>Ürün</th>
          <th>Beden</th>
          <th>Renk</th>
          <th>Miktar</th>
          <th>Birim Fiyat</th>
          <th>Tutar</th>
        </thead>
        <tbody>
          @foreach($sale_package as $sale)
            <tr>
              <td>{{$sale->product_human_id}}</td>
              <td>{{$sale->product_name}}</td>
              <td>{{$sale->size->attribute_long}}</td>
              <td>{{$sale->color->attribute_long}}</td>
              <td>{{$sale->sale_quantity}}</td>
              <td>{{$sale->product->price}}</td>
              <td>{{$sale->sale_price}}</td>
              <td></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
@section('admin_scripts')
@endsection
