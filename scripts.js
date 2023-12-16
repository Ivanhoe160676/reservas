$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true
    });
});

$(document).ready(function(){
    $('#calendario').fullCalendar({
        events: 'procesar_reserva.php', // Esta línea cambia
        // Otras configuraciones...
    });
});





