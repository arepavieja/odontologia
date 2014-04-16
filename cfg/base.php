<?php 
if(file_exists('cfg/')) {
	require 'cfg/conexion.php';
	require 'cfg/config.php';
	require 'cfg/funciones.php';
	require 'lib/PHPMailer/PHPMailerAutoload.php';
} else {
	require '../../../cfg/conexion.php';
	require '../../../cfg/config.php';
	require '../../../cfg/funciones.php';
	require '../../../lib/PHPMailer/PHPMailerAutoload.php';
}

$folders = array(
		'usuarios',
		'historia',
		'general',
		'diagnos',
		'proced',
		'diagproc',
		'ortodon',
		'examen',
		'recipes',
		'radiogra',
		'odonto',
		'citas',
		'correo',
		'reportes'
	);

$clases = array(
		array('mUsuarios','cUsuarios'),
		array('mHistoria','cHistoria'),
		array('mGeneral','cGeneral'),
		array('mDiagnos','cDiagnos'),
		array('mProced','cProced'),
		array('mDiagproc','cDiagproc'),
		array('mOrtodon','cOrtodon'),
		array('mExamen','cExamen'),
		array('mRecipes','cRecipes'),
		array('mRadiogra','cRadiogra'),
		array('mOdonto','cOdonto'),
		array('mCitas','cCitas'),
		array('mCorreo','cCorreo'),
		array('mReportes','cReportes')
	);

foreach($folders as $ind=>$f) {
	foreach($clases[$ind] as $c) {
		if(file_exists('app/'.$f.'/clases/')) {
			require 'app/'.$f.'/clases/'.$c.'.php';
		} else {
			if(file_exists('../../'.$f.'/clases/')) {
				require '../../'.$f.'/clases/'.$c.'.php';
			} else {
				if(file_exists('../clases/'.$c[0].'.php')) {
					require '../clases/'.$c.'.php';
				}
			}
		}
	}
}

#Instancias
#$con = new Conexion();
$fun = new Funciones();
foreach($folders as $ind=>$f) {
	foreach($clases[$ind] as $c) {
		$clase = strtolower($c);
		$$clase = new $c();
	}
}

?>