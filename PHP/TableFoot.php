<tfood>
  <tr style='padding:0; margin:0;'>
    <th style='padding:0; margin:0;' colspan="3">TOTAL</th>
    <?php
    $index = 0;
    $tds = 0;
    while ($index < 16)
    {
      $tds +=$daytotal[$index];
      $index++;
      if($daytotal[$index]>0)
      {
        echo "<th style='padding:0; margin:0;'><center> ";
        //.number_format($daytotal[$index],1)."
        echo "<p style='padding:0; margin:0;' id = 'b$index'>".number_format($daytotal[$index],1)."</p>";
        echo "</center></th>";
      }
      else
      {
        echo "<th style='padding:0; margin:0;'><center><p style='padding:0; margin:0;' id = 'b$index'></p></center></th>";
      }
      if($daytotal[$index] > 12 && $daytotal[$index] <=24)
      {
        $state = 0;
        if($periods[4]==2) $state = $index + 15;
        if($periods[4]==1) $state = $index;
        $weekdays = substr(date('l',mktime(0,0,0,$month,$state,$year)),0,3) . " - Day:$state";
        //echo $weekdays;
        ?>
        <input type='hidden' id ='dd' value ='<?php echo $weekdays;?>'>
        <input type='hidden' id = 'checkdd' value ='1'>
        <?php
      }
      else if($daytotal[$index] > 24)
      {

        $state = 0;
        if($periods[4]==2) $state = $index + 15;
        if($periods[4]==1) $state = $index;
        //$weekdays = substr(date('l',mktime(0,0,0,$month,$state,$year)),0,3);
        $weekdays = substr(date('l',mktime(0,0,0,$month,$state,$year)),0,3) . " - Day:$state";
        //echo $weekdays;
        ?>
        <input type='hidden' id = 'checkdd' value ='2'>
        <input type='hidden' id ='dd' value ='<?php echo $weekdays;?>'>
        <?php
      }
    }
    $tds += $daytotal[16];
    ?>
    <th style='padding:0; margin:0;'><center><p style='padding:0; margin:0;' id = 'att'><?php echo $tds; ?></p></center></th>
  </tr>
</tfood>
