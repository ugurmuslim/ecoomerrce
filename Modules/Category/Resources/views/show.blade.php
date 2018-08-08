@extends('admin.layouts.admin')
@section('title', __('views.admin.users.index.title'))

@section('content')
  <div class="row">
      <div class="col-md-8  col-md-offset-2">
      <div class="well text-center">
        <h1><strong>{{$category->name}}</strong></h1>
        <h4>Alt Numara : {{ $category->number_low }}</h4>
        <h4>Üst Numara: {{ $category->number_high}}</h4>
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <a href="#myModal-{{$category->id}}" data-toggle="modal" class="btn btn-sm btn-danger">Sil</a>
                  <div class="modal fade form-spacing-top" id="myModal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <div class="modal-body text-center">
                          <h4> Silmek istediğinize emin misiniz? Bütün bilgiler gidecektir.</h4>
                          <div class="form-spacing-top">
                            {!! Form::open(['route'=>['categories.destroy',$category->slug],'method'=>'DELETE']) !!}
                            {!! Form::submit('Sil',['class'=>'btn btn-danger btn-sm mt-3']) !!}
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

        </div>
      </div>
    </div>
  </div>
@if($category->image)
<div class="row">
  <div class="col-md-12">
      <div class="col-md-2">
        <img src="{{asset('images/categories/' . $category->image->name)}}" style="width:130px;"alt="">
        <a href="{{route('images.delete',['filename'=>$category->image->name,'foldername'=>'categories'])}}" class="btn btn-danger">Sil</a>
      </div>
  </div>
</div>
@endif

<div class="row form-spacing-top">
  <div class="col-md-12">

    <form method="post" action="{{route('images.imageupload')}}" enctype="multipart/form-data"
                      class="dropzone" id="myAwesomeDropzone">
                      {{ csrf_field() }}
                    <input type="file" name="file" />
                    <input type="number" name="product" value="{{$category->id}}" hidden />
                    <input type="number" name="type" value="2" hidden />
                    <input type="text" name="foldername" class="foldername" value="categories" hidden />
    </form>
  </div>
</div>

      {{--  @foreach($product->sizes as $size)
      <div class="col-md-3">
      <h4>{{$size->desc}} : {{$size->pivot->stock}}</h4>
      @php
      $total_stock += $size->pivot->stock;
    @endphp
    @include('partials._modal_print')
  </div>
  @php
  $i++
@endphp
@endforeach

</div>

<div class="row  mt-5">
  <div class="col-md-8 col-md-offset-2 ">

    <form  action="{{route('products.imagestore')}}"  method="post" enctype="multipart/form-data">
      {{ csrf_field()}}
      <div class="form-group">
        <input type="file" name="photos[]" class="from-control" multiple>
        <input type="number" name="product_id" class="from-control" value="{{$product->id}}" hidden>

        <input type="submit" class="btn btn-primary" value="upload">
      </div>
    </form>
  </div>

</div>

<div class="row mt-5">
  <div class="col-md-8 col-md-offset-2">
    <div class="well text-center">
      <h1><strong>Toplam Stok: {{$total_stock}}</strong></h1>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-4">
    <h1><strong>Alış Bilgileri</strong></h1>
    @if(count($product->sizes2()->get())>0)
      <h4>En son Üretim Maliyeti : {{$product->sizes2()->orderBy('pivot_created_at','desc')->first()->pivot->production_price}} TL</h4>
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

<div class="row mt-5 ">
  <div class="col-md-6 border_right">
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
            <th>{{App \Stock_movement_type::find($size->pivot->stock_movement_type_id)->name}}</th>
            <th>{{$size->desc}}</th>
            <th id = "get_quan">{{ $size->pivot->quantity }}</th>
            <td>{{ $size->pivot->entry_price }} TL</td>
            <td id = "get_price">{{ $size->pivot->entry_price*$size->pivot->quantity }} TL</td>
            <td>{{ Carbon\Carbon::parse($size->pivot->created_at)->format('d/m/Y') }} </td>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="get_quan mt-3">
  </div>
  <div class="get_price mt-3">
  </div>

</div>
<div class="col-md-6">
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
          <th>{{ App\Size::find($sale->pivot->size_id)->name}}</th>
          <th id="sold_quan">{{ $sale->pivot->sale_quantity}}</th>
          <td>{{ $sale->pivot->sale_price }}</td>
          <td id="sold_price">{{ $sale->pivot->sale_price }}</td>
          <td>{{ Carbon\Carbon::parse($sale->pivot->created_at)->format('d/m/Y') }} </td>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>
<div class="sold_quan mt-3">
</div>
<div class="sold_price mt-3">
</div>

</div>
</div>

</div>
--}}
@endsection

@section('admin_scripts')
  <script
  src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
  integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
  crossorigin="anonymous"></script>
  {{ Html::script(mix('assets/admin/js/dropzone.js')) }}
  <script type="text/javascript">
  Dropzone.options.myAwesomeDropzone =
        {
          addRemoveLinks: true,
           maxFilesize: 12,
           renameFile: function(file) {
               var dt = new Date();
               var time = dt.getTime();
              return time+file.name;
           },
           acceptedFiles: ".jpeg,.jpg,.png,.gif",
           timeout: 50000,
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



{{--
  @section('scripts')
    {!! Html::script('js/jquery.imageuploader.js') !!}


    <script type="text/javascript">

      var $slide_panels = $('.slide_panels');

      $('.calculate').on('click',function(){
        var $date_first = $('.datefirst').val();
        var $date_last = $('.datelast').val();
        var $pnumber = {{$product->id}}
        $.ajax({
          dataType:'json',
          type:'get',
          url:'{{url('products/productSaleGet')}}' + '/' + $pnumber + '/'+ $date_first + '/' + $date_last,
          data:'',
          success: function(response) {
            var $sale_quantity_total = response[0];
            var $sale_price_total = response[1];
            $slide_panels.empty().append('<button type="button" name="button" class="btn btn-md btn-success ml-3">' + $sale_quantity_total + ' {{$product->unit->name}}</button>');
            $slide_panels.append('<button type="button" name="button" class="btn btn-md btn-success ml-3">' + $sale_price_total +  ' TL</button>');
          }

        });
      })


      var $get = 0;
      var $get_p = 0;
      var $sold = 0;
      var $sold_p = 0;

      $get_quan = $('.get_quan');
      $get_price = $('.get_price');
      $sold_quan = $('.sold_quan');
      $sold_price = $('.sold_price');
      $('tr #get_quan').each(function()
      {
        $int = parseInt($(this).text());
        $get += $int;
        //I should store id in an array
      });
      $get_quan.append('<button class="btn btn-primary  btn-lg mt-3">Toplam Miktar: ' + $get +' {{$product->unit->name}}</button>')
      $('tr #sold_quan').each(function()
      {
        $int = parseInt($(this).text());
        $sold += $int;
        //I should store id in an array
      });
      $sold_quan.append('<button class="btn btn-primary  btn-lg mt-3">Toplam Miktar: ' + $sold +' {{$product->unit->name}}</button>');
      $('tr #get_price').each(function()
      {
        $int = parseInt($(this).text());
        $get_p += $int;
        //I should store id in an array
      });
      $get_price.append('<button class="btn btn-primary  btn-lg mt-3">Toplam Bedel: ' + $get_p +' TL </button>')
      $('tr #sold_price').each(function()
      {
        $int = parseInt($(this).text());
        $sold_p += $int;
        //I should store id in an array
      });
      $sold_price.append('<button class="btn btn-primary  btn-lg mt-3">Toplam Kazanç: ' + $sold_p +' TL</button>');
      $("body").before($(".modal"));
      $('.barcode-button').on('click',function(){
        var $barcode_font_size = $('#barcode-font').val();
        console.log($barcode_font_size);
        $('.barcode-desc').css("font-size",$barcode_font_size + 'px');

        $('#price').on('click',function(){
          $('#price_show').toggle();
        })
      });
    </script>
  @endsection
  --}}
