@extends('admin.layouts.admin')
@section('title', __('views.admin.attribute.create'))
@section('content')
  @section('stylesheets')
    {!! Html::style('css/parsley.css') !!}
  @endsection
  @section('title','ÜRÜN TANIMLAMA |')

  @section('content')

    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        {!! Form::open(['route'=>['attributes.store'],'data-parsley-validate' => '' ]) !!}

        {{ Form::label('attribute_id','Tür:',['class'=>'form-spacing-top']) }}

        <select class="form-control" style="height:40px;" name="attribute_id">
          @foreach($attributes as $attribute)
            <option value= "{{ $attribute->id }}">{{ $attribute->name }}</option>
            @endforeach
          </select>

          {{ Form::label('attribute_short','Kısa Tanım:',['class'=>'form-spacing-top']) }}
          {{ Form::text('attribute_short',null,['class'=>'form-control name','required' => ''])}}

          {{ Form::label('attribute_long','Uzun Tanım:',['class'=>'form-spacing-top']) }}
          {{ Form::text('attribute_long',null,['class'=>'form-control name','required' => ''])}}

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
