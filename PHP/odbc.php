<?php
//Database, it is a temperate database connection
$mysql_hostname = 'localhost';
$mysql_user = 'root';
$mysql_password = 'bard$rover';
$mysql_database = "Dickerson Engineer";
$conn = new mysqli($mysql_hostname, $mysql_user,$mysql_password);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "DELETE FROM time.tsdata";
$result = $conn->query($sql);
//$sql = "INSERT INTO time.tsdata (jn,project,code,date,hours,employee,month,time) VALUES (1,1,1,1,1,1,1,1)";
//$result = $conn->query($sql);
error_reporting(0);
$db = odbc_connect("job_name","","") or die("Cannot connect to database\n".odbc_errormsg());
$myfile = fopen("Q://TC//tsdata.txt", "w") or die("Unable to open file!");

$count = 0;

$query = "SELECT * FROM tsdata";
$result = odbc_exec($db,$query);
while (odbc_fetch_row($result)) {
  $i = odbc_result($result,"id");
  $j = odbc_result($result,"jn");
  $p = odbc_result($result,"project");
  $p = str_replace("'", "\'", $p);
  $c = odbc_result($result,"code");
  $d = odbc_result($result,"date");
  $h = odbc_result($result,"hours");
  $e = odbc_result($result,"employee");
  $m = odbc_result($result,"month");
  $t = odbc_result($result,"time");
  $sql = "\"$j\",\"$p\",\"$c\",\"$d\",$h,\"$e\",$m,\"$t\"
  ";
  if(empty($m)) $m = date('m');
  fwrite($myfile, $sql);
  $count++;
  $sql = "INSERT INTO time.tsdata (jn,project,code,date,hours,employee,month,time) VALUES ('$j','$p','$c','$d','$h','$e','$m','$t')";
  //$result = $conn->query($sql);
  if(!$conn->query($sql)) echo $conn->error;
  //echo $sql;
}
echo "$count is here<bR>";
$Lastdays = odbc_result($result,"PostedThru");
$InPost = odbc_result($result,"InPost");

$odbcy = $Lastdays[2].$Lastdays[3];
$odbcm = $Lastdays[5].$Lastdays[6];
$odbcd = $Lastdays[8].$Lastdays[9];
if($odbcd > 16) $odbcd = 2;
else $odbcd = 1;
$odbcdate = $odbcy.$odbcm.$odbcd;
$year = date('y');
$month = date('m');
$day = date('d');
if($day > 16) $day = 2;
else $day = 1;
$select = $year.$month.$day;
$sql = "SELECT * FROM time.timecol WHERE period like '$select%'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc())
{
  $count ++;
  $row['user'] = strtoupper($row['user']);
  for($i = 1 ; $i <= 16; $i++)
  {
    $judge = $row['period'][4];
    if($judge == 1) $day = $i;
    else if($judge ==2) $day = $i+15;

    $day = sprintf("%02d", $day);
    $get_date = "$month/$day/$year";
    if($row['d'.$i] > 0)
    {
      $pos = 'd'.$i;
      $row[$pos] = number_format($row[$pos], 2, '.', ',');

      $sql =
"\"$row[jn]\",\"$row[project]\",\"$row[code]\",\"$get_date\",$row[$pos],\"$row[user]\",$month,\"999\" \t";
      fwrite($myfile, $sql);
      $p = str_replace("'", "\'", $row['project']);
      $sql = "INSERT INTO time.tsdata (jn,project,code,date,hours,employee,month,time)
      VALUES ('$row[jn]','$p','$row[code]','$get_date','$row[$pos]','$row[user]','$month','999')";
      //$result = $conn->query($sql);
      if(!$conn->query($sql)) echo $conn->error;
    }
  }
}
echo "Successfully Generate HOURS FROM SQL to TXT FILE; NUMBER=>".$count."<br>";


fclose($myfile);

?>
