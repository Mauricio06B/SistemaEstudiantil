<?php include("sesionActiva.php") ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include('encabezado.php');
    ?>
</head>

<body class="Body1">
    <div class="row">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <?php
            include("barraLateral.php");
            include("../modelos/asignatura.php");
            include("../modelos/clase.php");
            
            $asig = new asignatura();
            $listadoAsignaturas = $asig->consultarTodas();
            ?>
        </div>

        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 bg-white py-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Agendar nueva clase</h2>
                        </div>
                        <div class="card-body">
                            <form id="form_clases" class="row" action="registroClase.php" method="POST">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label class="-label">Asignatura</label>
                                    <select class="form-control" name="id_asignatura">
                                        <?php foreach ($listadoAsignaturas as $asig) { ?>
                                            <option value="<?php echo $asig['id']; ?>"><?php echo $asig['nombre_asignatura']; ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label>Fecha</label>
                                    <input class="form-control" type="date" value="" name="fecha">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label>Hora</label>
                                    <input class="form-control" type="time" value="" name="hora">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-2 col-xl-2">
                                    <label>Aula</label>
                                    <input class="form-control" type="text" value="" name="aula">
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-success form-control">Agendar</button>
                                </div>
                            </form>
                            <?php if(isset($_GET['mensaje']) || isset($_GET['correcto'])) { ?>
                                <div class="row">
                                    <?php $alert =  isset($_GET['mensaje']) ? "danger" : "success"; ?>
                                    <?php $mensaje =  isset($_GET['mensaje']) ? $_GET['mensaje'] : $_GET['correcto']; ?>
                                    <div class="alert alert-<?php echo $alert; ?>"><?php echo $mensaje; ?></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 bg-white py-3">
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <?php $cant = 1; ?>
                        <?php foreach ($listadoAsignaturas as $asigna) { ?>
                            <?php
                            $clase = new clase();
                            $clase->setIdAsignatura($asigna['id']);
                            $listaClasesAsignatura = $clase->listarClasesAsignatura();
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $cant; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $cant; ?>">
                                        <?php echo $asigna['nombre_asignatura']?>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse<?php echo $cant; ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <?php if (count($listaClasesAsignatura) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha</th>
                                                            <th>Estado</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $cont = 1; ?>
                                                        <?php foreach ($listaClasesAsignatura as $clase) { ?>
                                                            <?php $estado = ($clase['fecha'] == date('Y-m-d')) ? "Activa" : "Inactiva" ?>
                                                            <tr>
                                                                <td><?php echo $cont++; ?></td>
                                                                <td><?php echo $clase['fecha']; ?></td>
                                                                <td><?php echo $estado; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>   
                                            <div class="alert alert-warning"> No hay clases para esta asignatura </div>
                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <?php $cant++; ?>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
</body>