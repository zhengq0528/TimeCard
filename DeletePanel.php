<head>
<style>
/* Delete the existing panels.
   You can add more conditions here when you are deteting the panel*/
.modal2 {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content */
.modal-content2 {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}
/* The Close Button */
.close2 {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}
.close2:hover,
.close2:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
</head>
<!-- Trigger/Open The Modal -->
<button style="height:40px;width:140px" id="myBtn2">Delete A Panel</button>
<!-- The Modal -->
<div id="myModal2" class="modal2">  <!-- Modal content -->
  <div class="modal-content2">
    <center>
    <span class="close2">&times;</span>
     <h1>hello<h1>
  </center>
  </div>
</div>

<script>
// Get the modal
var modal2 = document.getElementById('myModal2');
// Get the button that opens the modal
var btn2 = document.getElementById("myBtn2");
// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close2")[0];
// When the user clicks the button, open the modal
btn2.onclick = function() {
    modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    modal2.style.display = "none";
}


</script>
