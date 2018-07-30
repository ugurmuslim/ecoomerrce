<script >
$(function(){
  $('.sale-details-button').on('click',function(){
    if(!$('.slide-panels').hasClass('slided-down')) {
      $('.slide-panels').slideDown();
      $('.slide-panels').addClass('slided-down')
    }
    else {
      $('.slide-panels').slideUp();
      $('.slide-panels').removeClass('slided-down')
    }
  })
});
  </script>
