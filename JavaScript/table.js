
var active = 0;


var tableOffset = $("#mydata").offset().top;
var $header = $("#mydata > thead").clone();
var $fixedHeader = $("#header-fixed").append($header);

$(window).bind("scroll", function() {
  var offset = $(this).scrollTop();

  if (offset >= tableOffset && $fixedHeader.is(":hidden")) {
    $fixedHeader.show();
  }
  else if (offset < tableOffset) {
    $fixedHeader.hide();
  }
});

function getData(e) {
  e.preventDefault();
}
$(document).ready(function() {

  //Table Generator
  $('#mydata').dataTable(
    {
      //"order": [[ 0, "asc" ]],
      //"sScrollX": "100%",
      "order": [],
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
      "iDisplayLength": 200,
      select: {
        style:    'os',
        selector: 'td:first-child'
      },
      keys: {
        columns: ':not(:first-child)',
        keys: [ 9 ]
      },
      //"scrollY":        "200px",
      //        "scrollCollapse": true,
      //        "paging":         false
    }
  );
  var rs = $('#mydata tr').length;
  var cos = $('#mydata tr:eq(0) td').length;
  var a = 0;
  // Outside click action
  $(document).mouseup(function()
  {
    $(".editbox").hide();
    $(".text").show();
  });

  $('.editbox').keydown(function(event) {

    if (event.keyCode == 37) { //move left or wrap
      a = active -1;
      if(a%20 >= 3 && a%20 <= 18)
      {
        active = active -1;
        $('.active').removeClass('active');
        $('#mydata tr td').eq(active).addClass('active').trigger( "focus" );
      }
    }
    if (event.keyCode == 38) { // move up
      a = active -20;
      if(a%20 >= 3 && a%20 <= 18)
      {
        active = active -20;
        $('.active').removeClass('active');
        $('#mydata tr td').eq(active).addClass('active').trigger( "focus" );
      }
    }

    if (event.keyCode == 39) { // move right or wrap
      a = active +1;
      if(a%20 >= 3 && a%20 <= 18)
      {
        active = active + 1;
        $('.active').removeClass('active');
        $('#mydata tr td').eq(active).addClass('active').trigger( "focus" );
      }
    }
    if (event.keyCode == 40) { // move down
      a = active +20;
      if(a%20 >= 3 && a%20 <= 18 && a < (rs-3)*20)
      {
        active = active + 20;
        $('.active').removeClass('active');
        $('#mydata tr td').eq(active).addClass('active').trigger( "focus" );
        //document.getElementById("debugs").value = rs;
      }
    }

    if (event.keyCode == 13) {

      $(".editbox").hide();
      $(".text").show();
      var x = document.getElementById("mes").value;
      var arr = x.split("|");
      var data= document.getElementById("e"+arr[0]+"+"+arr[1]).value;//$("#e"+x).val();
      if(data ==0) data =0;
      if(data >24) data = "***";
      var dataString = 'data=' + arr[2] + "|" + arr[1] + "|" + data;

      $.ajax({
        type: "POST",
        url: "Database/EditHour.php",
        data: dataString,
        cache: false,
        success: function(html)
        {
          var a = document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML;
          var b = data;
          var ldata = document.getElementById("l"+arr[0]).innerHTML;
          var ld = parseFloat(ldata);
          var bdata = document.getElementById("b"+arr[1]).innerHTML;
          var ttotal = document.getElementById("att").innerHTML;
          var tt = parseFloat(ttotal);
          var bd =0;
          if(bdata>0)
          {
            bd = parseFloat(bdata);
          }
          document.getElementById("l"+arr[0]).innerHTML = ld+(b-a);
          bd = bd+(b-a);
          bd = bd.toFixed(1);
          document.getElementById("b"+arr[1]).innerHTML = bd;
          document.getElementById("att").innerHTML = tt+(b-a);
          var shows = data;
          if(shows == 0)
          {
            document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML = data;
            document.getElementById("s"+arr[0]+"+"+arr[1]).style.display = 'none';
          }
          else
          {
            document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML = data;
          }
        }
      });
    }
  });

  $(".editbox").mouseup(function()
  {
    return false
  });

  var table = $('#mydata').DataTable();
  //var table = $('#mydata').DataTable();
  //table.cell( 1 ).on('focus');
  $('#mydata tbody').on( 'focus' , 'td', function (event) {
    active = $(this).closest('table').find('td').index(this);
    //document.getElementById("debugs").value = active;
    var xpos = table.row( this ).index();
    $(".editbox").hide();
    $(".text").show();
    if(table.column( this ).index() > 2)
    {
      var ypos = table.column( this ).index() - 2;
      var x = xpos + "+" + ypos;
      var tmpdata = document.getElementById("e"+x).value;
      if(document.getElementById("e"+x).value==0)
      {
        document.getElementById("e"+x).value = null;
      }
      var e = document.getElementById("cid"+xpos).value;
      var arr1 = e.split("|");
      document.getElementById("mes").value = xpos+"|"+ypos+"|"+arr1[0];
      if(document.getElementById("s"+x))
      {
        document.getElementById("s"+x).style.display = 'none';
        document.getElementById("e"+x).style.display = 'block';
        document.getElementById("e"+x).focus();
      }
    }
  }).change(function(event)
  {

    var x = document.getElementById("mes").value;
    var arr = x.split("|");
    var data= document.getElementById("e"+arr[0]+"+"+arr[1]).value;//$("#e"+x).val();
    if(data ==0) data =0;
    if(data >24) data = "***";
    var dataString = 'data=' + arr[2] + "|" + arr[1] + "|" + data;
    $.ajax({
      type: "POST",
      url: "Database/EditHour.php",
      data: dataString,
      cache: false,
      success: function(html)
      {
        var a = document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML;
        var b = data;
        var ldata = document.getElementById("l"+arr[0]).innerHTML;
        var ld = parseFloat(ldata);
        var bdata = document.getElementById("b"+arr[1]).innerHTML;
        var bd =0;
        if(bdata>0)
        {
          //document.getElementById("debug").value ="is here";
          bd = parseFloat(bdata);
        }
        var ttotal = document.getElementById("att").innerHTML;
        var tt = parseFloat(ttotal);
        document.getElementById("l"+arr[0]).innerHTML = ld+(b-a);
        bd = bd+(b-a);
        bd = bd.toFixed(1);
        document.getElementById("b"+arr[1]).innerHTML = bd;
        document.getElementById("att").innerHTML = tt+(b-a);
        //document.getElementById("debug").value = ldata;
        var shows = data;
        if(shows == 0)
        {
          document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML = data;
          document.getElementById("s"+arr[0]+"+"+arr[1]).style.display = 'none';
        }
        else
        {
          document.getElementById("s"+arr[0]+"+"+arr[1]).innerHTML = data;
        }
      }
    });

  });
});
