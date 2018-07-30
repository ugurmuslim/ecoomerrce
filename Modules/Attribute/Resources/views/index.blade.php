@extends('admin.layouts.admin')
@section('title', __('views.admin.attribute.report'))
@section('content')
<div class="row">
  <div class="col-md-12">
    <table class="table" id="table">
      <thead>
        <tr>
          <th>Kod</th>
          <th>Tür</th>
          <th>Kısa İsim</th>
          <td>Uzun İsim</td>
        </tr>
      </thead>
      <tbody>
        @php
        $i = 0;
        $attr_old_id = null;
        @endphp
        @foreach($attributes as $attribute)
              <tr>
                <td>{{ $attribute->attribute_human_id }}</td>
                <td>{{ $attribute->attributename->name }}</td>
                <td>{{ $attribute->attribute_short }}</td>
                <td>{{ $attribute->attribute_long  }}</td>
              </tr>
        @endforeach
      </tbody>
    </table>
    {{ $attributes->links() }}
  </div>
</div>
@endsection
