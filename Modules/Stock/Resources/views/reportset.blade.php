@extends('admin.layouts.admin')
@section('title', __('views.admin.product.create.title'))
@section('content')

  <div class="row">
    <div class="col-md-12">
      {!! Form::open(['route'=>['stocks.report']]) !!}
      <div class="btn-group" data-toggle="buttons">
        <label class="btn btn-primary active">
          <input type="radio" name="options" id="option1" autocomplete="off" checked value="D" > Günlük
        </label>
        <label class="btn btn-primary" style="margin-left:15px;">
          <input type="radio" name="options" id="option2"  autocomplete="off" value="W"> 7 Günlük
        </label>
        <label class="btn btn-primary"style="margin-left:15px;">
          <input type="radio" name="options" id="option3"  autocomplete="off" value="M"> Son 30 gün
        </label>
      </div>
      <div class="form-spacing-top">
        <input type="checkbox" name="" id="formanual">
        {!!Form::date('datefirst', \Carbon\Carbon::now(),['class'=>'manual ml-3', 'disabled']) !!}
        {!!Form::date('datelast', \Carbon\Carbon::now(),['class'=>'manual ml-3','disabled']) !!}
      </div>

      {{Form::submit('Satış Raporu',['class' => 'btn btn-success  form-spacing-top']) }}
      {{Form::close() }}
    </div>
  </div>
@endsection
@section('admin_scripts')
  <script type="text/javascript">
  $(function(){
    var $manual = $('.manual');
    $('#formanual').on('click',function(){
      if($manual.attr('disabled')) {
        $('.manual').removeAttr('disabled');
      }
      else {
        console.log('sd');
        $('.manual').attr('disabled','');
      }
    });
  });
</script>
@endsection
</script>
