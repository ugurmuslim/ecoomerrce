<a href="#myModal-{{$i}}" data-toggle="modal" class="barcode-button btn btn-sm btn-primary">Barkod</a>
<div class="modal fade form-spacing-top" style="padding-top:100px;" id="myModal-{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <h5 class="modal-title" id="exampleModalLabel"></h5>
      <div class="modal-body text-center">
        @php
        $barcode = $product->product_id.$size->attribute_human_id.$color->attribute_human_id;
        @endphp
        <div class="barcode barcode-desc form-spacing-top">
          <strong>
            {!!DNS1D::getBarcodeSVG($barcode, "EAN13")!!}<br>
            <p>
              {{ $barcode }}
              <span class="barcode-name">{{ $product->name}}</span>
            </p>
            <p class="barcode-category"><strong>{{$product->category->name}}</strong></p>
            <p>
              <span class="price_show"> Fiyat: {{$product->price}} TL</span>
            </p>
          </strong>
          <p><button  onClick="window.print()" class="btn btn-default non-print mt-5">Yazdır</button></p>
        </div>
      </div>
    </div>
  </div>
</div>
