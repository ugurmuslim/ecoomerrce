<div class="flex-w flex-l-m filter-tope-group m-tb-10">
  <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
    Hepsi
  </button>
  @foreach($categories->take(4) as $category)
  <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{$category->name}}">
    {{$category->name}}
  </button>
@endforeach
</div>
