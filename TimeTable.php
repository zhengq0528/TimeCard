<?php
include('db.php');
include('SpecialCode.php');
 echo date('m'); echo date('j'); echo date('Y');
 $type;
 if(date('j')<=15) $type = 1;
 else $type = 2;
 $tperiod;
 $m = date('m');
 $y = date('y');
 $dayn = cal_days_in_month(CAL_GREGORIAN,$m,$y);
 if($type == 1) $tperiod = $m."/1/".$y." To ". $m."/15/".$y;
 else $tperiod = $m."/15/".$y." To ". $m."/$dayn/".$y;
 ?>
<p id = "test"> hello</p>
<button id ="b"> hey</button>
<button id ='myBtn'> Add Special Code </button>

<!DOCTYPE html>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/dataTables.bootstrap.min.css" rel="stylesheet">

<link href="style.css?v=3" rel="stylesheet">
<script src="script.js?v=3" type="text/javascript"></script>
<script src="keyscript.js?v=15" type="text/javascript"></script>

<form method='post' action = "index.php">
  <input type ="Submit" value = "Go Back!">


  <div class='container'>
  <table border="0" class ="table table-bordered table-hover"  id = "mydata">
  <thead>
    <tr>
      <th style='padding:0; margin:0;' rowspan="2" width="5%">TIME<BR>SHEET<BR>Job No.</th>
      <th style='padding:0; margin:0;'colspan="2" width="36%">Time Period:<br><?php echo $tperiod; ?></th>
      <th style='padding:0; margin:0;'colspan="6" width="18%">Employee:<br> <?php echo "$_GET[inti]"?> </th>
      <th style='padding:0; margin:0;'colspan="5" width="18%"><br><?php echo date('M')." ".date('Y') ?></th>
      <th style='padding:0; margin:0;'colspan="5" width="18%"></th>
      <th width="5%"> TOTAL </th>
    </tr>
    <tr>
       <th style='padding:0; margin:0;' width="32%"> <center>Project</center> </th>
       <th style='padding:0; margin:0;' width="2%">Work<br>Code</th>
       <?php

       $month = 4; $year = 2017;
       $dayn = cal_days_in_month(CAL_GREGORIAN,$month,$year);
       $index = 15; $days = 31;
       $today = 12;
       $weekends = array();
       while ($index < $days)
       {
         $index++;
         if($index > $dayn)
         {
           echo "<th style='padding:0; margin:0;'> <br> </th>";
         }
         else
         {

         $tdd = date('l',mktime(0,0,0,$month,$index,$year));
         if(strcmp($tdd, "Sunday")==0 || strcmp($tdd,"Saturday")==0)
         {
           $weekends[]=$index;
         }
           echo "<th style='padding:0; margin:0;'>".substr(date('l',mktime(0,0,0,$month,$index,$year)),0,3).
           "<br><center>$index</center></th>";
         }
       }
       ?>
       <th style='padding:0; margin:0;'> TOTAL</th>
    </tr>
  </thead>

  <tbody>
  <?php
  $sql = "SELECT * FROM time.timecol WHERE user = '$_GET[inti]'";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    echo "<tr style='overflow: hidden;height:5px; font-size:16px; padding:0; margin:0;'>";
    echo "<td style='padding:0; margin:0;'>$row[jn]</td> ";

    echo "<td style='padding:0; margin:0;'>$row[project]</td>";
    echo "<td style='padding:0; margin:0;'>$row[code]</td>";
    $index = 1;
    while ($index <= 16)
    {
      $styles = null;



      $id = $row['id'];
      $sid = "ss_$id"."_"."$index";
      $tid = "dd_$id"."_"."$index";
      if(in_array(($index+15),$weekends))
      {
       $styles = "background-color:gray;";
       $sid = 999;
       $tid = 999;
      }
      echo "<td style='padding:0; margin:0; $styles' tabindex='0' id=$id class = '$id'><center>";
      echo "<span style='text-transform:uppercase;padding:0; margin:0;' id=$sid class='text'>$value</span>";
      echo "<input style='text-transform:uppercase;padding:0; margin:0;' type='text' class = 'editbox' id=$tid value='$value' >";
      echo  "</td>";
      $index++;
    }
    echo "<td style='padding:0; margin:0;'>$row[id]</td>";
    echo "</tr>";
  }

  ?>

  </tbody>
  <tfood>
    <tr>
      <th colspan="3">TOTAL</th>
      <?php
      $index = 0;
      while ($index < 16)
      {
        $index++;
        echo "<th> 0 </th>";
      }
       ?>
       <th>total</th>
    </tr>
  </tfood>
</table>
</div>
<?php echo "<input id ='note' type = 'text' value = 'hey'>";?>
