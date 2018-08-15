<script type="text/javascript">
var select_city = $('#city');
$.ajax({
  dataType:'json',
  type:'get',
  url:'{{asset('modules/account/js/cities_of_turkey.json')}}',
  data:'',
  success: function(cities) {
    $.each(cities,function(i,city) {
      var $city_name = city.name;
      select_city.append('<option value="' +$city_name + '">' +  $city_name +' </option>')
    });
  }
});

$('#account_name').on('change',function() {
  var $account_id = $(this).val();
  $.ajax({
    dataType:'json',
    type:'get',
    url:'{{url('api/adresses')}}' + '/' + $account_id,
    data:'',
    success: function(adress) {
      $('#account_name_change').val(adress.account_name);
      $('#name').val(adress.first_name);
      $('#lastname').val(adress.last_name);
      $('#adress').html(adress.adress);
      $("#city option[value=" + adress.city + "]").attr('selected', 'selected');
      $('#id_number').val(adress.id_number);
      $('#phone').val(adress.phone_number);
      $('#zip_code').val(adress.zip_code);
    }
      });
  });
</script>
