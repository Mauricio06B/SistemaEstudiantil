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
            include("../modelos/usuarios.php");
            $usu = new usuarios();
            $usu->setRol(2);
            $listaUsuarios = $usu->listarPorRol();

            $asig = new asignatura();
            $listadoAsignaturas = $asig->consultarTodas();
            $listadoAsignaturasSinDocente = $asig->consultarTodasSinDocente();
            ?>
        </div>

        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <?php if (isset($_GET['mensaje'])) { ?>
                        <div class="alert alert-warning"><?php echo $_GET['mensaje']; ?></div>
                    <?php } ?>
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Listado de asignaciones</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Crear asignatura</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="table-responsive bg-white">
                                <?php if (count($listadoAsignaturas) > 0) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Código</th>
                                                <th class="text-center">Nombre</th>
                                                <th class="text-center">Aula</th>
                                                <th class="text-center">Departamento</th>
                                                <th class="text-center">Año</th>
                                                <th class="text-center">Periodo</th>
                                                <th class="text-center">Docente</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($listadoAsignaturas as $asignatura) { ?>
                                                <?php
                                                $codigo = $asignatura['codigo'];
                                                $nombre = $asignatura['nombre_asignatura'];
                                                $aula = $asignatura['aula_asignatura'];
                                                $departamento = $asignatura['departamento_asignatura'];
                                                $anio = ($asignatura['anio']);
                                                $periodo = ($asignatura['periodo']);
                                                $docente = ($asignatura['nombre_usuario'] != "") ? $asignatura['nombre_usuario'] : "Sin docente";
                                                $color = ($asignatura['nombre_usuario'] != "") ? "" : "text-danger";
                                                ?>
                                                <tr>
                                                    <td><?php echo $codigo ?></td>
                                                    <td><?php echo $nombre ?></td>
                                                    <td><?php echo $aula ?></td>
                                                    <td><?php echo $departamento ?></td>
                                                    <td class="text-end"><?php echo $anio ?></td>
                                                    <td class="text-end"><?php echo $periodo ?></td>
                                                    <td class="<?php echo $color; ?>"><?php echo $docente ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } else { ?>
                                    <div class="alert alert-warning">No hay asignaturas.</div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Crear asignatura</h5>
                                </div>

                                <div class="card-body">
                                    <form class="row" id="f_crear_asignatura" action="registroAsignatura.php" method="POST">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                    <label class="">Código</label>
                                                    <input class="form-control " value="" id="codigo" name="codigo">
                                                </div>


                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                    <label class="">Nombre</label>
                                                    <input class="form-control " value="" id="nombre" name="nombre">
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                    <label class="">Aula</label>
                                                    <input class="form-control " value="" id="aula" name="aula">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                <label class="">Departamento</label>
                                                <input class="form-control " value="" id="departamento" name="departamento">
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                <label class="">Año</label>
                                                <select class="form-control" name="anio">
                                                    <?php for ($i = date('Y'); $i >= 1950; $i--) { ?>
                                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                <label class="">Periodo</label>
                                                <select class="form-control" name="periodo">
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                            <button class="btn btn-primary form-control">Crear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">&nbsp;</div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
                <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            <h2>Asignar docente</h2>
                        </div>

                        <div class="card-body">
                            <form class="row" id="f_form_asignar_docente" action="asignarDocenteAsignatura.php" method="POST">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4 mb-3">
                                    <div class="form-group">
                                        <label>Asignatura</label>
                                        <select class="form-control" name="asignatura">
                                            <?php foreach ($listadoAsignaturasSinDocente as $asignatura) { ?>
                                                <option value="<?php echo $asignatura['id']; ?>"><?php echo $asignatura['nombre_asignatura']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5 mb-3">
                                    <div class="form-group">
                                        <label>Docente</label>
                                        <select class="form-control" name="docente">
                                            <?php foreach ($listaUsuarios as $usuario) { ?>
                                                <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre_completo']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 col-xl-3 mb-3">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-success form-control">Asignar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>