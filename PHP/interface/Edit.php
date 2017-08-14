<div id="edit1" class="modal">
  <form action='#' method='post'>
    <!-- Modal content -->
    <div class="modal-content">
      <center>
        <h3 id = 'e1'>Description</h3>
        <form method='post'>
          <input type='text' maxlength="51" id = 'spdes' name ='spdes' value = ''>
          <input type='hidden' id = 'colid' name = 'colid' value = ''>
          <br>
          <input type='submit' id = 'delc' name = 'edit1' value = 'OK'>
          <input type='submit' id = 'No' value = 'Cancel'>
        </form>
      </center>
    </div>
  </form>
</div>

<div id="edit2" class="modal">
  <form action='#' method='post'>
    <!-- Modal content -->
    <div class="modal-content">
      <center>
        <h3 id = 'e2'>Editing Job Numbe</h3>
        <form method='post'>
          <table style="width:500px;"border="0" class ="table  table-hover">
              <tr>
                <td>Job Number</td>
                <td><input type='text' id = 'ejn1' name = 'njns'></td>
              </tr>
              <tr>
                <td>Project Name</td>
                <td id = 'epn1'></td>
              </tr>
              <tr>
                <td>Work Code</td>
                <td>
                  <select size = '22' id = 'jsc' name = 'jsc' id='sc'>
                    <option value="ADM">Administrative Service</option>
                    <option value="BIL">Billing</option>
                    <option value="CA">Construction Administration</option>
                    <option value="CAD">Cad Drafting</option>
                    <option value="CE">Cost Estimates</option>
                    <option value="CMTG">Construction Meeting</option>
                    <option value="DE">Design</option>
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
                </td>
              </tr>
          </table>
          <input type='hidden' id = 'colids' name = 'colid' value = ''>
          <br>
          <input type='submit' id = 'delc' name = 'edit2' value = 'OK'>
          <input type='submit' id = 'No' value = 'Cancel'>
        </form>
      </center>
    </div>
  </form>
</div>

<div id="edit3" class="modal">
  <form action='#' method='post'>
    <!-- Modal content -->
    <div class="modal-content">
      <center>
        <h3 id = 'e3'></h3>
        <form method='post'>
          <input type='hidden' id = 'colid' name = 'colid' value = ''>
          <br>
          <input type='submit' id = 'delc' name = 'Testing' value = 'OK'>
        </form>
      </center>
    </div>
  </form>
</div>
