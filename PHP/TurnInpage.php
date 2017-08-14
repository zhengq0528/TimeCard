
<center><body>
  <H2>You Successfully Turned In The TimeCard!</H2>
  <h3>Hit 'Quit' To Close Window</h3>
  <form action="../../intranet/jnsearch.html">
    <input type="submit" value="Quit" />
</form>
</body></center>
<script>
history.pushState(null, null, document.title);
window.addEventListener('popstate', function () {
    history.pushState(null, null, document.title);
});
function quitBox(cmd)
{
  var win = window.open("about:blank", "_self");
  win.close();
}
</script>
