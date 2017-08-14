<!-- The Modal -->

<div id="sc1" class="modal">
  <!-- Modal content -->
  <div class="modal-content">
    <span id = 'c1' class="close">&times;</span>
    <center>
    <H3>Get Code</H3>
    <form action='#'method ='post'>
    <select size = '8' name = 'sc' id='sc'>
      <option value="CMU">CAD MENU</option>
      <option value="HOL">HOLIDAY</option>
      <option value="MSC">MISC.</option>
      <option selected="selected" value="OFF">OFFICE</option>
      <option value="PSL">PERSONAL</option>
      <option value="SIC">SICK</option>
      <option value="SMT">STAFF MEETING</option>
      <option value="VAC">VACATION</option>
    </select>
    <br>
    <br>
    <input type='hidden' name = 'sub1' value = 'sub'>
    <input type='submit' name ='t1' value = 'OK'>
  </form>
  </center>
  </div>
</div>

<div id="sc2" class="modal">
  <form action='#' method='post'>
  <input type='hidden' name='sd' value='<?php echo $selectedvalue;?>'>
  <!-- Modal content -->
  <div class="modal-content">
    <center>
    <h3>Description:</h3>
    <input type="text" maxlength="51" name = "misc" value = "MISC">
    <br><br>
    <input type='hidden' name = 'sub2' value = 'sub2'>
    <input type='submit' name ='t2' value = 'OKs'>
  </center>
  </div>
  </form>
</div>
