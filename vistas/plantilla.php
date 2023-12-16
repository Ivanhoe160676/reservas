<?php
require_once "modelos/database.php";
require_once "modelos/reservas.php";

$conexionBD = new ConexionBD();
$bd = $conexionBD->getConexion();
$reservas = new Reservas($bd);

$alertType = '';
$alertMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreCliente = isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : null;
    $telfCliente = isset($_POST['telfCliente']) ? $_POST['telfCliente'] : null;
    $asistentes = isset($_POST['asistentes']) ? $_POST['asistentes'] : null;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;
    $fechaReserva = isset($_POST['fechaReserva']) ? $_POST['fechaReserva'] : null;
    $tituloEvento = isset($_POST['tituloEvento']) ? $_POST['tituloEvento'] : null;

    if ($reservas->crearReserva($nombreCliente, $telfCliente, $asistentes, $tipo, $fechaReserva, $tituloEvento)) {
        $alertType = 'success';
        $alertMessage = 'Reserva creada exitosamente.';
    } else {
        $alertType = 'error';
        $alertMessage = 'Error al crear la reserva. Inténtalo de nuevo.';
    }
}

$reservasList = $reservas->obtenerReservas();
?>

<!DOCTYPE html>
<html lang="en">

<?php include "modulos/head.php"; ?>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include "modulos/navbar.php"; ?>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <?php include "modulos/sidebar.php"; ?>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include "modulos/header.php"; ?>
            <!-- Main content -->
            <?php include "modulos/formulario.php"; ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php include "modulos/footer.php"; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script src="vistas/plugins/jquery/jquery.min.js"></script>
    <script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vistas/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="vistas/dist/js/adminlte.min.js"></script>
    <script src="vistas/plugins/fullcalendar/locales-all.min.js"></script>
    <script src="vistas/plugins/moment/moment.min.js"></script>

    <script>
        $(function() {
            function ini_events(ele) {
                ele.each(function() {
                    var eventObject = {
                        title: $.trim($(this).text())
                    }
                    $(this).data('eventObject', eventObject)

                    $(this).draggable({
                        zIndex: 1070,
                        revert: true,
                        revertDuration: 0
                    })
                })
            }

            ini_events($('#external-events div.external-event'))

            var date = new Date()
            var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear()

            var Calendar = FullCalendar.Calendar;
            var Draggable = FullCalendar.Draggable;

            var containerEl = document.getElementById('external-events');
            var checkbox = document.getElementById('drop-remove');
            var calendarEl = document.getElementById('calendar');

            new Draggable(containerEl, {
                itemSelector: '.external-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText,
                        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
                        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color'),
                    };
                }
            });

            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                locale: 'es',
                editable: true,
                droppable: true,
                drop: function(info) {
                    if (checkbox.checked) {
                        info.draggedEl.parentNode.removeChild(info.draggedEl);
                    }
                }
            });

            calendar.render();

            var currColor = '#3c8dbc';

            $('#color-chooser > li > a').click(function(e) {
                e.preventDefault()
                currColor = $(this).css('color')
                $('#add-new-event').css({
                    'background-color': currColor,
                    'border-color': currColor
                })
            })

            $('#add-new-event').click(function(e) {
                e.preventDefault()
                var val = $('#new-event').val()
                if (val.length == 0) {
                    return
                }

                var event = $('<div />')
                event.css({
                    'background-color': currColor,
                    'border-color': currColor,
                    'color': '#fff'
                }).addClass('external-event')
                event.text(val)
                $('#external-events').prepend(event)

                ini_events(event)

                $('#new-event').val('')
            })

            $('#reservaForm').submit(function(event) {
                event.preventDefault();

                var tituloEvento = $('#tituloEvento').val();
                var fechaReserva = $('#fechaReserva').val();

                $.ajax({
                    type: 'POST',
                    url: 'vistas/guardar_evento.php',
                    data: {
                        tituloEvento: tituloEvento,
                        fechaReserva: fechaReserva
                    },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Reserva creada exitosamente.',
                                showConfirmButton: true,
                                timer: 1500
                            });

                            calendar.refetchEvents();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al crear la reserva. Inténtalo de nuevo más tarde.',
                                showConfirmButton: true,
                                timer: 1500
                            });
                        }
                    },
                    error: function(error) {
                        console.error('Error al guardar el evento:', error);
                    }
                });

                $('#reservaForm')[0].reset();
            });
        })
    </script>

</body>

</html>