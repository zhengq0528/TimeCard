var table = $('#mydata').DataTable();
$('#mydata tbody').on( 'click', 'td', function (event) {
  var xpos = table.row( this ).index() + 1;
  var ypos = table.column( this ).index() - 2;
  var x = xpos + "_" + ypos;
  document.getElementById("note").value = x;
  $("#ss_"+x).hide();
  $("#dd_"+x).show().focus();
}).change(function()
{
  var x = document.getElementById("note").value;
  var uses=$("#dd_"+x).val();
  var dataString = 'id='+ ID +'&rating='+uses;
  //$.ajax({
    //type: "POST",
    //url: "../Functions/edittran.php",
    //data: dataString,
    //cache: false,
    //success: function(html)
    //{
   document.getElementById("ss_"+x).innerHTML = document.getElementById("dd_"+x).value;
    //}
  //});
});
