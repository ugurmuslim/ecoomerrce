@extends('admin.layouts.admin')
@section('title', __('views.admin.sale.create.title'))
@section('content')
  <div class="error_message">
  </div>
  <div class="row">
    <div class="col-md-8 border_right">
      <div class="row">
        <div class="col-md-3">
          {{ Form::label('pnumber','Ürün Numarası:',['class'=>' form-spacing-top']) }}
          {{ Form::text('pnumber',null,['class'=>'pnumber form-control large-input-general large-input-dateils', 'autofocus'])}}
        </div>
        <div class="col-md-3 ">
          {{ Form::label('quantity','Miktar:',['class'=>' form-spacing-top']) }}
          {{ Form::number('quantity',null,['class'=>'quantity form-control large-input-general large-input-dateils'])}}
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <button type="button" class="btn btn-primary large-input-general sale-buttons"  name="button" id="non-barcode-panel-button">Barkodsuz Ürün</button>
        </div>
        <div class="col-md-4 slide-panels">
          {{ Form::label('non-barcode-name','Barkodu olmayan Ürün İsim:(TL)',['class'=>' form-spacing-top']) }}
          {{ Form::text('non-barcode-name',null,['class'=>'non_barcode_name form-control large-input'])}}
        </div>
        <div class="col-md-5  slide-panels">
          {{ Form::label('non_barcode_price','Barkodu olmayan Ürün Fiyat:(TL)',['class'=>' form-spacing-top']) }}
          {{ Form::text('non_barcode_price',null,['class'=>'non_barcode_price form-control large-input '])}}
        </div>
      </div>
      {!! Form::open(['route'=>['sales.store']]) !!}
      <div class="row mt-5">
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Kod</th>
              <th>Beden</th>
              <th>Renk</th>
              <th>İsim</th>
              <th>Fiyat</th>
              <th>Adet</th>
              <th>Tutar</th>
              <th><button type="button" name="button" class="btn btn-sm  btn-danger" id="remove-table" >Temizle</button></th>
            </tr>
          </thead>
          <tbody class="table_rows">
            <tr class="table_row_addons discount " id="discount_row"></tr>
            <tr class="table_row_addons charge" id="charge_row"  ></tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="raw-total">
        <button class="btn btn-primary large-input-general mt-3">Toplam Bedel: 0 TL</button>
      </div>
      <div class="row mt-5">
        @foreach($payments as $payment)
          <div class="col-md-6  ">
            <span class="mt-3 big-radio-text"><input type="radio" name="payment" class="payment" id="{{$payment->id}}" value="{{$payment->id}}"> {{$payment->name}}</span>
          </div>
        @endforeach

      </div>
      <div class="row">
        <div class="col-md-6">
          {{ Form::label('charge','Komisyon(TL):',['class'=>' form-spacing-top ml-3']) }}
          {{ Form::number('charge',0,['class'=>'form-control charge_fee large-input-general  ml-3', 'step'=>'any','onkeypress' =>'return event.keyCode != 13'])}}
        </div>
        <div class="col-md-6">
          {{ Form::label('discount','İndirim(TL):',['class'=>' form-spacing-top']) }}
          {{ Form::number('discount',0,['class'=>'form-control discount large-input-general','step'=>'any','onkeypress' =>'return event.keyCode != 13'])}}
        </div>
      </div>
      <div class="row ">
        <div class="col-md-6 ml-3">
          {{ Form::label('middleman','Aracı Kurum :',['class'=>'form-spacing-top ']) }}
          <select class="form-control select2 middleman_options" style="height:30%;" name="middleman_id">
          </select>
        </div>
      </div>
{{--      <div class="row">
        <div class="col-md-6 ml-3">
          {{ Form::label('customer','Müşteri :',['class'=>'form-spacing-top ']) }}
          <select class="form-control select2 customer_options" style="height:30%;" name="customer_id">
            <option value=''></option>
            @foreach($customers as $customer)
              <option value='{{$customer->id}}'>{{$customer->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="row ">
        <div class="col-md-6 ml-3">
          {{ Form::label('seller','Sorumlu',['class'=>'form-spacing-top ']) }}
          <select class="form-control select2 " style="height:30%;" name="seller">
            <option value='{{Auth::user()->id}}' selected>{{Auth::user()->name}}</option>
            @foreach($users as $user)
              <option value='{{$user->id}}'>{{$user->name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      --}}

      <div class="row">
        <div class="col-md-6 ml-3">
          {{ Form::label('created_date','İşlem Tarihi',['class'=>'form-spacing-top']) }}
          <select class="form-control select2" style="height:30%;" name="created_date">
            <option value='{{Carbon\Carbon::today()->toDateString()}}'>{{Carbon\Carbon::today()->toDateString()}}</option>
            <option value='{{Carbon\Carbon::tomorrow()->toDateString()}}'>{{Carbon\Carbon::tomorrow()->toDateString()}}</option>
          </select>
        </div>
      </div>
      <input type="text" name="sale_id" value="1" hidden>

      <div class="row">
        <div class="col-md-6">
          {{Form::submit('Kaydet',['class' => 'btn btn-success  btn-block large-input-general form-spacing-top']) }}
          {{Form::close() }}
        </div>
      </div>

      </div>
    </div>
  @endsection
  @section('admin_scripts')
    <script
    src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"
    integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="
    crossorigin="anonymous"></script>

    <script type="text/javascript">
      $(function(){
        $("body").before($(".modal"));
        $('#non-barcode-panel-button').on('click',function(){
          if(!$('.slide-panels').hasClass('slided-down')) {
            $('.slide-panels').toggle("slide", { direction: "left" }, 500);
            $('.slide-panels').addClass('slided-down')
          }
          else {
            $('.slide-panels').toggle("slide", { direction: "left" }, 500);
            $('.slide-panels').removeClass('slided-down')
          }
        });
        $('.inputs').on('keypress', function(e) {
          return e.which !== 13;
        });
        $i = 0;
        $(document).keypress(function(e) {
          if(e.which == 13) {
            $i = $i+1;
            var $pnumber_full = $('.pnumber').val();
            var $pnumber = $('.pnumber').val().slice(0,-4);
            var $color = $('.pnumber').val().slice(-2);
            var $size = $('.pnumber').val().slice(-4,-2);
            var $non_barcode_price= 0;
            $('.pnumber').val('');
            if($('.quantity').val()) {
              var $quan = $('.quantity').val();
            }
            else {
              var $quan = 1;
            }
            if($('.non_barcode_price').val()) {
              $non_barcode_price = $('.non_barcode_price').val();
              if($('.non_barcode_name').val()) {
                var  $non_barcode_name = $('.non_barcode_name').val();
              }
              else {
                var  $non_barcode_name = 'İsim Yok';
              }
              var $product_row = '<tr class="table_row" id=' + $i + '>' +
                '<td "><button type="button" class="close" style = "font-size:30px;  aria-label="Close"><span aria-hidden="true">&times;</span></button></td>' +
                '<td class="product_id col-md-1"><input type="number" name="product_human_id['+$i+']" value =4 readonly></td>' +
                '<td class="product_size col-md-1"><input type="number" style="width:40px;" name="product_size['+$i+']" value ="'+ 99 +'" readonly></input></td>' +
                '<td class="product_size col-md-1"><input type="number" style="width:40px;" name="product_color['+$i+']" value ="'+ 98 +'" readonly></input></td>' +
                '<td class="product_name col-md-1"><input type="text"  name="product_name['+$i+']" value="' +$non_barcode_name + '" readonly></td>' +
                '<td class="product_price col-md-1" ><input id="product_price'+$i+ '" name="product_price['+$i+']" name="product_price['+$i+']" type="number" value="'+ $non_barcode_price +'" readonly></td>' +
                '<td class="item_quantity col-md-1" id=' +$i +'><input id="table_quantity'+$i +'"  style="width:40px;"  name="quantity['+$i+']" type="number" value=1></td>' +
                '<td class="item_price col-md-1" ><button id="item_price'+$i+ '" class="btn btn-success btn-sm" >' +$non_barcode_price+ ' TL</button></td>' +
                '<td class="product_size col-md-1"><input type="text" style="width:100px;" name="product_id['+$i+']" value ="4" hidden ></input></td>' +
                '</tr>'
                $($product_row).prependTo($table_rows)
                $get = 0;
                total();
              }
              console.log($pnumber);
              console.log($size);

              $.ajax({
                dataType:'json',
                type:'get',
                url:'{{url('api/saleTimeGet')}}' + '/' + $pnumber + '/'+ $size + '/'+ $color,
                data:'',
                success: function(response) {
                  var $product = response[0];
                  var $size = response[1];
                  var $color = response[2];
                  console.log($color);
                  var $campaign = {id: 0, name: "Kampanya Yok"};
                  if(response[2]) {
                    var $campaign = response[2];
                  }
                  doSomething($product,$size,$campaign,$color);
                }
              });
              function doSomething($product,$size,$campaign,$color) {
                $a = '<td class="product_price col-md-1" id=' +$i +' ><input id="product_price'+$i+ '" name="product_price['+$i+']" name="product_price['+$i+']" type="number" value="'+ $product.price +'" readonly></td>';

                var $product_row = '<tr class="table_row" id=' + $i + '>' +
                  '<td><button type="button" class="close" style = "font-size:30px;" aria-label="Close"><span aria-hidden="true">&times;</span></button></td>' +
                  '<td class="product_id col-md-1" ><input type="number" name="product_human_id['+$i+']" value ="'+ $product.product_id +'" style="width:75px;" readonly ></td>' +
                  '<td class="product_size col-md-1"><input type="text" style="width:70px;" name="product_size['+$i+']" value ="'+ $size.attribute_long +'" disabled ></input></td>' +
                  '<td class="product_size col-md-1"><input type="text" style="width:70px;" name="product_size['+$i+']" value ="'+ $color.attribute_long +'" disabled ></input></td>' +
                  '<td class="product_name"><input type="text" name="product_name['+$i+']"style="width:200px;" value="' +$product.name +  '" readonly></td>' +
                  $a +
                  '<td class="item_quantity col-md-1" id=' +$i +'><input id="table_quantity'+$i +'"class ="item_quan" style="width:40px;"  name="quantity['+$i+']" type="number" value=' + $quan + '></td>' +
                  '<td class="item_price col-md-1"><button id="item_price'+$i+ '" class="btn btn-success btn-sm" >' + ($quan * $product.price).toFixed(2) + ' TL</button></td>' +
                  '<td class="product_size col-md-1"><input type="text" style="width:100px;" name="product_id['+$i+']" value ="'+ $product.id  +'" hidden ></input></td>' +
                  '<td><input type="text" style="width:100px;" name="product_size['+$i+']" value ="'+ $size.id  +'" hidden ></input></td>' +
                  '<td><input type="text" style="width:100px;" name="product_color['+$i+']" value ="'+ $color.id  +'" hidden ></input></td>' +
                  '</tr>'
                  $($product_row).prependTo($table_rows)
                  $get = 0;
                  total();
                }
                $('.non_barcode_name').val('');
                $('.non_barcode_price').val('');
                $('.quantity').val('');
                $(".pnumber").focus();
              }
            });
            var $charge = $('.charge');
            var $discount = $('.discount');
            var $table_rows = $('.table_rows');
            var $raw_total = $('.raw-total');
            var $middleman_options = $('.middleman_options');
            $get = 0;
            function total(){
              $get = 0;
              $get_quantity = 0;
              $('.table_row, .table_row_addons').each(function() {
                //$a = $quan * $product.price;
                var $row = $(this).closest('tr').find('.item_price').text();
                var $row_quan = $(this).closest('tr').find('.item_quan').val();
                var $row_price = parseFloat($row);
                var $row_quantity = parseInt($row_quan);
                if(!$row_price) {
                  $row_price=0;
                }
                if(!$row_quantity) {
                  $row_quantity = 0;
                }
                $get += $row_price;
                $get_quantity += $row_quantity;
                console.log($get_quantity);
              });
              $raw_total.empty().append('<button class="btn btn-primary mt-3">Toplam Bedel: ' +$get_quantity + ' adet ' + $get.toFixed(2) +' TL</button>')
              $get = 0;
            }
            $(".discount").keyup(function(e){
              $i = $i+1;
              $discount.empty();
              var $disc = $(this).val();
              $discount_value = $disc.replace(/[^\w]+/g, "");
              var $discount_row ='<td><button type="button" class="close" style = "font-size:30px;  aria-label="Close"><span aria-hidden="true">&times;</span></button></td>' +
              '<td class="product_id col-md-1"><input type="number"  name="product_human_id['+$i+']" value ="3" readonly></td>' +
              '<td class="product_size col-md-1"><input type="number" style="width:40px;" name="product_size['+$i+']" value ="99" readonly></input></td>' +
              '<td class="product_name col-md-1"><input type="text"  name="product_name['+$i+']" value="İndirim" readonly></td>' +
              '<td class="product_price col-md-1" ><input id="product_price'+$i+ '" name="product_price['+$i+']" name="product_price['+$i+']" type="number" value="'+(-$discount_value)+'"readonly></td>' +
              '<td class="item_quantity col-md-1" id=' +$i +'><input id="table_quantity'+$i +'" style="width:40px;" name="quantity['+$i+']" type="number" value="1" readonly></td>' +
              '<td class="item_price"><button id="item_price'+$i+ '" class=" btn-danger btn-sm" >'+ (-$discount_value) +' TL</button></td>' +
              '<td><input type="text" style="width:100px;" name="product_id['+$i+']" value ="3" hidden ></input></td>'
              $($discount_row).appendTo($discount);
              total();
            });
            $(".charge_fee").keyup(function(e){
              $i = $i+1;
              $charge.empty();
              var $credit = $(this).val();
              $credit_card_value = $credit.replace(/[^\w]+/g, "");
              var $credit_row ='<td><button type="button" class="close" style = "font-size:30px;  aria-label="Close"><span aria-hidden="true">&times;</span></button></td>' +
              '<td class="product_id col-md-1"><input type="number"  name="product_human_id['+$i+']" value ="2" readonly></td>' +
              '<td class="product_size col-md-1"><input type="number" style="width:40px;" name="product_size['+$i+']" value ="99" readonly></input></td>' +
              '<td class="product_name col-md-1"><input type="text"  name="product_name['+$i+']" value="Komisyon" readonly></td>' +
              '<td class="product_price col-md-1" ><input id="product_price'+$i+ '" name="product_price['+$i+']" name="product_price['+$i+']" type="number" value="'+$credit_card_value+'"readonly></td>' +
              '<td class="item_quantity col-md-1" id=' +$i +'><input id="table_quantity'+$i +'" style="width:40px;" name="quantity['+$i+']" type="number" value="1" readonly></td>' +
              '<td class="item_price"><button id="item_price'+$i+ '" class=" btn-success btn-sm" >' + $credit_card_value +' TL</button></td>' +
              '<td><input type="text" style="width:100px;" name="product_id['+$i+']" value ="2" hidden ></input></td>'
              $($credit_row).appendTo($charge);
              total();
            });
            var $error_message = $('.error_message');
            $($error_message).empty();
            $i = $i+1;
            var $get = 0;
            $(document).on('click','.close', function(){
              $(this).closest('tr').remove();
              $get = 0;
              total();
            })
            $('#remove-table').on('click',function(){
              $('.table_rows tr').html('');
              total();
            })
            $(document).on('click keyup','.item_quantity, .product_price', function(){
              $i = $(this).attr("id");
              console.log($i);

              var $item_quantity = $("#table_quantity" + $i).val();
              var $price = parseInt($item_quantity) * $('#product_price' + $i).val();
              $(this).parents('tbody.table_rows').find('#item_price' + $i).html($price.toFixed(2) +' TL')
            });
            $(document).on('click keyup','.item_quantity, .product_price', function(){
              $get = 0;
              $get_quantity = 0;
              $(this).parents('tbody.table_rows').find('.item_quan').each(function()
              {
                $row_quan = $(this).val();
                var $row_quantity = parseInt($row_quan);
                $get_quantity += $row_quantity;
                //I should store id in an array
              });
              $(this).parents('tbody.table_rows').find('.item_price').each(function()
              {
                $row_price = parseFloat($(this).text());
                $get += $row_price;
                //I should store id in an array
              });
              $raw_total.empty().append('<button class="btn btn-primary  btn-md mt-3">Toplam Bedel: ' + $get_quantity + ' adet ' + $get.toFixed(2) +' TL</button>')
            });
            $(document).on("keypress", ".item_quantity, .product_price", function(event) {
              return event.keyCode != 13;
            });
            $('.non_barcode_price').val("");
            $('.non_barcode_name').val("");
            $('.payment').on('click',function(){
              $($middleman_options).empty();
              get_payment();

            });

            function get_payment() {
                  var $payment_id = $('.payment').attr('id');
                  var atLeastOneIsChecked = $('.payment:checked').length > 0;
                  console.log(atLeastOneIsChecked.getAttr('id'));
                  var $credit_type_id = $payment_id
                  $.ajax({
                    dataType:'json',
                    type:'get',
                    url:'{{url('customers/customerGet')}}' + '/' + $credit_type_id,
                    data: '',
                    success: function(response) {
                      $.each(response,function(i,$customer) {
                        console.log($customer);
                        $middleman_option = '<option value=' + $customer.id +'>' + $customer.name + ' </option>'
                        $($middleman_options).append($middleman_option)
                      });
                    }
                  });
                }
            $(document).ready(function() {
              $('window').keydown(function(event){
                if(event.keyCode == 13) {
                  event.preventDefault();
                  return false;
                }
              });
            });
          });
        </script>
      @endsection
