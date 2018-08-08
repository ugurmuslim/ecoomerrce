@extends('admin.layouts.admin')
@section('title', __('views.admin.users.product.show'))

@section('content')
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="well text-center">
        <h1><strong>{{$product->name}}</strong></h1>
        <h4>Ürün Kodu: {{ $product->product_id }}</h4>
        <h4>Ürün Kategorisi: {{ $product->category->name}}</h4>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <a href="{{route('products.edit',$product->slug)}}" class="btn btn-sm btn-primary">Değiştir</a>
            <a href="{{route('stockentry.add',$product->slug)}}" class="btn btn-sm btn-primary">Stok Gir</a>
            <a href="{{route('stockentry.edit',$product->slug)}}" class="btn btn-sm btn-primary">Stok Düzeltme</a>
            @if($product->deleted !== 1)
              {!! Form::open(['route'=>['products.destroy',$product->slug],'method'=>'DELETE']) !!}
              {!! Form::submit('Sil',['class'=>'btn btn-danger btn-sm mt-3']) !!}
              {!! Form::close() !!}
            @else
              {!! Form::open(['route'=>['products.resurrect',$product->slug]]) !!}
              {!! Form::submit('Silmeyi Geri Al',['class'=>'btn btn-danger btn-sm mt-3']) !!}
              {!! Form::close() !!}
            @endif


          </div>

        </div>
      </div>
    </div>
  </div>
  @php
  $size_old_ids = array();
  $total_stock = 0;
  $i = 0;
@endphp
@if($product->images()->first())
  <div class="row">
    <div class="col-md-12">
      @foreach($product->images as $image)
        <div class="col-md-3">
          <div class="col-md-5">
            <img src="{{asset('images/products/' . $image->name)}}" style="width:150px; height: 205px;"alt="">
          </div>
          <div class="col-md-3">
            <a href="{{route('images.delete',['filename'=>$image->name,'foldername'=>'products'])}}" class="btn btn-danger">Sil</a>
            @if($image->main == true)
            <a href="{{route('images.main',['filename'=>$image->name,'product_id'=>$product->id])}}" class="btn btn-success">Ana Fotoğraf</a>
          @else
            <a href="{{route('images.main',['filename'=>$image->name,'product_id'=>$product->id])}}" class="btn btn-danger">Ana Fotoğraf</a>
          @endif
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endif

<div class="row form-spacing-top">
  <div class="col-md-12">

    <form method="post" action="{{route('images.imageupload')}}" enctype="multipart/form-data"
    class="dropzone" id="dropzone">
    {{ csrf_field() }}
    <input type="file" name="file" />
    <input type="number" name="product" value="{{$product->id}}" hidden />
    <input type="number" name="type" value="1" hidden />
    <input type="text" name="foldername" class="foldername" value="products" hidden />
  </form>
</div>
</div>


<div class="row form-spacing-top">
  <div class="row">
    @foreach($product->sizes as $size)
      @if(!in_array($size->id,$size_old_ids))
        <div class="col-md-3">
          <h3><strong>{{$size->attribute_long}}</strong></h3>

          <table class="table">
            <thead>
              <tr>
                <th>Renk</th>
                <th>Miktar</th>
                <th>Barkod</th>
              </tr>
            </thead>
            <tbody>
              @foreach($product->colors()->where('size_id',$size->id)->get() as $color)
                <tr>
                  <td>{{$color->attribute_long}}</td>
                  <td>{{$color->pivot->stock}}</td>
                  <td>@include('partials._modal_print')</td>
                </tr>
                @php
                  $i++
                @endphp
              @endforeach
              <tbody>
              </table>
            </div>
          @endif
          @php
            array_push($size_old_ids,$size->id);
          @endphp
        @endforeach

      </div>

      <div class="well text-center mt-3">
        <h2><strong>Toplam Stok : {{$product->sizes()->sum('stock')}}</strong></h2>

      </div>

      <div class="row">
        <div class="col-md-4">
          <h1><strong>Alış Bilgileri</strong></h1>
          @if(count($product->sizes2()->get())>0)
            <h4>En son Giriş Fiyatı : {{$product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->entry_price}} TL</h4>
            <h4>En son Giriş Tarihi : {{Carbon\Carbon::parse($product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->created_at)->format('d/m/Y - H:i')}}</h4>
            <h4>En son Giriş Miktarı : {{$product_latest_quantity}} {{$product->unit->name}}</h4>
          @else
            <h4>Giriş Yapılmamış</h4>
          @endif
        </div>

        <div class="col-md-4">
          <h1><strong>Satış Bilgileri</strong></h1>
          <h4>En Son Satış Fiyatı : {{$product->price}} TL</h4>
          @if(count($product->sales()->get())>0)
            <h4>En Son Satış Tarihi : {{(Carbon\Carbon::parse($product->sales()->orderBy('pivot_created_at','desc')->first()->pivot->created_at)->format('d/m/Y - H:i'))}}</h4>
            <h4>En Son Satış Miktarı : {{$product->sales()->orderBy('pivot_created_at','desc')->first()->pivot->sale_quantity}} {{$product->unit->name}}</h4>
          @else
            <h4>Satış Yapılmamış</h4>
          @endif
        </div>

        <div class="col-md-4">
          <h1><strong>Kar/Zarar</strong></h1>
          @if(count($product->sizes2()->get())>0)
            <h4>Satış - Alış (TL) : {{$product->price - $product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->entry_price }} TL </h4>
            <h4>Yüzde : %{{($product->price - $product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->entry_price)/$product->sizes2()->orderBy('id','desc')->first()->pivot->entry_price*100 }} </h4>
          @else
            <h4>İşlem Yapılmadığı için Bilgi bulunmamaktadır.</h4>
          @endif
        </div>
        {{--
        </div>
        <div class="row mt-5">
          <div class="col-md-8 col-md-offset-2">
            <div class="well text-center">
              <h1><strong>TARİHLER ARASI HESAP</strong></h1>
              {!!Form::date('datefirst', \Carbon\Carbon::now(),['class'=>'datefirst']) !!}
              {!!Form::date('datelast', \Carbon\Carbon::now(),['class'=>'datelast ml-3']) !!}
              <button type="button" name="button" class="btn btn-success btn-sm calculate ml-3">Hesapla</button>
              <p class="slide_panels mt-5">
              </p>
            </div>
          </div>
        </div>
        --}}
      </div>
      <div class="row mt-5">
        <div class="col-md-6 border_right">
          <button type="button" name="button" class="btn btn-success mt-5">Topla Giriş Miktarı : {{$product->sizes2()->sum('quantity')}} {{$product->unit->name}}</button><br>
          <button type="button" name="button" class="btn btn-success mt-5">Topla Giriş Miktarı : {{$product->sizes2()->sum('entry_price')}} <span class="simge-tl" >&#8378;</span> </button>

          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Beden</th>
                <th>Giriş Miktar</th>
                <th>Birim Fiyat</th>
                <th>Toplam Fiyat</th>
                <th>Tarih</th>

              </tr>
            </thead>

            <tbody>
              @foreach($product->sizes2 as $size)
                <tr>
                  <th>{{Modules\Stock\Entities\Stockmovementtype::find($size->pivot->stock_movement_type_id)->name}}</th>
                  <th>{{$size->attribute_long}}</th>
                  <th id = "get_quan">{{ $size->pivot->quantity }}</th>
                  <td>{{ $size->pivot->entry_price }} TL</td>
                  <td id = "get_price">{{ $size->pivot->entry_price*$size->pivot->quantity }} TL</td>
                  <td>{{ Carbon\Carbon::parse($size->pivot->created_at)->format('d/m/Y') }} </td>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>


      <div class="col-md-6">
        <button type="button" name="button" class="btn btn-success">Toplam Ciro : {{$product->sales()->sum('sale_quantity')}} {{$product->unit->name}} </button><br>
        <button type="button" name="button" class="btn btn-success">Toplam Ciro : {{$product->sales()->sum('sale_price')}} <span class="simge-tl" >&#8378;</span> </button>

        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Beden</th>
              <th>Satış Miktar</th>
              <th>Birim Fiyat</th>
              <th>Toplam Fiyat</th>
              <th>Tarih</th>

            </tr>
          </thead>

          <tbody>
            @foreach($product->sales as $sale)
              <tr>
                <th>{{ $sale->name}}</th>
                <th>{{ Modules\Attribute\Entities\Attribute::find($sale->pivot->size_id)->attribute_long}}</th>
                <th id="sold_quan">{{ $sale->pivot->sale_quantity}}</th>
                <td>{{ $sale->pivot->sale_price }}</td>
                <td id="sold_price">{{ $sale->pivot->sale_price }}</td>
                <td>{{ Carbon\Carbon::parse($sale->pivot->created_at)->format('d/m/Y') }} </td>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@section('admin_scripts')
  {{ Html::script(mix('assets/admin/js/dropzone.js')) }}
  <script type="text/javascript">

    Dropzone.options.dropzone =
    {
      maxFilesize: 12,
      renameFile: function(file) {
        var dt = new Date();
        var time = dt.getTime();
        return time+file.name;
      },
      acceptedFiles: ".jpeg,.jpg,.png,.gif",
      timeout: 50000,
      addRemoveLinks: true,
      removedfile: function(file)
      {
        var name = file.upload.filename;
        var foldername = $('.foldername').val();
        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          },
          type: 'GET',
          url: '{{ url("image/delete") }}' + '/' + name + '/' + foldername,
          success: function (data){
            console.log("File has been successfully removed!!");
          },
          error: function(e) {
            console.log(e);
          }});
          var fileRef;
          return (fileRef = file.previewElement) != null ?
          fileRef.parentNode.removeChild(file.previewElement) : void 0;
        },

        success: function(file, response)
        {
          console.log(response);
        },
        error: function(file, response)
        {
          return false;
        }
      };
    </script>
  @endsection
