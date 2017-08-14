<thead>
  <tr>
    <th style='padding:0; margin:0;' width = '6%' rowspan="2">TIME<BR>SHEET<BR>Job No.</th>
      <th style='padding:0; margin:0 position: fixed;;'colspan="1" width="33%">Time Period:<br><?php echo $timecard->generate_date(); ?></th>
      <th style='padding:0; margin:0 position: fixed;;'colspan="1" width="4%"></th>
      <th style='padding:0; margin:0'colspan="6" width="20%">Employee:<br> <?php echo $name;?> </th>
      <th style='padding:0; margin:0'colspan="5" width="17%"><center><br><?php echo $timecard->get_month(); ?></center></th>
        <th style='padding:0; margin:0'colspan="5" width="16%"></th>
        <th style='padding:0; margin:0'width="3%"> </th>
      </tr>
      <tr>
        <th style='padding:0; margin:0;' ><center>Project</center> </th>
        <th style='padding:0; margin:0;' >Work<br>Code</th>
        <?php
        $tmp = $timecard->get_days();  $index = $tmp[0];  $days  = $tmp[1];  $dayn  = $tmp[2];
        while ($index <= $days)
        {
          if($index > $dayn)
          {
            echo "<th style='padding:0; margin:0;' width='50px'><br></th>";
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
    </thead>
