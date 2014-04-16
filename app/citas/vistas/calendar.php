<?php 
require '../../../cfg/base.php';
$citas = $mcitas->citasSelect();
if (isset($_POST['gotodate']) and $_POST['gotodate']==1) {
	$anio = $_POST['anio'];
	$mes = $_POST['mes']-1;
	$dia = $_POST['diaa'];
} else {
	$anio = date('Y');
	$mes = date('m')-1;
	$dia = date('d');
}
?>
<script>
	$(function(){
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();

		var calendar = $('#calendar').fullCalendar({
				defaultView: 'agendaWeek',
			 	buttonText: {
				prev: '<i class="icon-chevron-left"></i>',
				next: '<i class="icon-chevron-right"></i>'
			},
		
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay',
			},
			events: [
			<?php if(count($citas)>0) ?>
			<?php foreach($citas as $c) { ?>
				{
					title: '<?php echo $c->pacien_nomraz ?>',
					start: '<?php echo $c->citas_hen ?>',
					end: '<?php echo $c->citas_hsa ?>',
					className: '<?php echo strtolower($c->citas_eti) ?>',
					ide : <?php echo $c->citas_ide ?>,
					allDay: <?php echo strtolower($c->citas_dia) ?>
				},
			<?php } ?>
			]
			,
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar !!!
			drop: function(date, allDay) { // this function is called when something is dropped
				// retrieve the dropped element's stored Event Object

				var originalEventObject = $(this).data('eventObject');
				var $extraEventClass = $(this).attr('data-class');
				
				
				// we need to copy it, so that multiple events don't have a reference to the same object
				var copiedEventObject = $.extend({}, originalEventObject);
				
				// assign it the date that was reported
				copiedEventObject.start = date;
				copiedEventObject.allDay = allDay;
				if($extraEventClass) copiedEventObject['className'] = [$extraEventClass];
				
				// render the event on the calendar
				// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}				
			}
			,
			selectable: true,
			selectHelper: true,
			select: function(start, end, allDay) {
				fechas = 'inicio='+start+'&fin='+end+'&dia='+allDay;
				modal('app/citas/vistas/cita.insert.php',fechas);
			}
			,
			eventClick: function(calEvent, jsEvent, view) {
				datos = 'titulo='+calEvent.title+'&inicio='+calEvent.start+'&fin='+calEvent.end+'&citas_ide='+calEvent.ide
				modal('app/citas/vistas/cita.info.php',datos);
			},
			//event,dayDelta,minuteDelta,allDay,revertFunc
			eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
        if(confirm('¿Mover la cita?')==true) {
        	datos = 'inicio='+event.start+'&fin='+event.end+'&dia='+allDay+'&citas_ide='+event.ide;
        	$.post('app/citas/procesos/p.cita.update.php',datos,function(data){
        		if(data==1) {
        			load('app/citas/vistas/calendar.php','','#calendar')
        		} else {
        			alert(data)
        			load('app/citas/vistas/calendar.php','','#calendar')
        		}
        	})
        }
    	},
    	eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
      	if(confirm('¿Cambiar la duración de la cita?')==true) {
        	datos = 'inicio='+event.start+'&fin='+event.end+'&dia=false&citas_ide='+event.ide;
        	$.post('app/citas/procesos/p.cita.update.php',datos,function(data){
        		if(data==1) {
        			load('app/citas/vistas/calendar.php','','#calendar')
        		} else {
        			alert(data)
        			load('app/citas/vistas/calendar.php','','#calendar')
        		}
        	})
        }
    	},

		});
		$('#calendar').fullCalendar('gotoDate',<?php echo $anio ?>,<?php echo $mes ?>,<?php echo $dia ?>)
	})
</script>