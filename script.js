
$(document).ready(function() {
  $('#mydata').dataTable(
    {
      "order": [[ 0, "desc" ]],
      "select": true,
      "sDom": "t",
      columnDefs: [
        {targets: 1 ,"orderable": false},      {targets: 2 ,"orderable": false},
        {targets: 3 ,"orderable": false},      {targets: 4 ,"orderable": false},
        {targets: 5 ,"orderable": false},      {targets: 6 ,"orderable": false},
        {targets: 7 ,"orderable": false},      {targets: 8 ,"orderable": false},
        {targets: 9 ,"orderable": false},      {targets: 10 ,"orderable": false},
        {targets: 11 ,"orderable": false},      {targets: 12 ,"orderable": false},
        {targets: 13 ,"orderable": false},      {targets: 14 ,"orderable": false},
        {targets: 15 ,"orderable": false},      {targets: 16 ,"orderable": false},
        {targets: 17 ,"orderable": false},      {targets: 18 ,"orderable": false},
        {targets: 19 ,"orderable": false},
      ],
      "iDisplayLength": 50,
      select: {
        style:    'single',
        selector: 'td:first-child'
      },
    }
  );



  var table = $('#mydata').DataTable();
  $('#mydata tbody').on( 'click', 'tr', function (event) {
    if ( $(this).hasClass('row_selected') ) {
      $(this).removeClass('row_selected');
    }
    else {
      table.$('tr.row_selected').removeClass('row_selected');
      $(this).addClass('row_selected');
    }
    var x = table.row( this ).index();
    document.getElementById("test").innerHTML = x;
  });
});


var modal = document.getElementById('myModal');
var modal1 = document.getElementById('myModal');
var span = document.getElementsByClassName("close")[0];

$('#myBtn').click(function(){
  modal.style.display = "block";
});
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

$('#myBtn1').click(function(){
  modal.style.display = "none";
  var table = $('#mydata').DataTable();
  var codes = {CMU :"CAD MENU ",HOL:"HOLIDAY",
  MSC:"MSIC.",OFF:"OFFICE",
  PSL:"PERSONAL",SIC:"SICK",
  SMT:"STAFF MEETING",VAC:"VACATION"};
  var selected = document.getElementById("sc").value;
  if(selected == "MSC")
  {
    modal1.style.display = "block";
  }
  else
  {
    var i = null;
    for(var o = 33 ; o >= 0 ; o--)
    {
      var tm = table.row(o).data()[0];
      //document.getElementById("note").value = tm.length;
      if(tm.length == 0)
      {
        document.getElementById("note").value = o;
        var data = table.row(o).data();
        var row = $(table.row(o).node());
        data[0] = selected;
        data[1] = codes[selected];
        data[2] = selected;
        table.row(row).data(data).draw();
        break;
      }
    }
  }
});

$('#myBtn2').click(function(){
  modal1.style.display = "none";
  var table = $('#mydata').DataTable();
  var selected = document.getElementById("sc").value;
  var i = null;
  for(var o = 33 ; o >= 0 ; o--)
  {
    var tm = table.row(o).data()[0];
    if(tm.length == 0)
    {
      document.getElementById("note").value = o;
      var data = table.row(o).data();
      var row = $(table.row(o).node());
      data[0] = selected;
      data[1] = document.getElementById("misc").value;
      data[2] = selected;
      table.row(row).data(data).draw();
      break;
    }
  }

});
