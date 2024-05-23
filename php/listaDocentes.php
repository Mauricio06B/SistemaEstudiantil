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
            include("../modelos/usuarios.php");
            $usua = new usuarios();
            $usua->setRol(2);
            $listadoDocentes = $usua->listarPorRol();
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
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Listado docentes</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Crear docente</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="table-responsive bg-white">
                                <?php if (count($listadoDocentes) > 0) { ?>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Usuario</th>
                                                <th>Nombre completo</th>
                                                <th>Correo institucional</th>
                                                <th>Teléfono</th>
                                                <th>Tipo documento</th>
                                                <th>Número documento</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($listadoDocentes as $docente) { ?>
                                                <?php
                                                $nombre = $docente['nombre_completo'];
                                                $usuario = $docente['usuario'];
                                                $correo = $docente['correo_institucional'];
                                                $tel = $docente['telefono'];
                                                $tipo_documento = ($docente['tipo_documento']) == 1 ? "Tarjeta de identidad" : (($docente['tipo_documento'] == 2 ? "Cédula de ciudadanía" : "Cédula de extranjería"));
                                                $tipo_documento = ($docente['tipo_documento']) == 1 ? "Tarjeta de identidad" : (($docente['tipo_documento'] == 2 ? "Cédula de ciudadanía" : "Cédula de extranjería"));
                                                $numero_documento = ($docente['numero_documento']);
                                                ?>

                                                <tr>
                                                    <td><?php echo $usuario ?></td>
                                                    <td><?php echo $nombre ?></td>
                                                    <td><?php echo $correo ?></td>
                                                    <td><?php echo $tel ?></td>
                                                    <td><?php echo $tipo_documento ?></td>
                                                    <td><?php echo $numero_documento ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                <?php } else { ?>
                                    <div class="alert alert-warning">No hay docentes</div>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="text-center">Crear docente</h5>
                                </div>

                                <div class="card-body">
                                    <form class="row" id="f_crear_docente" action="registroDocente.php" method="POST">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                    <label class="">Usuario</label>
                                                    <input class="form-control " value="" id="docente_usuario" name="docente_usuario">
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                    <label class="">Nombre</label>
                                                    <input class="form-control " value="" id="docente_nombre" name="docente_nombre">
                                                </div>

                                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                    <label class="">Correo institucional</label>
                                                    <input class="form-control " value="" id="docente_correo" name="docente_correo">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mb-3">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                <label class="">Tipo documento</label>
                                                <select class="form-control" id="docente_tipo_documento" name="docente_tipo_documento">
                                                    <option value="1">Tarjeta de identidad</option>
                                                    <option value="2">Cédula de ciudadanía</option>
                                                    <option value="3">Cédula de extranjería</option>
                                                </select>
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3">
                                                <label class="">Documento</label>
                                                <input class="form-control " value="" id="docente_documento" name="docente_documento" type="number">
                                            </div>

                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label class="">Teléfono</label>
                                                <input class="form-control " value="" id="docente_telefono" name="docente_telefono">
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
    </div>
</body>
</html>