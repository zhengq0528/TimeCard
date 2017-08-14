<?php
error_reporting(0);
include('Database/db.php');
$sql = "SELECT * FROM tc.employee Where Employee = '$_GET[init]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row[First_name]." $row[Middle] ".$row[Last_name];
$active = $row[Active];
echo "$name";
echo "$active";

if($active != 1)
{
  echo "<h1 style='color:red'>USER INITIAL <--$_GET[init]--> Does Not Exist!</h1>";
}
else
{
  $sql = "SELECT * FROM time.current WHERE init = '$_GET[init]'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $period = $row[period];
  echo "$period";
  echo "<br>";

  $ps;
  if(date('d') >= 16) $ps = 2;
  else $ps = 1;
  $ge_p = date('y').date('m').$ps;
  echo $ge_p;
  if(empty($period))
  {
    $_GET[init] = strtoupper($_GET[init]);
    $sql = "INSERT INTO time.current (init,period) VALUES ('$_GET[init]','$ge_p')";
    $conn->query($sql);
    $period = $ge_p;
  }
  ?>
  <form id = 'go' method = 'GET' action = "TimeCard.php">
    <input type ='hidden' value = '<?php echo $_GET[init]; ?>' name = 'init'>
    <input type ='hidden' value = '<?php echo $period; ?>' name = 'p'>
    <input type ='hidden' value = '<?php echo $name; ?>' name = 'n'>

  </form>
  <script>
    document.getElementById("go").submit();
  </script>
  <?php
}
?>
