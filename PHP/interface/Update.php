<div id="update" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <center>
        <h3>"Update Button Will Update All The Project Name From Current Database!"</h3>
        <br><br>
        <form method='post' >
          <input  type='submit' name ='upds' value = 'Confirm'>
        </form>
        <form method='post' id = 'updf1'>
          <input type='hidden' name ='upds' value = 'Confirm'>
        </form>
      </center>
    </div>
</div>

<?php
$spcodes = array("CMU","HOL",
"MSC","OFF",
"PSL","SIC",
"SMT","VAC");
if(strcasecmp($_POST[upds],'Confirm')==0)
{
  //What is need to do is updating the project name from the database.
  //after that, All the project name will be on the timesheet..
  //If the time car still not in the timecard.
  //Will be displaying the error message to tell the user of that.
  $sql = "SELECT * FROM time.timecol where period = '$periods' and user = '$user';";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc())
  {
    //echo "<h1>$row[jn]</h1>";
    if(!in_array($row[jn],$spcodes))
    {
      //Do something about it, when it happen, it will be happening
      $sqlc = "SELECT * FROM tc.job_name where jn = '$row[jn]'";
      $results = $conn->query($sqlc);
      $rows = $results->fetch_assoc();
      if(!empty($rows))
      {
          $des = $rows[job_name_1].$rows[job_name_2];
          $des = str_replace("'", "\'", $des);
          $sqlup = "UPDATE time.timecol SET project = '$des' WHERE ID = '$row[id]'";
          $conn->query($sqlup);
      }
      else
      {
        echo "<h1 style='color:red'>$row[jn] DOES NOT EXIST IN DATABASE </h1>";
      }
    }
  }

}
?>
