$(function(){
	/**
	 * Click en la clase .numeros
	 * @return {[type]} [description]
	 */
	$('.numeros').on('click',function(){
		var numero      = $(this).text().trim();
		var clase       = '.T';
		var diagnostico = $('#diagnostico-value').val();
		var fin         = numero;
		var paciente    = $('#cedrif-paciente').val();
		var tipo 				= $('#otrolugar').val();
		var datos       = 'numero='+numero+'&clase='+clase+'&diagnostico='+diagnostico+'&fin='+fin+'&paciente='+paciente+'&tipo='+tipo;
		if(diagnostico!="") {
			if($('#multiples-diagnos').is(':checked')) {
				alert('Para selección multiple, indique las piezas en la parte superior y presione el botón "Ok"')
			} else {				
				$.post('app/odonto/procesos/p.insert.diagnostico.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif='+paciente,'#odontoinsert');
						load('app/odonto/vistas/marcar.diagnostico.php','cedrif='+paciente,'.marcar-diagnostico')
					} else {
						alert(data);
					}
				})
			}
		} else {
			alert('Debe seleccionar un diagnóstico');
		}
	})

	$('.T').on('click',function(){
		var numerosplit  = $(this).parent().attr('class').split(' ');
		var numerosplit2 = numerosplit[1].split('-');
		var numero       = numerosplit2[1];
		var diagnostico  = $('#diagnostico-value').val();
		var clasesplit   = $(this).attr('class').split(' ');
		var clase        = '.'+clasesplit[0];
		var fin          = numero;
		var paciente     = $('#cedrif-paciente').val();
		var tipo 				= $('#otrolugar').val();
		var datos        = 'numero='+numero+'&clase='+clase+'&diagnostico='+diagnostico+'&fin='+fin+'&paciente='+paciente+'&tipo='+tipo;
		if(diagnostico!="") {
			if($('#multiples-diagnos').is(':checked')) {
				alert('Para selección multiple, indique las piezas en la parte superior y presione el botón "Ok"')
			} else {				
				$.post('app/odonto/procesos/p.insert.diagnostico.php',datos,function(data){
					if(data==1) {
						load('app/odonto/vistas/odonto.insert.php','cedrif='+paciente,'#odontoinsert');
						load('app/odonto/vistas/marcar.diagnostico.php','cedrif='+paciente,'.marcar-diagnostico')
					} else {
						alert(data);
					}
				})
			}
		} else {
			alert('Debe seleccionar un diagnóstico');
		};
	})
})

function limites(valor) {
	if(valor>10 && valor<19) {
		var limite = 11;
	} else if (valor>20 && valor<29) {
		var limite = 21;
	} else if (valor>30 && valor<39) {
		var limite = 31;
	} else if (valor>40 && valor<49) {
		var limite = 41;
	} else if (valor>50 && valor<56) {
		var limite = 51;
	} else if (valor>60 && valor<66) {
		var limite = 61;
	} else if (valor>70 && valor<76) {
		var limite = 71;
	} else {
		var limite = 81;
	}
	return limite;
}


function crearOdontograma(data) {
	for(f=0; f<data.length;f++) {
		var inicio = data[f].diagcons_numero;
		var fin    = data[f].diagcons_fin;
		var cuadrante1substr = inicio.toString().substr(0,1);
		var cuadrante1int = parseInt(cuadrante1substr);
		var cuadrante1 = (cuadrante1int>=5) ? cuadrante1int-4 : cuadrante1int
		var cuadrante2substr = fin.toString().substr(0,1);
		var cuadrante2int = parseInt(cuadrante2substr);
		var cuadrante2 = (cuadrante2int>=5) ? cuadrante2int-4 : cuadrante2int
		var limite1 = limites(inicio);
		var limite2 = limites(fin);
		if(inicio!=fin) {
			if(limite1==limite2) {
				if(limite1==11 || limite1==51 || limite1==81 || limite1==41) {
					for(i = inicio; i >= fin; i--) {
						var cu     = '.cuadrante'+cuadrante1;
						var c1     = data[f].diagno_clase1;
						var pi     = '.c-'+i;
						var c2     = data[f].diagno_clase2;
						var c3     = data[f].diagno_clase3;
						var c4 		 = data[f].diagcons_clase; // parte del diente
						var clase  = cu+' '+c1+' '+pi+ ' '+c2; 
						var clase2 = cu+' '+pi+ ' .diagcua';
						var clase3 = cu+' .diente '+pi+' '+c4;  
						var color  = data[f].diagno_color;
						var texto   = (data[f].diagno_texto==null) ? '' : data[f].diagno_texto;
						$(clase).addClass(c3);
						$(clase2).text(texto);
						$(clase3).css('background',color);
					}
				} else {
					for(i = inicio; i <= fin; i++) {
						var cu     = '.cuadrante'+cuadrante1;
						var c1     = data[f].diagno_clase1;
						var pi     = '.c-'+i;
						var c2     = data[f].diagno_clase2;
						var c3     = data[f].diagno_clase3;
						var c4 		 = data[f].diagcons_clase; // parte del diente
						var clase  = cu+' '+c1+' '+pi+ ' '+c2; 
						var clase2 = cu+' '+pi+ ' .diagcua';
						var clase3 = cu+' .diente '+pi+' '+c4; 
						var color  = data[f].diagno_color;
						var texto  = (data[f].diagno_texto==null) ? '' : data[f].diagno_texto;
						$(clase).addClass(c3);
						$(clase2).text(texto);
						$(clase3).css('background',color);
					}
				}
			} else {
				for(i = inicio; i >= limite1; i--) {
					var cu     = '.cuadrante'+cuadrante1;
					var c1     = data[f].diagno_clase1;
					var pi     = '.c-'+i;
					var c2     = data[f].diagno_clase2;
					var c3     = data[f].diagno_clase3;
					var c4 		 = data[f].diagcons_clase; // parte del diente
					var clase  = cu+' '+c1+' '+pi+ ' '+c2; 
					var clase2 = cu+' '+pi+ ' .diagcua';
					var clase3 = cu+' .diente '+pi+' '+c4; 
					var color  = data[f].diagno_color;
					var texto  = (data[f].diagno_texto==null) ? '' : data[f].diagno_texto;
					$(clase).addClass(c3);
					$(clase2).text(texto);
					$(clase3).css('background',color);
				}
				for(j = fin; j >= limite2; j--) {
					var cu     = '.cuadrante'+cuadrante2;
					var c1     = data[f].diagno_clase1;
					var pi     = '.c-'+j;
					var c2     = data[f].diagno_clase2;
					var c3     = data[f].diagno_clase3;
					var c4 		 = data[f].diagcons_clase; // parte del diente
					var clase  = cu+' '+c1+' '+pi+ ' '+c2; 
					var clase2 = cu+' '+pi+ ' .diagcua';
					var clase3 = cu+' .diente '+pi+' '+c4; 
					var color  = data[f].diagno_color;
					var texto  = (data[f].diagno_texto==null) ? '' : data[f].diagno_texto;
					$(clase).addClass(c3);
					$(clase2).text(texto);
					$(clase3).css('background',color);
				}
			}
		} else {
			var cu     = '.cuadrante'+cuadrante1; // cuadrante
			var c1     = data[f].diagno_clase1; // .diente
			var pi     = '.c-'+inicio; // c-
			var c2     = data[f].diagno_clase2; //.diag,.diagnum,.diagcua,.diag-muela
			var c3     = data[f].diagno_clase3; // llamar a la clase css
			var c4 		 = data[f].diagcons_clase; // parte del diente
			var clase  = cu+' '+c1+' '+pi+ ' '+c2; 
			var clase2 = cu+' '+pi+ ' .diagcua';
			var clase3 = cu+' .diente '+pi+' '+c4; 
			var color  = data[f].diagno_color;
			var texto  = (data[f].diagno_texto==null) ? '' : data[f].diagno_texto;
			$(clase).addClass(c3);
			$(clase2).text(texto);
			$(clase3).css('background',color);
		}
	}
}