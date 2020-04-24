<!--Import jQuery before materialize.js-->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('.datepicker').datepicker();
    $('select').formSelect();
    $("select[required]").css({display: "inline", height: 0, padding: 0, width: 0});
    M.updateTextFields();
    $('.sidenav').sidenav();
    $('.parallax').parallax();
    $('.modal').modal();
  });
</script>
</body>
</html>