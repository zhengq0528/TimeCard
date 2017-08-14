<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>TimeCard SYSTEM</title>
</head>

<?php
error_reporting(0);
include('db.php');
$domain = gethostbyaddr($_SERVER['REMOTE_ADDR']);
$sql = "SELECT * FROM time.users WHERE DNS ='$domain'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>
<body>
  <div id = "titles">
    <H2><CENTER>TimeCard</H2>
      <p><CENTER> Please Enter Your Initials!</P>
        <form method='get' action = "PHP/GetNamePeriod.php">
          <input type = "text" name = "init" value = "<?php echo $row['user'];?>">
          <input type = "Submit">
        </form>
      </div>
    </body>
    </html>
