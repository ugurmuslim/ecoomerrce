@extends('admin.layouts.admin')
@section('styles')
  {{ Html::style(mix('assets/common/css/select2.min.css')) }}
  @section('title', __('views.admin.product.create.title'))
  @section('content')
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        {!! Form::open(['route'=>['products.store'],'data-parsley-validate' => '' ]) !!}

        {{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
        {{ Form::text('name',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('details','Açıklama',['class'=>'form-spacing-top']) }}
        {{ Form::textarea('details',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('category_id','Kategori İsmi:',['class'=>'form-spacing-top']) }}
        <select class="form-control select2" style="height:40px;" name="category_id">
          @foreach($categories as $category)
            <option value='{{ $category->id }}'@if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
            @endforeach

          </select>

          {{ Form::label('price','Satış Fiyatı:',['class'=>'form-spacing-top']) }}
          {{ Form::number('price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

          {{ Form::label('unit_id','Birim:',['class'=>'form-spacing-top']) }}
          <select class="form-control select2" style="height:40px;" name="unit_id">
            @foreach($units as $unit)
              <option value='{{ $unit->id }}'>{{ $unit->name }}</option>
            @endforeach
          </select>

          <table class="table form-spacing-top">
            <thead>
              <tr>
                <th>Beden</th>
                <th>Renk</th>
                <th>Miktar</th>
              </tr>
            </thead>
            <tbody class="table_rows">
              <td class="product_size"><input type="text" name="product_size_id['+$size_val+']" value ="Beden Yok" readonly></td>
              <td class="product_size"><input type="text" name="product_color_id['+$size_val+']" value ="Renk Yok" readonly></td>
              <td class="product_color"><input type="text" name="product_quantity['+$size_val+']" style="width:40px;" value ="0"readonly></input></td>
              <td class="product_size"><input type="text" name="stock_attributes[2][1]" value = "0" hidden>

            </tbody>
          </table>

          {{--
          <div class="row mt-5 sizes">

          <div class="col-md-12">

          <input type="checkbox" name="size_price" class="size_price" id="checkbox" value="1"  checked=""> Her bir Bedenin Fiyatı Aynı mı?</input>
        </div>
      </div>
      --}}

      {{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
      {{Form::close() }}
    </div>
  </div>

@endsection
@section('scripts')
  {{ Html::script(mix('assets/common/js/select2.min.js')) }}
  @parent
  <script type="text/javascript">
    $('.select2').select2();
    $('.size_track').on('click',function(){
      console.log('asd')
    })
  </script>
@endsection
