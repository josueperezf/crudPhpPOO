<!DOCTYPE html>
<html lang="es">
<head>
    
    <title>Bodega POO</title>

    <!-- Styles -->
	<link rel="stylesheet" type="text/css" href="assets/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/toastr.css">
    
    <style>
    .modal { width: 75% !important; height: 75% !important ; }  /* increase the height and width as you desire */
    </style>
	<script type="text/javascript" src="assets/js/jquery-3.2.1.js"></script>	
	<script type="text/javascript" src="assets/js/materialize.min.js"></script>	
	<script type="text/javascript" src="assets/js/toastr.js"></script>	
	<script type="text/javascript" src="assets/js/libreria.js"></script>	
	<script type="text/javascript" src="assets/js/js.js"></script>	
</head>
<body>
<script>

</script>
    <div id="app">
		<?php require_once('menu_top.php'); ?>
		<?php require_once('correr.php'); ?>
		<?php require_once('menu_left.php'); ?>
		<?php require_once('modal.php'); ?>
    </div>
<script>
    $(document).ready(function(){
        
        $('select').formSelect();
        $(".dropdown-trigger").dropdown();
                
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems, {});
    });
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('#slide-out');
        var instances = M.Sidenav.init(elems, {edge:'right'});
    });

  //edge:'right'

</script>
</body>
</html>