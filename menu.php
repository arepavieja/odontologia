<?php 
$mod = $musuarios->modulosUsuario();
//print_r($mod);
?>
<!--<div class="center" style="background-color:black; background-image: url(img/bg-ojo.png); background-repeat:no-repeat" ; width:1000px; height:150px >-->
<div class="col-sm-12" style="background:#000">
	<div class="space-10"></div>
	<img src="img/logo_ojos.png" align="" class="pull-left">	
     <h1 class="pull-left" style="padding-left:30px">
     	<div class="space-16"></div>
     	<span class="blue">ODONTO-ESTETICA</span>
     	<span class="white">DRA. AMBAR K. ALDANA H.</span>
     </h1>
     <div class="clearfix"></div>
    <div class="space-10"></div>
</div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div class="row">
	<div class="col-xs-12">
		<div class="navbar navbar-default" id="navbar">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>
			<div class="navbar-container" id="navbar-container">
				<div class="navbar-header pull-left">
					<a href="#" class="navbar-brand">
						<small>
							<img src="img/favicon.ico" width='25px' height='25px'>
							<!--<i class="icon-leaf"></i>-->
							Odontología
						</small>
					</a><!-- /.brand -->
				</div><!-- /.navbar-header -->
				<div class="navbar-header pull-left" role="navigation">
					<ul class="nav ace-nav">
						<?php foreach($mod as $m) { ?>
							<?php $smod = $musuarios->subModulosUsuario($m->modu_ide); ?>
							<li class="light-blue">
								<a href="" data-toggle="dropdown" class="dropdown-toggle">
									<i class="<?php echo $m->modu_ico ?>"></i>&nbsp;&nbsp;<?php echo $m->modu_des ?>
									<span class="icon-caret-down icon-only smaller-90"></span>
								</a>
								<ul class="user-menu pull-left dropdown-purple dropdown-menu dropdown-caret dropdown-close">
									<?php foreach($smod as $sm) { ?>
										<li>
											<a href="?var=<?php echo base64_encode($sm->subm_ide) ?>">
												<i class="<?php echo $sm->subm_ico ?>"></i> &nbsp;
												<?php echo $sm->subm_des ?>
											</a>
										</li>
									<?php } ?>
								</ul>		
							</li>
						<?php } ?>
					</ul> <!-- .nav navbar-nav -->
				</div> <!-- .navbar-collapse collapse pull-left -->
				<div class="navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Foto" />
								<span class="user-info">
									<small>Bienvenid@,</small>
									<?php echo $_SESSION['nom'] ?>
								</span>
								<i class="icon-caret-down"></i>
							</a>
							<ul class="user-menu pull-right dropdown-menu dropdown-purple dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="fa fa-user fa-lg"></i> 
										Perfil
									</a>
								</li>
								<li>
									<a href="?var2=correo/vistas/admin">
										<i class="fa fa-envelope"></i> 
										Correo
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a href="salir.php">
										<i class="icon-off"></i>
										Salir
									</a>
								</li>
							</ul>
						</li>
					</ul> <!-- .nav navbar-nav -->
				</div> <!-- .navbar-collapse collapse pull-left -->
			</div> <!-- #navbar-container -->
		</div> <!-- #navbar -->
	</div> <!-- .col-xs-12 -->
</div> <!-- .row -->