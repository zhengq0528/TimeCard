
function submitp1(){
  document.getElementById('form3').submit();
}

function printDiv() {
  document.getElementById("quanz").style.visibility = "visible";
  var table, rows, switching, i, x, y, shouldSwitch;
  table = document.getElementById("quanz");
  switching = true;
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    var pl = document.getElementById("tcol").value;
    for (i = 1; i < pl; i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[0];
      y = rows[i + 1].getElementsByTagName("TD")[0];
      //check if the two rows should switch place:
      if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
        //if so, mark as a switch and break the loop:
        shouldSwitch= true;
        break;
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
    }
  }


  var columns = ["ID", "Name", "Country"];
  var rows = [
    [1, "Shaw", "Tanzania"],
    [2, "Nelson", "Kazakhstan"],
    [3, "Garcia", "Madagascar"]
  ];
  var pdf = new jsPDF('landscape','mm',[210,277]);

  var tname = document.getElementById('tname').value;
  var tp = document.getElementById('tperiod').value;
  var text = "NAME: "+tname;
  pdf.text(text, 14, 6);

  var text = "PERIOD: "+tp;
  pdf.text(text, 175, 6);

  var elem = document.getElementById("quanz");
  var res = pdf.autoTableHtmlToJson(elem);
  var totalPagesExp = "{total_pages_count_string}";
  var pageContent = function (data) {
    var str = "Page " + data.pageCount;
    // Total page number plugin only available in jspdf v1.0+
    if (typeof pdf.putTotalPages === 'function') {
      str = str + " of " + totalPagesExp;
    }

    var p = document.getElementById("tcol").value;
    if(p > 34)
    {
      pdf.setFontSize(10);
      pdf.text(str, 10, pdf.internal.pageSize.height - 10);
    }
  }
  pdf.autoTable(res.columns, res.data, {
    addPageContent: pageContent,
    startY: 10,
    tableLineColor: [0,0,0], // number, array (see color section below)
    tableLineWidth: 0.4,
    styles: {halign: 'center',valign: 'middle',cellPadding: 0.5,fontSize: 7.5,
    lineColor: [0, 0, 0],lineWidth: 0.2, textColor: 255},

    columnStyles:{
      lineColor: [0, 0, 0],

      lineWidth: 1,
      1 : {
        columnWidth: 80,
        halign: 'center',
        valign: 'middle',
      },
      3 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      4 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      5 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      6 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      7 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      8 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      9 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      10 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      11 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      12 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      13 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      14 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      15 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      16 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      17 : {
        columnWidth: 8.5,
        halign: 'center'
      },
      18 : {
        columnWidth: 8.5,
        halign: 'center'
      },
    }
  });
  if (typeof pdf.putTotalPages === 'function') {
    pdf.putTotalPages(totalPagesExp);
  }
  var text = "Signature_________________________";
  pdf.text(text, 14, pdf.autoTable.previous.finalY + 13);
  pdf.setFontSize(10);
  var text = "                             Dickerson Engineering Inc.";
  pdf.text(text, 140, pdf.autoTable.previous.finalY + 13);
  var elem = document.getElementById("mydata2");
  var res = pdf.autoTableHtmlToJson(elem);
  pdf.autoTable(res.columns, res.data, {

    startY: pdf.autoTable.previous.finalY+1,
    margin: {left: 220},
    styles: {cellPadding: 0.8,fontSize: 10,},
    columnStyles:{
      0 : {
        columnWidth: 10,
        halign: 'center'
      },
      1 : {
        columnWidth: 10,
        halign: 'center'
      },
      2 : {
        columnWidth: 10,
        halign: 'center'
      },
      3 : {
        columnWidth: 10,
        halign: 'center'
      },
    }
  });

  pdf.autoPrint();
  //pdf.output('dataurl');
  var ins = findGetParameter('init');
  var pes = findGetParameter('p');
  pdf.save(ins+pes);
  document.getElementById("quanz").style.visibility = "hidden";
  return true;
}
function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}
