<!-- The Modal -->
<?php
$jobcode = array(
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
?>

<div id="jb1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span id = 'j1' class="close">&times;</span>
    <center>
      <form action='#' method ='post'>
        <H3>Get Code</H3>
        <H3>Enter Job Number:</h3>
          <input id = 'ajt1' type='text' name = 'jobnumber'>
          <H3> Select Work Code: </h3>
            <select size = '22' name = 'sjc' id='sc'>
              <option value="ADM">Administrative Service</option>
              <option value="BIL">Billing</option>
              <option value="CA">Construction Administration</option>
              <option value="CAD">Cad Drafting</option>
              <option value="CE">Cost Estimates</option>
              <option value="CMTG">Construction Meeting</option>
              <option selected="selected" value="DE">Design</option>
              <option value="DMTG">Design Meeting</option>
              <option value="FLD">Field Time</option>
              <option value="FPO">Final Punch Out</option>
              <option value="FS">Field Survey</option>
              <option value="IDPH">IDPH Work</option>
              <option value="MTG">Misc. Meeting</option>
              <option value="OFF">Office Work</option>
              <option value="PMTG">Pre-Bid Meeting</option>
              <option value="PPO">Preliminary Punch Out</option>
              <option value="PRE">Preliminary</option>
              <option value="RVT">Revit Tech</option>
              <option value="SD">Shop Drawings</option>
              <option value="SP">Specification</option>
              <option value="WTH">Walk thru</option>
              <option value="???">Don't Know</option>
            </select>
            <br>
            <br>
            <!--<input type='hidden' name = 'job' value = 'job'>-->
          <input type='submit' name ='test1' value = 'ADD'>
          </form>
        </center>
      </div>
    </div>

    <div id="jb2" class="modal">
      <form action='#' method='post'>
        <!-- Modal content -->
        <div class="modal-content">
          <center>
            <h3 id = d1>Description:</h3>
            <h3> Is Closed Out, Do You Still Want To Put Time On It?</h3>
            <input type='hidden' name = 'jn' value = '<?php echo $_POST[jobnumber];?>'>
            <input type='hidden' name = 'co' value = '<?php echo $_POST[sjc];?>'>
            <input type='submit' id = 'at2' name ='at2' value = 'OK'>
            <input type='submit' id = 'j2c' value = 'Cancel'>
          </center>
        </div>
      </form>
    </div>

    <div id="jl" class="modal">
      <form action='#' method='post'>
        <!-- Modal content -->
        <div class="modal-content">
          <center>
            <?php
            $addjob = $_POST['jobnumber'];
            $specialcode = $_POST['sjc'];
            if(!empty($addjob) && !empty($specialcode) && empty($_POST['mk']))
            {
              $sql = "SELECT * FROM tc.job_name
              WHERE jn LIKE '%{$addjob}%'";
              $result = $conn->query($sql);
              echo "<h2>Select A Job Number To Add</h2>";
              echo "<p> Red Background Color Means You Can Not Add Hours</p>";
              echo "<p> Lightblue Background Color Means Project is closedout</p>";
              echo "<p> White Background Color Means Projects is normal</p>";
              echo "<table >";
              $count = 0;
              while($row = $result->fetch_assoc())
              {
                $count++;
                $bcolor=0;
                if(strcmp($row['closedout'],'X')==0) $bcolor = 'red';
                else if(strcmp($row['closedout'],'Y')==0) $bcolor = 'lightblue';
                else if(strcmp($row['closedout'],'N')==0) $bcolor = 'White';
                echo "<tr bgcolor='$bcolor' style ='border:1px solid black;'>";
                echo "<td style ='border:1px solid black'>";
                echo "<input type ='hidden' value = '$specialcode' name ='sjc'>";
                echo "<input type ='hidden' value = 'mk' name ='mk'>";
                $tmpjob = $row['jn'];
                echo "<input
                type = 'submit'
                style = 'width:100px;'
                name = 'jobnumber'
                value ='$row[jn]'>";
                echo "</td>";
                echo "<td style ='border:1px solid black'>";
                echo "$row[job_name_1].$row[job_name_2]";
                echo "</td>";
                echo "</tr>";
              }

              echo "</table>";
            }
            ?>
            <input type='submit' id = 'jlc' value = 'Cancel'>
          </center>
        </div>
      </form>
      <?php
      /*
      if($count==1)
      {
        $count = 99;
        echo "<form action='#' method='post' id = 'formaj'>";
        echo "<input type ='hidden' value = '$specialcode' name ='sjc'>";
        echo "<input type ='hidden' value = '$tmpjob' name ='jobnumber'>";
        echo "<input type ='hidden' value = 'mk' name ='mk'>";
        echo "</form>";
        ?>
        <script>
          document.getElementById("formaj").submit();
        </script>
        <?php
      }
      */
      ?>
    </div>


    <div id="jb3" class="modal">
      <form action='#' method='post'>
        <!-- Modal content -->
        <div class="modal-content">
          <center>
            <h3>Can Not Add Hours to Selected Job Number: <?php echo $_POST[jobnumber];?></h3>
            <input type='submit' id = 'j3c' value = 'Ok'>
          </center>
        </div>
      </form>
    </div>

    <div id="jb4" class="modal">
      <form action='#' method='post'>
        <!-- Modal content -->
        <div class="modal-content">
          <center>
            <h3 id = 'anew'></h3>
            <form method='post'>
              <input type='hidden' id = 'm1' name = 'm1' value = '1'>
              <input type='hidden' id = 'm2' name = 'm2' value = '2'>
              <input type='submit' id = 'addit' name = 'addit' value = 'OK'>
              <input type='submit' id = 'j4c' value = 'Cancel'>
            </form>
          </center>
        </div>
      </form>
    </div>

    <div id="jb4d" class="modal">
      <form action='#' method='post'>
        <!-- Modal content -->
        <div class="modal-content">
          <center>
            <h3>Description: </h3>
            <form method='post'>
              <input type='hidden' id = 'm3' name = 'm3' value = '1'>
              <input type='hidden' id = 'm4' name = 'm4' value = '2'>
              <input type= 'text' name = 'newdes' maxlength="51">
              <br>
              <input type='submit' id = 'addit2' name = 'addit2' value = 'OK'>
              <input type='submit' id = 'j4cd' value = 'Cancel'>
            </form>
          </center>
        </div>
      </form>
    </div>
