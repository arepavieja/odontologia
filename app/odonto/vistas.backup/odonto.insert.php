<?php require '../../../cfg/base.php'; ?>
<?php 
//$diagnos = $mdiagnos->diagnosSelect();
/**
 * $dr array Diagnosticos Rows Guarda todos los diagnósticos hechos a un paciente.
 * @var [type]
 */
$dr = $modonto->odontoSelectCedrifOdonto($cedrif);
//print_r($dr);
?>
<script>
	load('app/odonto/vistas/diagnosticos.php','cedrif=<?php echo $cedrif; ?>','#seleccionados');
	otrolugar = 0;
	$('#otrolugar').on('click', function() {
		var estado = this.checked;
		if(estado==true) {
			otrolugar = 1;
		} else {
			otrolugar = 0;
		}
	})
	$(function(){
		

		$('.num').click(function(){
			thisnum = $(this);
			pieza = '.'+$(this).attr('id')+'d>.diente';
			est   = $(this).attr('est');
			if(est==0) {
				$(pieza).addClass('todo');
				$(this).attr('est','1');
				$(pieza).attr('est','1');
				diente = $(this).attr('diente');
				cedula = '<?php echo $cedrif ?>';
				diagno = $('#diagno').val()
				grupo  = $(this).attr('id');

				datos = 'diagno='+diagno+'&diente='+diente+'&parte=T&cedrif='+cedula+'&grupo='+grupo+'&otrolugar='+otrolugar;
				$.post('app/odonto/procesos/p.diente.insert.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif=<?php echo $cedrif ?>','#odontoinsert');
						load('app/odonto/vistas/diagnosticos.php','cedrif='+cedula,'#seleccionados');
					} else {
						$(pieza).removeClass('todo');
						$(thisnum).attr('est','0');
						$(pieza).attr('est','0');
						alert(data)
					}
				})

			} else {
				$(pieza).removeClass('todo');
				$(this).attr('est','0');
				$(pieza).attr('est','0');
			}
		})

		$('.diente').click(function(){
			thisdiente = $(this);
			est   = $(this).attr('est');
			padre = $(this).parent().attr('class').split(' ');
			id_padre = '#'+padre[3].substr(0,5);
			if(est==undefined || est==0) {
				$(this).attr('est','1');
				$(this).addClass('todo');
				cedula = '<?php echo $cedrif ?>';
				diagno = $('#diagno').val();
				diente = $(id_padre).attr('diente');
				parte  = $(this).attr('parte');
				grupo  = $(id_padre).attr('id');
				datos = 'diagno='+diagno+'&diente='+diente+'&parte='+parte+'&cedrif='+cedula+'&grupo='+grupo+'&otrolugar='+otrolugar;
				$.post('app/odonto/procesos/p.diente.insert.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif=<?php echo $cedrif ?>','#odontoinsert');
						load('app/odonto/vistas/diagnosticos.php','cedrif='+cedula,'#seleccionados');
					} else {
						$(thisdiente).attr('est','0');
						$(thisdiente).removeClass('todo');
						$(id_padre).attr('est','0');
						alert(data);
					}
				})
			} else {
				$(this).attr('est','0');
				$(this).removeClass('todo');
				$(id_padre).attr('est','0');
			}
		})
	

    $('.ortodon').click(function(){
				cedula = '<?php echo $cedrif ?>';
				diagno = $('#diagno').val();
				diente = "OR";
				parte  = "T";
				grupo  = "";
				datos = 'diagno='+diagno+'&diente='+diente+'&parte='+parte+'&cedrif='+cedula+'&grupo='+grupo+'&otrolugar='+otrolugar;
		if(diagno==39){		
				$.post('app/odonto/procesos/p.diente.insert.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif=<?php echo $cedrif ?>','#odontoinsert');
						load('app/odonto/vistas/diagnosticos.php','cedrif='+cedula,'#seleccionados');
					} else {
						alert(data);
					}
				})
		}else{
        				alert("Debe seleccionar el diagnostico Ortodoncia para este boton");
		}	
		})

	})
</script>
<script>
	$(function() { 
		<?php if(count($dr)>0) { ?>
			<?php foreach($dr as $dc) { ?>
				<?php if($dc->diagno_codigo=='41') { ?>
					capa = '.<?php echo strtolower($dc->diagcons_grupo) ?>d>.ausencia';
					$(capa).addClass('ausente');
				<?php } else { ?>
					<?php if($dc->diagcons_parte=='T ') { ?>	
						capa = '.<?php echo strtolower($dc->diagcons_grupo) ?>d>.diente';
						$(capa).css('background-color','<?php echo $dc->diagno_color ?>');				
					<?php } else { ?>
						capa = '.<?php echo strtolower($dc->diagcons_grupo) ?>d>.diente';
						parte = capa+'[parte=\'<?php echo trim($dc->diagcons_parte); ?>\']';
						$(parte).css('background-color','<?php echo $dc->diagno_color ?>');
					<?php } ?>
				<?php } ?>
			<?php } ?>
		<?php } ?>
	})
</script>

<div class="col-sm-12"> <!-- Primer y Segundo cuadrante -->
				
				<div class="col-sm-6" style="padding-top:20px;padding-bottom:20px;border-right:1px solid #000; border-bottom: 1px solid #000;"> <!-- Cuadrante 1 -->
					<div class="col-sm-12" style="margin-bottom: 20px;"> <!-- Primera línea del primer cuadrante -->
						<!-- Imagen de Ortodoncia-->
						<div class="col-sm-1 ortodon" style="position:absolute; top:-10px; left:120px diente" id="ortodoncia" est='0'><img src="img/ortodoncia.png"; width="80px" height="80px" title="Ortodoncia"></div>
						<!-- Fin Ortodoncia-->
						<div class="col-sm-1 pull-right text-center num" id="c1pla" est='0' diente="51">A</div>
						<div class="col-sm-1 pull-right text-center num" id="c1plb" est='0' diente="52">B</div>
						<div class="col-sm-1 pull-right text-center num" id="c1plc" est='0' diente="53">C</div>
						<div class="col-sm-1 pull-right text-center num" id="c1pld" est='0' diente="54">D</div>
						<div class="col-sm-1 pull-right text-center num" id="c1ple" est='0' diente="55">E</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 col no-padding c1plad pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>


						<div class="col-sm-1 col no-padding c1plbd pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c1plcd pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c1pldd pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c1pled pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>						
					</div> <!-- Fin Primera línea del primer cuadrante -->

					<div class="col-sm-12">		<!-- Segunda línea del primer cuadrante -->		
						
						<div class="col-sm-1 col no-padding c1sl1d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl2d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl3d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl4d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl5d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl6d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl7d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c1sl8d pull-right">
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="ausencia"></div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl1" est='0' diente="11">1</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl2" est='0' diente="12">2</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl3" est='0' diente="13">3</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl4" est='0' diente="14">4</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl5" est='0' diente="15">5</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl6" est='0' diente="16">6</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl7" est='0' diente="17">7</div>
						<div class="col-sm-1 pull-right text-center num" id="c1sl8" est='0' diente="18">8</div>
					</div> <!-- Fin Segunda línea del primer cuadrante -->				
				</div> <!-- Fin Cuadrante 1 -->

				<div class="col-sm-6" style="padding-top:21px;padding-bottom:18px; border-bottom: 1px solid #000;"> <!-- Cuadrante 2 -->
					<div class="col-sm-12" style="margin-bottom: 20px;"> <!-- Primera línea cuadrante 2 -->
						<div class="col-sm-1 text-center num" id="c2pla" est='0' diente="61">A</div>
						<div class="col-sm-1 text-center num" id="c2plb" est='0' diente="62">B</div>
						<div class="col-sm-1 text-center num" id="c2plc" est='0' diente="63">C</div>
						<div class="col-sm-1 text-center num" id="c2pld" est='0' diente="64">D</div>
						<div class="col-sm-1 text-center num" id="c2ple" est='0' diente="65">E</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 col no-padding c2plad">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2plbd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2plcd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2pldd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2pled">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-7"></div>
					</div> <!-- Fin Primera línea cuadrante 2 -->
					<div class="col-sm-12"> <!-- Segunda línea cuadrante 2 -->

						<div class="col-sm-1 col no-padding c2sl1d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl2d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl3d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl4d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl5d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl6d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl7d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c2sl8d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 text-center num" id="c2sl1" est='0' diente="21">1</div>
						<div class="col-sm-1 text-center num" id="c2sl2" est='0' diente="22">2</div>
						<div class="col-sm-1 text-center num" id="c2sl3" est='0' diente="23">3</div>
						<div class="col-sm-1 text-center num" id="c2sl4" est='0' diente="24">4</div>
						<div class="col-sm-1 text-center num" id="c2sl5" est='0' diente="25">5</div>
						<div class="col-sm-1 text-center num" id="c2sl6" est='0' diente="26">6</div>
						<div class="col-sm-1 text-center num" id="c2sl7" est='0' diente="27">7</div>
						<div class="col-sm-1 text-center num" id="c2sl8" est='0' diente="28">8</div>
						
					</div>  <!-- Fin Segunda línea cuadrante 2 -->
				</div> <!-- Fin Cuadrante 2 -->
			</div> <!-- Fin Primer y Segundo cuadrante -->

<!-- ############################################################################################################################-->				
			<div class="col-sm-12" style="margin-bottom:30px;"> <!-- Inicio del 3er y 4to cuadrante -->
				<div class="col-sm-6" style="padding-top:20px;padding-bottom:20px; border-right: 1px solid #000;"> <!-- Cuadrante 4 -->
					<div class="col-sm-12" style="margin-bottom: 20px;"><!-- Primera línea cuadrante 4 -->
						
						<div class="col-sm-1 pull-right text-center num" id="c4pl1" est='0' diente="41">1</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl2" est='0' diente="42">2</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl3" est='0' diente="43">3</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl4" est='0' diente="44">4</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl5" est='0' diente="45">5</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl6" est='0' diente="46">6</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl7" est='0' diente="47">7</div>
						<div class="col-sm-1 pull-right text-center num" id="c4pl8" est='0' diente="48">8</div>
						<div class="clearfix"></div>

						<div class="col-sm-1 col no-padding c4pl1d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl2d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl3d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl4d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl5d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl6d pull-right ">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl7d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c4pl8d pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
					</div><!-- Fin Primera línea cuadrante 3 -->

					<div class="col-sm-12">	<!-- Segunda línea cuadrante 4 -->					
						<div class="col-sm-1 col no-padding c4slad pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c4slbd pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c4slcd pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c4sldd pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>

						<div class="col-sm-1 col no-padding c4sled pull-right">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 pull-right text-center num" id="c4sla" est='0' diente="81">A</div>
						<div class="col-sm-1 pull-right text-center num" id="c4slb" est='0' diente="82">B</div>
						<div class="col-sm-1 pull-right text-center num" id="c4slc" est='0' diente="83">C</div>
						<div class="col-sm-1 pull-right text-center num" id="c4sld" est='0' diente="84">D</div>
						<div class="col-sm-1 pull-right text-center num" id="c4sle" est='0' diente="85">E</div>
						
					</div><!-- Fin Segunda línea cuadrante 4 -->

				</div> <!-- Fin cuadrante 4 -->

				<div class="col-sm-6" style="padding-top:20px;padding-bottom:20px;"> <!-- Cuadrante 3 -->
					<div class="col-sm-12"  style="margin-bottom: 20px;"><!-- Primera línea cuadrante 3 -->
						<div class="col-sm-1 text-center num" id="c3pl1" est='0' diente="31">1</div>
						<div class="col-sm-1 text-center num" id="c3pl2" est='0' diente="32">2</div>
						<div class="col-sm-1 text-center num" id="c3pl3" est='0' diente="33">3</div>
						<div class="col-sm-1 text-center num" id="c3pl4" est='0' diente="34">4</div>
						<div class="col-sm-1 text-center num" id="c3pl5" est='0' diente="35">5</div>
						<div class="col-sm-1 text-center num" id="c3pl6" est='0' diente="36">6</div>
						<div class="col-sm-1 text-center num" id="c3pl7" est='0' diente="37">7</div>
						<div class="col-sm-1 text-center num" id="c3pl8" est='0' diente="38">8</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 col no-padding c3pl1d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl2d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl3d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl4d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl5d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl6d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl7d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3pl8d">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
						</div>
						<div class="col-sm-4"></div>
					</div> <!-- Fin Primera línea cuadrante 3 -->
					<div class="col-sm-12"><!-- Segunda línea cuadrante 3 -->
						<div class="col-sm-1 col no-padding c3slad">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3slbd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3slcd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3sldd">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="col-sm-1 col no-padding c3sled">
							<div class="col-sm-12 diente" parte="V"></div>
							<div class="col-sm-4 diente" parte="D"></div>
							<div class="col-sm-4 diente" parte="O"></div>
							<div class="col-sm-4 diente" parte="M"></div>
							<div class="col-sm-12 diente" parte="P"></div>
							<div class="ausencia"></div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-1 text-center num" id="c3sla" est='0' diente="71">A</div>
						<div class="col-sm-1 text-center num" id="c3slb" est='0' diente="72">B</div>
						<div class="col-sm-1 text-center num" id="c3slc" est='0' diente="73">C</div>
						<div class="col-sm-1 text-center num" id="c3sld" est='0' diente="74">D</div>
						<div class="col-sm-1 text-center num" id="c3sle" est='0' diente="75">E</div>
					</div> <!-- Fin segunda línea cuadrante 3 -->
				</div> <!-- Fin cuadrante 3 -->
			</div> <!-- Fin del 3er y 4to cuadrante -->