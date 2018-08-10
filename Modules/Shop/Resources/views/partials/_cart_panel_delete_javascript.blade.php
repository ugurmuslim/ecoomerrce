<script type="text/javascript">

$('.header-cart-item-img').on('click',function() {
  var $row_id = $(this).find('img').attr('data-id');
  $.ajax({
    dataType:'json',
    url: '{{url('cart/remove')}}' + '/' + $row_id,
    type: 'get',
    dataType: 'JSON',
    success: function(response) {
      window.location.replace('{{route('shop.checkout')}}');
    }
  });
  });
</script>
