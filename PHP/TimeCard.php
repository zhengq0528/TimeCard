
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <title>TimeCard System </title>
  <script src="../js/jquery.min.js"></script>
  <script src="../js/jquery.js"></script>

  <script src="../PDFLib/jspdf.js"></script>
  <script src="../PDFLib/plugins/jspdf.minx.js"></script>
  <script src="../PDFLib/plugins/jspdf.plugin.autotable.js"></script>
  <script src="../PDFLib/plugins/autoprint.js"></script>

  <script src="PDF.js?v=4" type="text/javascript"></script>

  <script src="../js/jquery-1.12.4.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <script src="../js/jquery.dataTables.min1.js"></script>
  <script src="../js/dataTables.bootstrap.min.js"></script>
  <script src="../js/dataTables.fixedHeader.min.js"></script>
  <!-- <script src="../js/jquery.dataTables.min.js"></script>-->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/dataTables.bootstrap.min.css" rel="stylesheet">

  <!-- This is the seperate line of libraries uses -->
  <link href="../Style/style.css?v=2" rel="stylesheet">
</head>
<?php
error_reporting(0);
$Is_Focus = 0;
$Job_Focus =0;
$todaye = date('d');
if($todaye >=16) $todaye -=15;
include('Database/db.php');
include('period.php');
//include('GetNamePeriod.php');
$periods = $_GET[p];
$user    = strtoupper($_GET[init]);
include('interface/Update.php');
echo "<br><br><h1 id = 'errs' style='color:red'></h1>";
include('hours.php');
include('interface/SpecialCode.php');
include('interface/Addjob.php');
include('interface/Edit.php');
include('interface/Delete.php');
include('interface/TurnIn.php');
include('interface/UnTurnIn.php');
include('HandleCall.php');
include('Handlejob.php');
$datatable = array();
$sql = "SELECT * FROM time.timecol where period = '$periods' and user = '$user';";
$result = $conn->query($sql);
$index = 0;
while($row = $result->fetch_assoc())
{
  $datatable[$index]=$row;
  $index++;
}
$daytotal = array();
for($ind = 1; $ind <= 16 ; $ind++)
{
  $daytotal[$ind] = 0;
}

$name    = $_GET[n];
//This is calculation base on giving information
$month   = $periods[2].$periods[3];
$year    = "20".$periods[0].$periods[1];
//Get Which period of month are going to be used.
//----------------------------------------------//
$timecard = new period($_GET[init],$periods);
$weekends = $timecard->get_weekend();
$REG = 0;
$OT = 0;
$VAC = 0;
$SandP = 0;
//echo $timecard->generate_date();

?>

<FORM id= 'form1' method = 'post'>
  <input type='hidden' value = 'q1' name = 'f1'>
</FORM>
<FORM id= 'form2' method = 'post'>
</FORM>
<FORM id= 'form3' method = 'post'>
  <input type ='hidden' name = 'p1' value = 'hey'>
</FORM>
<FORM id= 'form4' method = 'post'>
  <input type ='hidden' name = 'sub1' value = 'sub1'>
</FORM>
<script>
function refresh(){
  document.getElementById('form2').submit();
}
</script>

<body>
  <div class="box" style = 'position:fixed;top:-5px;'>
    <button class = "button" type="button" onclick="refresh()"> Refresh Page </button>
    <button id ='addjb'  class = "button" type="button"> Add Job# </button>
    <button id ='addsc'  class = "button" type="button"> Add Spl Code </button>
    <button id ='tcedit' class = "button" type="button"> Edit </button>
    <button id ='tcdel'  class = "button" type="button"> Delete </button>
    <br>
    <button id ='upjn'   class = "button" type="button"> Update </button>
    <input class = "button" type="button" onclick="submitp1()" value="Print"/>
    <button class = "button" type="button" id ='ti'> Turn In </button>
    <button  class = "button" type="button" id ='ut'> Un-Turn In </button>
    <button class = "button" type="button" onclick="location.href='../../intranet/jnsearch.html'">Exit</button>
  </div>

  <table id="header-fixed"></table>


  <div id='printarea'  >
    <br>
    <table border='0.5' class =' table-hover table-striped'
    width = "100%"
    color = "black"
    cellspacing="0.5"
    cellpadding="0.5"
    style ='table-layout:fixed; border: 0.5px solid black;'
    id = 'mydata'>
    <?php include('TableHead.php');?>
    <tbody >
      <?php
      for($index = 0 ; $index < count($datatable); $index++)
      {
        echo "<tr style='padding:0; margin:0;'>";
        echo "<td style='padding:0; margin:0;'>";
        echo $datatable[$index][jn];
        echo "</td>";
        echo "<td style='padding:0; margin:0;'>";
        echo $datatable[$index][project];
        echo "</td>";
        echo "<td style='padding:0; margin:0;'>";
        echo $datatable[$index][code];
        echo "</td>";
        $ltotal = 0;
        for($o=1 ; $o <=16 ; $o++)
        {
          $tp = $timecard->get_phase();
          if($tp==1)
          {
            $t = $o;
          }
          else if($tp==2)
          {
            $t = $o + 15;
          }
          if($t <= $dayn)
          {
            if(strcmp($datatable[$index][code],"VAC")==0)
            {
              $VAC += $datatable[$index]["d".$o];
            }
            else if(strcmp($datatable[$index][code],"SIC")==0 ||strcmp($datatable[$index][code],"PSL")==0)
            {
              $SandP += $datatable[$index]["d".$o];
            }
            else
            {
              $REG += $datatable[$index]["d".$o];
            }
            $e_pos = "e$index+$o";
            $s_pos = "s$index+$o";
            $tdsi = intval($todaye);
            //$tdsi = 2;
            if($datatable[$index]['id']==$Job_Focus && $tdsi == $o)
            {
              //echo "today is her a aa a $todaye";
              echo "<input type='hidden' id = 'exxxx' value = 'e$index+$tdsi'>";
              echo "<input type='hidden' id = 'sxxxx' value = 's$index+$tdsi'>";
            }
            if(in_array($t,$weekends))
            {
              echo "<td tabindex='0' style='padding:0; margin:0; background-color:#CFCFCF;'><center>";
              if($datatable[$index]["d".$o] ==0)
              {
                echo "<span  id=$s_pos class='text'></span>";
              }
              else
              {
                echo "<span  id=$s_pos class='text'>".number_format($datatable[$index]["d".$o],1)."</span>";
              }

              echo "<input type='text'  onkeypress='return event.charCode >= 0 && event.charCode <= 64' class = 'editbox' id=$e_pos value='".number_format($datatable[$index]["d".$o],1)."' >";
              echo  "</center></td>";
            }
            else
            {
              echo "<td tabindex='0' style='padding:0; margin:0;'><center>";
              if($datatable[$index]["d".$o] ==0)
              {
                echo "<span  id=$s_pos class='text'></span>";
              }
              else
              {
                echo "<span  id=$s_pos class='text'>".number_format($datatable[$index]["d".$o],1)."</span>";
              }

              echo "<input type='text'
              onkeypress='return event.charCode >= 0 && event.charCode <= 64'
              class = 'editbox'
              id=$e_pos
              value='".number_format($datatable[$index]["d".$o],1)."' >";
              echo  "</center></td>";
            }
            $ltotal += $datatable[$index]["d".$o];
            $daytotal[$o] += $datatable[$index]["d".$o];
          }
          else
          {
            echo "<td id = 'last'></td>";
          }
        }
        $lf = "l".$index;
        if($ltotal == 0)
        {
          echo "<input type='hidden' id = 'checkdd' value ='3'>";
        }
        echo "<td id = $lf style='padding:0; margin:0;'>".number_format($ltotal,1)."</td>";
        $data = $datatable[$index][id]."|".$datatable[$index][jn]."|".$datatable[$index][project]."|".$datatable[$index][code];
        echo "<input type='hidden' id = 'cid$index' value = '".$data."'>";
        echo "</tr>";
      }
      ?>
    </tbody>
    <?php include('TableFoot.php');?>
  </table>
  <!-- Trying to organize the table and the cell, trying to do it-->
  Dickerson Engineering Inc.
  <table border="1" id = 'mydata2'>
    <thead>
      <tr style='padding:1; margin:1;'>
        <td style='width:50px';><center> REG </td>
          <td style='width:50px';><center> OT </td>
            <td style='width:50px';><center> VAC </td>
              <td style='width:50px';><center> S&P </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id = 'reg'><center><?php
                $r = $REG + $VAC + $SandP;
                $OTs = $OT * 8;
                $rz = 0;
                if($r > $OTs)
                {
                  $dif = $r - $OTs;
                  $rz = $REG-$dif;
                }
                else
                {
                  $rz = $REG;
                }
                echo $rz ;
                ?></center></td>
                <td id = 'ot'><center><?php
                $r = $REG + $VAC + $SandP;
                $OTs = $OT * 8;
                if($r > $OTs)
                {
                  $dif = $r - $OTs;
                  echo $dif;
                  $OTs = $dif;
                }
                else
                {
                  $OTs = 0;
                  echo "0";
                }
                ?></center></td>
                <td id = 'vac'><center><?php echo $VAC;?></center></td>
                <td id = 'sp'><center><?php echo $SandP;?></center></td>
              </tr>
            </tbody>
          </table>

          <p align='right' media ='print' style='position:relative; right:10px;bottom:30px;font-size:16px;'>
            Signature:____________________________________________________</p>
          </div>
          <h1 id = 'yo'> </h1>
        </body>

        <table id = 'quanz' border='1' style='visibility:hidden;'>
          <tr>
            <td>Job No.</th>
            <?php
            $psd = $timecard->generate_date();
            echo "<input type='hidden' id='tperiod' value = '$psd'>";
            echo "<input type='hidden' id='tname' value = '$name'>";
            ?>
            <th><center> Project </center> </th>
            <th>Work<br>Code</th>
            <?php
            $tmp = $timecard->get_days();  $index = $tmp[0];  $days  = $tmp[1];  $dayn  = $tmp[2];
            while ($index <= $days)
            {
              if($index > $dayn)
              {
                echo "<th style='padding:0; margin:0;' width='50px'></th>";
              }
              else
              {
                if(in_array($index,$weekends))
                {
                  $styles = "background-color:#d8d8d8;";
                }
                else
                {
                  $OT++;
                  $styles = "";
                }
                $tdd = date('l',mktime(0,0,0,$month,$index,$year));
                $tmpd = substr(date('l',mktime(0,0,0,$month,$index,$year)),0,3);
                echo "<th width='40' style='font-size:10px'><center>$tmpd<br>$index</center></th>";
              }
              $index++;
            }
            ?>
            <th style='padding:0; margin:0' width='40'>Total</th>
          </tr>
          <tbody>
          <?php
          $tcols = count($datatable);
          echo "<input type='hidden' id = 'tcol' value = '$tcols'>";
          $limit = 40;
          if($tcols == 41 ||$tcols == 42 ||$tcols == 43)
          {
            $tcols = 82;
          }
          else
          {
            while(1)
            {
              if($tcols <= $limit)
              {
                $tcols = $limit;
                break;
              }
              else
              {
                $limit +=43;
              }
            }
          }

          //34

          for($index = 0 ; $index < $tcols; $index++)
          {
            $ltotal = 0;
            echo "<tr style='padding:0; margin:0;'>";
            echo "<td style='padding:0; margin:0;'>";
            echo $datatable[$index][jn];
            echo "</td>";
            echo "<td style='padding:0; margin:0;'>";
            echo $datatable[$index][project];
            echo "</td>";
            echo "<td style='padding:0; margin:0;'>";
            echo $datatable[$index][code];
            echo "</td>";
            for($o=1 ; $o <=16 ; $o++)
            {
              if($datatable[$index]["d".$o]==0)
              {
                echo "<td> </td>";
              }
              else
              echo "<td>".$datatable[$index]["d".$o]."</td>";
              $ltotal +=$datatable[$index]["d".$o];
            }
            if($ltotal !=0)
            echo "<td>".number_format($ltotal,1)."</td>";
            else echo "<td></td>";
            echo "</tr>";
          }
          ?>
        </tbody>
          <tfoot>
          <tr>
            <td> </td>
            <td> </td>
            <td>TOTAL</td>
            <?php
            $index = 0;
            $tds = 0;
            while ($index < 16)
            {
              $tds +=$daytotal[$index];
              $index++;
              if($daytotal[$index]>0)
              {
                echo "<td>";
                echo number_format($daytotal[$index],1);
                echo "</td>";
              }
              else
              {
                echo "<td> </td>";
              }

            }
            $tds +=$daytotal[16];
            ?>
            <td><?php echo $tds; ?></td>
          </tr>
      </tfoot>
    </table>
        <input type='hidden' id = 'text1'>
        <input type='hidden' id = 'mes'>
        <script src="../JavaScript/table.js?v=3" type="text/javascript"></script>
        <script src="../JavaScript/script.js?v=4" type="text/javascript"></script>

        <?php
        if(strcmp($_POST[sub1],'sub1')==0)
        {
          ?>
          <script>turnin();</script>
          <?php
        }

        if($Is_Focus==1)
        {?>
          <script>
          var epos = document.getElementById("exxxx").value;
          var spos = document.getElementById("sxxxx").value;
          document.getElementById(spos).style.display='none';
          document.getElementById(epos).style.display='block';
          window.onload = function() {
            document.getElementById(epos).focus();
          }
          </script>
          <?php
        }?>
        <?php
          if(strcmp($_POST['p1'],'hey')==0)
          {
            ?>
            <script>
              printDiv();
            </script>
            <?php
          }
        include("turnsub.php");
        ?>
