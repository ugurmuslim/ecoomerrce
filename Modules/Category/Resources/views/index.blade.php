@extends('admin.layouts.admin')
@section('title', __('views.admin.categories.index.title'))
@section('content')

  <div class="row">
    <div class="col-md-12">
      <table class="table" id="table">
        <thead>
          <tr>
            <th>İsim</th>
            <th>Alt Sayı</th>
            <th>Üst Sayı</th>
            <th>Beden</th>
            <th>Oluşturan</th>
            <th>Tarih</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>{{ $category->number_low }}</td>
              <td>{{ $category->number_high }}</td>

            </td>

            <td>{{ $category->created_at }}</td>
            <td><div class="row">
              <div class="col-md-4">
                <a href="{{route('categories.show',$category->id)}}" class="btn btn-sm btn-default">Görüntüle</a>
              </div>
              <div class="col-md-4">
                <a href="{{route('categories.edit',$category->id)}}" class="btn btn-sm btn-primary">Değiştir</a>
              </div>
              <div class="row ml-2">
                <a href="#myModal-{{$category->id}}" data-toggle="modal" class="btn btn-sm btn-danger">Sil</a>
                <div class="modal fade form-spacing-top" id="myModal-{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <h5 class="modal-title" id="exampleModalLabel"></h5>
                      <div class="modal-body text-center">
                        <h4> Silmek istediğinize emin misiniz? Bütün bilgiler gidecektir.</h4>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </td>
          </tr>

        @endforeach

      </tbody>
    </table>
    {{ $categories->links() }}

  </div>
@endsection
