<?php 
require 'cfg/base.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Odontología</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<meta name="Sistema de odontología" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/ace.css">
		<?php require 'js/ace.php'; ?>
	</head>
	<body>
		<div class="bootbox modal fade in" role="dialog" id="modal"  tabindex="-1" aria-hidden="false">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<div class="container">
			<div class="col-xs-12">
				<?php 
					if($musuarios->comprobarSesion()==1) { 
						require 'menu.php';
						require 'contenido.php';
					} else {
						require 'login.php';
					}
				?>
			</div>
		</div>
<script>
/*$(function(){
	$( window ).unload(function() {
     alert( "Prueba de unload" );
	});	
})*/ 

</script>

		<?php //echo $fun->up(); ?>
	</body>
</html>