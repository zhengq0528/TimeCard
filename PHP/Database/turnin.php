<?php
if(strcasecmp($_POST[turnin],'Confirm')==0)
{
  $updated = TurnInUpdate($periods,$user);
  if($updated[0]==1)
  {
    if($newd == 1)
    {
      $newd +=1;
    }
    else
    {
      $newd = 1;
      if($newm == 12)
      {
        $newm = '01';
        $newy +=1;
      }
      else
      {
        $newm +=1;
      }
    }
    $newm = sprintf("%02d", $newm);
    $newdate = $newy.$newm.$newd;
    $upsql = "UPDATE time.current set period = '$newdate' WHERE init ='$user'";
    $conn->query($upsql);
    $strtss = $user.",".number_format($REG,1).",".number_format($OTs,1).",".number_format($VAC,1).",".number_format($SandP,1);
    $filename = "Y://TSS//TC".$periods.".txt";
    if (file_exists($filename)) {
      $current  = file_get_contents($filename);
      $current .= "
      $strtss";
      file_put_contents($filename, $current);
    } else {
      $myfile = fopen($filename, "w") or die("Unable to open file!");
      $txt = "$strtss\n";
      fwrite($myfile, $txt);
      fclose($myfile);
    }
    ?>
    <script>
    window.location = '../TurnInpage.php';
    </script>
    <?php
  }
  else
  {
    echo "<h2 style='color:red'> ".$updated[1]." Does Not Exist In Database! </h1>";
  }
}
?>
