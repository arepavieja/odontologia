<script>
	load('app/usuarios/vistas/lista.php','','#lista');
</script>
<div id="breadcrumbs" class="breadcrumbs">
  <script type="text/javascript">
  try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
  </script>
  <ul class="breadcrumb">
    <li><i class="icon-home home-icon"></i> <a href="">Inicio</a></li>
    <li class="active"><i class="fa fa-ambulance"></i> <a href="">Usuarios</a></li>
    <li class="active"> Administrar</li>
  </ul>
</div>
<div class="space-10"></div>
<div class="btn-toolbar pull-right">
      <div class="btn-group">
        <button type="button" class="btn btn-primary boton" onclick="modal('app/usuarios/vistas/usuario.insert.php','')">
          <i class="fa fa-plus-square"></i>  Nuevo Usuario
        </button>
      </div>
  </div>
<div class="clearfix"></div>
<div class="space-10"></div>
<div id="lista"></div>

<div class="modal fade" id="myModal"><div class="modal-dialog"> <div class="modal-content"></div></div></div>