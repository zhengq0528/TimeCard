<?php
$code_description= array('CMU'=>"CAD MENU ",'HOL'=>"HOLIDAY",
'MSC'=>"MSIC.",'OFF'=>"OFFICE",
'PSL'=>"PERSONAL",'SIC'=>"SICK",
'SMT'=>"STAFF MEETING",'VAC'=>"VACATION");
$newy = $periods[0].$periods[1];
$newm = $periods[2].$periods[3];
$newd = $periods[4];
//TurnInUpdate.  Updating the turnin format.
function TurnInUpdate($periods,$user)
{
  $spcodes = array("CMU","HOL",
  "MSC","OFF",
  "PSL","SIC",
  "SMT","VAC");
  include("Database/db.php");
  $sql = "SELECT * FROM time.timecol where period = '$periods' and user = '$user';";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc())
  {
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
        $tmp = array(0,$row[jn]);
        return $tmp;
        break;
      }
    }
  }
  return array(1);
}

if(strcasecmp($_POST[unt],'Yes')==0)
{
  if($newd == 2)
  {
    $newd = 1;
  }
  else
  {
    $newd = 2;
    if($newm == 1)
    {
      $newm = '12';
      $newy -=1;
    }
    else
    {
      $newm -=1;
    }
  }

  $db = odbc_connect("job_name","","") or die("Cannot connect to database\n".odbc_errormsg());
  $query = "SELECT * FROM TC_cfg";
  $result = odbc_exec($db,$query);
  $Lastdays = odbc_result($result,"PostedThru");
  $InPost = odbc_result($result,"InPost");
  $odbcy = $Lastdays[2].$Lastdays[3];
  $odbcm = $Lastdays[5].$Lastdays[6];
  $odbcd = $Lastdays[8].$Lastdays[9];
  if($odbcd > 16) $odbcd = 2;
  else $odbcd = 1;

  echo $odbcdate;
  if(strcasecmp($InPost,y)==0)
  {
    if($odbcd == 1)
    {
      $odbcd = 2;
    }
    else
    {
      $odbcd = 1;
      if($odbcm == 12)
      {
        $odbcm = '01';
        $odbcy -=1;
      }
      else
      {
        $odbcm -=1;
      }
    }
  }
  $odbcdate = $odbcy.$odbcm.$odbcd;
  $newm = sprintf("%02d", $newm);
  $newdate = $newy.$newm.$newd;
  if($newdate >= $odbcdate)
  {
    $upsql = "UPDATE time.current set period = '$newdate' WHERE init ='$user'";
    $conn->query($upsql);
    ?>
    <form id = 'unturnin' method='get' action = "GetNamePeriod.php">
      <input type = "hidden" name = "init" value = "<?php echo $user;?>">
    </form>
    <script>
    document.getElementById('unturnin').submit();
    </script>
    <?php
  }
  else
  {
    echo "<h2 style='color:red'>Previews Time Card Already Been Posted!</h2>";
  }

}

if(strcasecmp($_POST[sub1],'sub')==0 && strcasecmp($_POST[t1],'OK')==0)
{

  $selectedvalue = $_POST[sc];
  $descript = $code_description[$selectedvalue];
  //If selected MSC, Required more information
  if(strcasecmp($selectedvalue,'MSC') == 0)
  {
    ?>
    <script>
    var sc2 = document.getElementById('sc2');
    sc2.style.display = "block";
    </script>
    <?php
  }
  else
  {
    $sql = "INSERT INTO time.timecol
    (period,code,jn,project,user)
    VALUES
    ('$periods','$selectedvalue','$selectedvalue','$descript','$user');";
    $conn->query($sql);
    $Is_Focus = 1;
    $Job_Focus = mysqli_insert_id($conn);
    //echo "<h1> id is here $Job_Focus</h1>";
  }
}

if(strcasecmp($_POST[sub2],'sub2')==0 && strcasecmp($_POST[t2],'OKs')==0)
{
  $selectedvalue = $_POST[sd];
  $description = $_POST[misc];
  $description = addslashes($description);
  $sql = "INSERT INTO time.timecol
  (period,code,jn,project,user)
  VALUES
  ('$periods','MSC','MSC','$description','$user');";
  $conn->query($sql);
  $Is_Focus = 1;
  $Job_Focus = mysqli_insert_id($conn);
}

if(strcasecmp($_POST[delc],'OK')==0)
{
  $pieces = explode("|", $_POST[colid]);

  $sql = "SELECT * FROM time.timecol WHERE id = '".$pieces[0]."'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total = 0;
  for($in = 1; $in <=16 ; $in++)
  {
    $key = 'd'.$in;
    $total +=$row[$key];
  }
  if($total == 0)
  {
    $sql = "DELETE FROM time.timecol WHERE ID = '".$pieces[0]."'";
    $conn->query($sql);
  }
  else
  {
    echo"<h1 style='color:red'>You Have Hours On This Job</h1>";
  }
}
if(strcasecmp($_POST[edit1],'OK')==0)
{
  $pieces = explode("|", $_POST[colid]);
  $specde = $_POST[spdes];
  $specde = str_replace("'", "\'", $specde);
  $sql = "UPDATE time.timecol SET project = '$specde' WHERE ID = '".$pieces[0]."'";
  $conn->query($sql);
  $Is_Focus = 1;
  $Job_Focus = $pieces[0];
}
if(strcasecmp($_POST[edit2],'OK')==0)
{
  $pieces = explode("|", $_POST[colid]);
  $specde = $_POST[spdes];
  $scodes = $_POST[jsc];
  $njob = $_POST['njns'];
  $sql = "SELECT * FROM time.timecol
  WHERE period = '$periods' and
  jn = '$njob' and
  code = '$scodes'and
  user = '$user';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if(empty($row))
  {
    if(strcasecmp($pieces[1],$njob)==0)
    {
      $sql = "UPDATE time.timecol SET code = '$scodes',jn = '$njob' WHERE ID = '".$pieces[0]."'";
      $conn->query($sql);
      $Is_Focus = 1;
      $Job_Focus = $pieces[0];
    }
    else
    {
      $sqls = "SELECT * FROM tc.job_name WHERE jn = '$njob'";
      $results = $conn->query($sqls);
      $rows = $results->fetch_assoc();
      if(empty($rows))
      {
        echo "<h2 style='color:red'>Duplicated Special Code Or Job Name For Job Number $".$pieces[1]."</h2>";
      }
      else if(strcasecmp($rows['closedout'],'N')==0)
      {
        $sql = "UPDATE time.timecol SET code = '$scodes',jn = '$njob' WHERE ID = '".$pieces[0]."'";
        $conn->query($sql);
        $Is_Focus = 1;
        $Job_Focus = $pieces[0];
      }
      else
      {
        echo "<h2 style='color:red'>$njob IS A SPECIAL CASE!</h2>";
      }
    }
  }
  else
  {
    echo "<h2 style='color:red'>Duplicated Special Code Or Job Name For Job Number $".$pieces[1]."</h2>";
  }
}

?>
