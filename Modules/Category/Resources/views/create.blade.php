@extends('admin.layouts.admin')
@section('title', __('views.admin.categoies.create.title'))

@section('content')

  <div class="container">
    <div class="row vendor">
      <div class="col-md-8">
        {!! Form::open(array('route' => 'categories.store', 'data-parsley-validate' => '')) !!}

        {{ Form::label('name','İsim',['class'=>'form-spacing-top']) }}
        {{ Form::text('name',null,['class'=>'form-control','required' => '', 'minlength' => '1', 'maxlength' => '40'])}}

        {{ Form::label('number_low','Alt Numara',['class'=>'form-spacing-top']) }}
        {{ Form::number('number_low',null,['class'=>'form-control','required' => '', 'minlength' => '1', 'maxlength' => '40'])}}

        {{ Form::label('number_high','Üst Numara',['class'=>'form-spacing-top']) }}
        {{ Form::number('number_high',null,['class'=>'form-control','required' => '', 'minlength' => '1', 'maxlength' => '40'])}}

    {{--    {{ Form::label('sizes','Tür:',['class'=>'form-spacing-top']) }}
        <select class="form-control select2-multi" style="height:40px;" name="sizes[]" multiple="multiple">
          @foreach($sizes as $size)
            <option value='{{ $size->id }}'>{{ $size->desc }}</option>
          @endforeach
        </select>
--}}
        {{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
        {{Form::close() }}

      </div>

      </div>
@endsection
