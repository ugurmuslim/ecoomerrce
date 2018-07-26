@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')

  <div class="container">
    <div class="col-md-12">
      <div class="col-md-4">

{!! Form::model($category,['route' => ['categories.update',$category->id],'data-parsley-validate' => '' ,'method' => 'PUT']) !!}

{{ Form::label('name','İsim:',['class'=>'form-spacing-top']) }}
{{ Form::text('name',null,['class'=>'form-control','required' => ''])}}

{{ Form::label('number_low','Alt Numara',['class'=>'form-spacing-top']) }}
{{ Form::number('number_low',null,['class'=>'form-control','required' => '', 'minlength' => '1', 'maxlength' => '40'])}}

{{ Form::label('number_high','Üst Numara',['class'=>'form-spacing-top']) }}
{{ Form::number('number_high',null,['class'=>'form-control','required' => '', 'minlength' => '1', 'maxlength' => '40'])}}

{{Form::submit('Kaydet',['class' => 'btn btn-success btn-block form-spacing-top']) }}
{{Form::close() }}

      </div>
    </div>
  </div>
  </div>

@endsection
