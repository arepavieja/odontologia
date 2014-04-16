<?php 
echo '<div class="page-content">';
if(isset($_GET['var'])) {
	$href = $musuarios->contenido($_GET['var']);
	if(count($href)>0) {
		if(file_exists('app/'.$href[0]->subm_url.'.php')) {
			require 'app/'.$href[0]->subm_url.'.php';
		} else {	
			echo 'No existe el directorio';
		}
	} else {
		echo 'No tiene permisos de acceso';
	}
} else {
	if(isset($_GET['var2'])) {
		require 'app/'.$_GET['var2'].'.php';
	} else {
		require 'default.php';
	}
}
echo '</div>';
?>

	