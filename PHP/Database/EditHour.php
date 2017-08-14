<?php
//Updating the Time Table Data.
include("db.php");
if($_POST['data'])
{
  $data=$_POST['data'];
  $datas = explode("|",$data);
  $id = $datas[0]; $pos =$datas[1]; $time = $datas[2];
  $pos = "d".$datas[1];
  $sql = "UPDATE time.timecol SET $pos = '$time'
  WHERE id = '$id'";
  $conn->query($sql);
}
?>
