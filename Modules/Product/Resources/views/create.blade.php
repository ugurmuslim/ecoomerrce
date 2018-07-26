@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))


@section('content')

  @section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
  @endsection
  @section('title','ÜRÜN TANIMLAMA |')

  @section('content')

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <h1><strong>Ürün Tanımlama</strong></h1>

        {!! Form::open(['route'=>['products.store'],'data-parsley-validate' => '' ]) !!}

        {{ Form::label('name','Ürün İsmi:',['class'=>'form-spacing-top']) }}
        {{ Form::text('name',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('details','Açıklama',['class'=>'form-spacing-top']) }}
        {{ Form::textarea('details',null,['class'=>'form-control name','required' => ''])}}

        {{ Form::label('category_id','Kategori İsmi:',['class'=>'form-spacing-top']) }}
        <select class="form-control" style="height:40px;" name="category_id">
          @foreach($categories as $category)
            <option value='{{ $category->id }}'@if(old('category_id') == $category->id) selected @endif>{{ $category->name }}</option>
          @endforeach

        </select>

        {{ Form::label('price','Satış Fiyatı:',['class'=>'form-spacing-top']) }}
        {{ Form::number('price',null,['class'=>'form-control','step'=>'any','required' => '','data-parsley-type' => 'number'])}}

        {{ Form::label('unit_id','Birim:',['class'=>'form-spacing-top']) }}
        <select class="form-control" style="height:40px;" name="unit_id">
          @foreach($units as $unit)
            <option value='{{ $unit->id }}'>{{ $unit->name }}</option>
          @endforeach
        </select>


        <div class="row mt-5">
          <div class="col-md-12">
            <input type="checkbox" name="size_track" class="size_track" value="1"  checked="checked">&nbspÜrünler Bedenle mi Takip Ediliyor?</input>
          </div>
        </div>

        <input type="checkbox" name="variation" class="product_variation mt-5" value="1">&nbspÜrün Varyasyonlu mu?</input>

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
    @parent
    {{ Html::script(mix('assets/common/js/parsley.min.js')) }}
    <script type="text/javascript">
      $('.size_track').on('click',function(){
        console.log('asd')
      })
    </script>
  @endsection
