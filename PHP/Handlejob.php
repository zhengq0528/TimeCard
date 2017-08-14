<?php
$jobcodes = array(
  "ADM"=>"Administrative Service","BIL"=>"Billing",
  "CA"=>"Construction Administration","CAD"=>"Cad Drafting",
  "CE"=>"Cost Estimates","CMTG"=>"Construction Meeting",
  "DE"=>"Design","DMTG"=>"Design Meeting",
  "FLD"=>"Field Time","FPO"=>"Final Punch Out",
  "FS"=>"Field Survey","IDPH"=>"IDPH Work",
  "MTG"=>"Misc. Meeting","OFF"=>"Office Work",
  "PPO"=>"Preliminary Punch Out","PRE"=>"Preliminary",
  "RVT"=>"Revit Tech","SD"=>"Shop Drawings",
  "SP"=>"Specification","WTH"=>"Walk thru","???"=>"Dont Know"
);

if(strcasecmp($_POST['mk'],'mk')==0)
{
  $addjob = $_POST[jobnumber];
  $specialcode = $_POST[sjc];
  $sql = "SELECT * FROM tc.job_name WHERE jn = '$addjob'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $des = $row[job_name_1].$row[job_name_2];

  if(strcasecmp($row[closedout],'N')==0|| empty($row[closedout]))
  {
    $sql = "SELECT * FROM time.timecol WHERE period = '$periods' and jn = '$addjob' and code = '$specialcode' and user = '$user';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $des = str_replace("'", "\'", $des);
    if(empty($row))
    {
      $adsql = "INSERT INTO time.timecol
      (period,code,jn,project,user)
      VALUES
      ('$periods','$specialcode','$addjob','$des','$user');";
      if(!empty($addjob))
      $conn->query($adsql);
      $Is_Focus = 1;
      $Job_Focus = mysqli_insert_id($conn);
    }
    else
    {
      $Is_Focus = 1;
      $Job_Focus = $row['id'];
      echo "<script>alert('Job Already Exist On The Timecard!');</script>";
    }
  }
  else if(strcasecmp($row[closedout],'Y')==0)
  {
    $des = addslashes($des);
    ?>
    <script>
    document.getElementById('d1').innerHTML = "Job Number: <i><?php echo "$addjob";?></i> <br> Description: <i><?php echo "$des";?></i>";
    var jb2 = document.getElementById('jb2');
    jb2.style.display = "block";
    document.getElementById('at2').focus();
    $('#j2c').click(function(){
      jb2.style.display = "none";
    });
    </script>
    <?php
  }
  else if(strcasecmp($row[closedout],'X')==0)
  {
    ?>
    <script>
    var jb3 = document.getElementById('jb3');
    jb3.style.display = "block";
    $('#j3c').click(function(){
      jb3.style.display = "none";
    });
    </script>
    <?php
  }
}
if(strcasecmp($_POST[test1],'ADD')==0)
{
  $addjob = $_POST[jobnumber];

  if(empty($addjob))
  {
    echo "<script>alert('Job Name Can Not Be Empoty!');</script>";
  }
  else if(strlen($addjob) <=4)
  {
    echo "<script>alert('Incorrect Job Name!');</script>";
  }
  else
  {
    $specialcode = $_POST[sjc];
    $sql = "SELECT * FROM tc.job_name WHERE jn LIKE '%{$addjob}%'";
    $result = $conn->query($sql);
    $cnum = mysqli_num_rows($result);

    $sql = "SELECT * FROM tc.job_name WHERE jn LIKE '%{$addjob}%'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $des = $row[job_name_1].$row[job_name_2];

    if(!empty($row))
    {
      if($cnum == 1)
      {
        if(strcasecmp($row[closedout],'N')==0 || empty($row[closedout]))
        {
          $sql = "SELECT * FROM time.timecol WHERE period = '$periods' and jn = '$addjob' and code = '$specialcode' and user = '$user';";
          $result = $conn->query($sql);
          $row = $result->fetch_assoc();
          $des = str_replace("'", "\'", $des);
          if(empty($row))
          {
            $adsql = "INSERT INTO time.timecol
            (period,code,jn,project,user)
            VALUES
            ('$periods','$specialcode','$addjob','$des','$user');";
            if(!empty($addjob))
            $conn->query($adsql);
            $Is_Focus = 1;
            $Job_Focus = mysqli_insert_id($conn);
          }
          else
          {
            $Is_Focus = 1;
            $Job_Focus = $row['id'];
            echo "<script>alert('Job Already Exist On The Timecard!');</script>";
          }
        }
        else if(strcasecmp($row[closedout],'Y')==0)
        {
          $des = addslashes($des);
          ?>
          <script>
          //document.getElementById('j1').innerHTML = "Job Number: <?php echo $addjob;?>";
          document.getElementById('d1').innerHTML = "Job Number: <i><?php echo "$addjob";?></i> <br> Description: <i><?php echo "$des";?></i>";
          var jb2 = document.getElementById('jb2');
          jb2.style.display = "block";
          document.getElementById('at2').focus();
          $('#j2c').click(function(){
            jb2.style.display = "none";
          });
          </script>
          <?php
        }
        else if(strcasecmp($row[closedout],'X')==0)
        {
          //echo "<br><br><h1>$cnum + $des This is not good</h1><br>";
          ?>
          <script>
          var jb3 = document.getElementById('jb3');
          jb3.style.display = "block";
          $('#j3c').click(function(){
            jb3.style.display = "none";
          });
          </script>
          <?php
        }
      }
      else if($cnum > 1)
      {
        ?>
        <script>
        var jb4 = document.getElementById('jl');
        jb4.style.display = "block";
        $('#jlc').click(function(){
          jb4.style.display = "none";
        });
        </script>
        <?php
      }
    }
    else if(empty($addjob))
    {
      echo "<script>alert('Empty Job Name');</script>";
    }
    else
    {
      ?>
      <script>
      document.getElementById('anew').innerHTML = "Job Number: <?php echo $addjob?> Was Not Found <br> Add It Anyway?";
      document.getElementById('m1').value = "<?php echo $addjob;?>";
      document.getElementById('m2').value = "<?php echo $specialcode;?>";
      var jb4 = document.getElementById('jb4');
      jb4.style.display = "block";
      $('#j4c').click(function(){
        jb4.style.display = "none";
      });
      </script>
      <?php
    }
  }

}

if(strcasecmp($_POST[addit],'OK')==0)
{
  echo "hello $_POST[m1]";
  ?>
  <script>
  document.getElementById('m3').value = "<?php echo $_POST[m1];?>";
  document.getElementById('m4').value = "<?php echo $_POST[m2];?>";
  var jb4d = document.getElementById('jb4d');
  jb4d.style.display = "block";
  $('#j4cd').click(function(){
    jb4d.style.display = "none";
  });
  </script>
  <?php
}
if(strcasecmp($_POST[addit2],'OK')==0)
{

  $sql = "SELECT * FROM time.timecol WHERE period = '$periods' and jn = '$_POST[m3]' and code = '$_POST[m4]' and user = '$user';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  if(empty($row))
  {

    $_POST[newdes] = str_replace("'", "\'", $_POST[newdes]);
    $adsql = "INSERT INTO time.timecol
    (period,code,jn,project,user)
    VALUES
    ('$periods','$_POST[m4]','$_POST[m3]','$_POST[newdes]','$user');";
    if(!empty($_POST['m3']))
    $conn->query($adsql);
    $Is_Focus = 1;
    $Job_Focus = mysqli_insert_id($conn);
  }
  else
  {
    $Is_Focus = 1;
    $Job_Focus = $row['id'];
    echo "<script>alert('Job Already Exist On The Timecard!');</script>";
  }
}
if(strcasecmp($_POST[at2],'OK')==0)
{
  $job = $_POST[jn];
  $co = $_POST[co];
  $sql = "SELECT * FROM tc.job_name WHERE jn = '$job'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $des = $row[job_name_1].$row[job_name_2];
  $sql = "SELECT * FROM time.timecol WHERE period = '$periods' and jn = '$job' and code = '$co' and user = '$user';";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  $des = str_replace("'", "\'", $des);
  if(empty($row))
  {
    $adsql = "INSERT INTO time.timecol
    (period,code,jn,project,user)
    VALUES
    ('$periods','$co','$job','$des','$user');";
    if(!empty($job))
    $conn->query($adsql);
    $Is_Focus = 1;
    $Job_Focus = mysqli_insert_id($conn);
  }
  else
  {
    $Is_Focus = 1;
    $Job_Focus = $row['id'];
    echo "<script>alert('Job Already Exist On The Timecard!');</script>";
  }

}
?>
