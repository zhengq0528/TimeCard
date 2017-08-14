
$('#upjn').click(function(){
  //document.getElementById('update').style.display = "block";
  document.getElementById("updf1").submit();
});
function turnin(){
  if(document.getElementById("checkdd") == null)
  {
    document.getElementById('turn').style.display = "block";
  }
  else
  {
    var s = document.getElementById("checkdd").value;
    if(s == 1)
    {
      var whichday = document.getElementById('dd').value;
      document.getElementById('cast').innerHTML =
      "You Entered More Than 12 Hours On " + whichday;
      document.getElementById('turn1').style.display = "block";
    }
    else if(s == 2)
    {
      var whichday = document.getElementById('dd').value;
      document.getElementById('cast1').innerHTML =
      "You Entered More Than 24 Hours On " + whichday +
      "<br> You Can Not Have More Than 24 Hours Per Day!";
      document.getElementById('turn2').style.display = "block";
    }
    else if(s ==3)
    {
      document.getElementById('turn3').style.display = "block";
    }
  }
}
$('#ti').click(function(){
  document.getElementById('form4').submit();
/*
  if(document.getElementById("checkdd") == null)
  {
    document.getElementById('turn').style.display = "block";
  }
  else
  {
    var s = document.getElementById("checkdd").value;
    if(s == 1)
    {
      var whichday = document.getElementById('dd').value;
      document.getElementById('cast').innerHTML =
      "You Entered More Than 12 Hours On " + whichday;
      document.getElementById('turn1').style.display = "block";
    }
    else if(s == 2)
    {
      var whichday = document.getElementById('dd').value;
      document.getElementById('cast1').innerHTML =
      "You Entered More Than 24 Hours On " + whichday +
      "<br> You Can Not Have More Than 24 Hours Per Day!";
      document.getElementById('turn2').style.display = "block";
    }
    else if(s ==3)
    {
      document.getElementById('turn3').style.display = "block";
    }
  }
  */
});
$('#ut').click(function(){
  document.getElementById('unturn').style.display = "block";
});

var sc1 = document.getElementById('sc1');
var c1 = document.getElementById('c1');
$('#addsc').click(function(){
  sc1.style.display = "block";
});
$('#c1').click(function(){
  sc1.style.display = "none";
});

var jb1 = document.getElementById('jb1');
var c2 = document.getElementById('j1');
$('#addjb').click(function(){
  jb1.style.display = "block";
  document.getElementById('ajt1').focus();
});

$('#j1').click(function(){
  jb1.style.display = "none";
});

window.onclick = function(event) {
  if (event.target == sc1) {
    sc1.style.display = "none";
  }

  if (event.target == jb1) {
    jb1.style.display = "none";
  }
}

var dc = document.getElementById('dc');
$('#tcdel').click(function(){
  var e = document.getElementById("text1").value;
  var y = e.split("|");

  if(e)
  {
    var id = y[0];
    var jn = y[1];
    var des = y[2];
    var txt = "Deleting <br> Job Nubmer : " + jn + " <br> Description : " + des;
    document.getElementById("hey").innerHTML = txt;
    document.getElementById("message").value = e;
    dc.style.display = "block";
  }
  else
  {
    document.getElementById("hey").innerHTML = "NO SELECTION";
    dc.style.display = "block";
  }
});

var spec = ['CMU','HOL',
            'MSC','OFF',
            'PSL','SIC',
            'SMT','VAC'];

$('#tcedit').click(function(){
  var e = document.getElementById("text1").value;
  var y = e.split("|");
  if(e)
  {
    var a = spec.indexOf(y[1]);
    document.getElementById("colid").value = e;
    if(a >= 0)
    {
      if(y[1].localeCompare("OFF")==0 || y[1].localeCompare("MSC")==0)
      {
        document.getElementById("spdes").value = y[2];
        var edit = document.getElementById('edit1');
        edit.style.display = "block";
      }
    }
    else
    {
      document.getElementById("colids").value = e;
      document.getElementById("ejn1").value = y[1];
      document.getElementById("epn1").innerHTML = y[2];
      $(function() {
        var temp=y[3];
        $("#jsc").val(temp);
      });

      var edit = document.getElementById('edit2');
      //document.getElementById("delc").innerHTML = "NO SELECTION";
      edit.style.display = "block";
    }
  }
  else
  {
    var edit = document.getElementById('edit3');
    document.getElementById("e3").innerHTML = "NO SELECTION";
    edit.style.display = "block";
  }

});


$(document).ready(function() {
  var table = $('#mydata').DataTable();
  $('#mydata tbody').on( 'click', 'tr', function (event) {
    if ( $(this).hasClass('row_selected') ) {
      document.getElementById("text1").value = null;
      $(this).removeClass('row_selected');
      document.getElementById("text1").value = null;
    }
    else {
      table.$('tr.row_selected').removeClass('row_selected');
      $(this).addClass('row_selected');
      var x = table.row( this ).index();
      if(x != null)
      {
        var y = document.getElementById("cid"+x).value;
        document.getElementById("text1").value = y;
      }
    }
    if(x == null)
    {
      document.getElementById("text1").value = null;
    }
  });
  var table = $('#mydata').DataTable();
  table.on( 'key-focus', function ( e, datatable, cell ) {
    document.getElementById('yo').value = "Quan is here";
    editor.inline( cell.index() );
  });
});
