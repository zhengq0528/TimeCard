<table id = 'quanz' border='1'>
  <tr>
    <td>Job No.</th>
    <th><center>Name:<?php echo $name; echo " | Period:"; echo $timecard->generate_date();  ?>
      <br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp Project</center> </th>
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
    ?>
    <td><?php echo $tds; ?></td>
  </tr>
</tfoot>
</table>
