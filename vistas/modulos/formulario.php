<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Crear Reserva</h3>
                        </div>
                        <div class="card-body">
                            <form id="reservaForm" method="POST" action="">
                                <div class="form-group">
                                    <label for="nombreCliente">Nombre del Cliente:</label>
                                    <input type="text" class="form-control" id="nombreCliente" name="nombreCliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="telfCliente">Teléfono de Contacto:</label>
                                    <input type="text" class="form-control" id="telfCliente" name="telfCliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="asistentes">Número de Asistentes:</label>
                                    <input type="number" class="form-control" id="asistentes" name="asistentes" min="1" max="80" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipo">Tipo de Evento:</label>
                                    <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" name="tipo" id="tipo" required>
                                        <option selected="selected">Seleccionar...</option>
                                        <option>Almuerzo</option>
                                        <option>Bautizo</option>
                                        <option>Cena</option>
                                        <option>Cumpleaños</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="fechaReserva">Fecha y Hora de la Reserva:</label>
                                    <input type="datetime-local" class="form-control" id="fechaReserva" name="fechaReserva" required>
                                </div>
                                <div class="form-group">
                                    <label for="tituloEvento">Título del Evento:</label>
                                    <input type="text" class="form-control" id="tituloEvento" name="tituloEvento" required>
                                </div>
                                <button type="submit" name="submitReserva" class="btn btn-primary">Crear Reserva</button>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Eventos Rápidos</h4>
                        </div>
                        <div class="card-body">
                            <!-- the events -->
                            <div id="external-events">
                                <div class="external-event bg-success">Cumpleaños</div>
                                <div class="external-event bg-warning">Almuerzo</div>
                                <div class="external-event bg-info">Cena</div>
                                <div class="external-event bg-primary">Fiesta</div>
                                <div class="external-event bg-danger">Partidos</div>
                                <div class="checkbox">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        Retirar después de colocar
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Crear Evento</h3>
                        </div>
                        <div class="card-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                </ul>
                            </div>
                            <!-- /btn-group -->
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Título del Evento">

                                <div class="input-group-append">
                                    <button id="add-new-event" type="button" class="btn btn-primary">Agregar</button>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary">
                    <div class="card-body p-0">
                        <!-- THE CALENDAR -->
                        <div id="calendar"></div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
