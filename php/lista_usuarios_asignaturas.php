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
            include("../modelos/usuario_asignatura.php");
            $usu = new usuarios();
            $usu->setRol(1);
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
                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 bg-white py-3">
                    <div class="card">
                        <div class="card-header">
                            <h2>Asignar materia a estudiante</h2>
                        </div>
                        <div class="card-body">
                            <form id="form_usuarios_asignaturas" class="row" action="registroUsuarioAsignatura.php" method="POST">
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label class="-label">Usuario</label>
                                    <select class="form-control" name="id_usuario">
                                        <?php foreach ($listaUsuarios as $usuario) { ?>
                                            <option value="<?php echo $usuario['id']; ?>"><?php echo $usuario['nombre_completo']; ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label>Asignatura</label>
                                    <select class="form-control" name="id_asignatura">
                                        <?php foreach ($listadoAsignaturas as $asignatura) { ?>
                                            <option value="<?php echo $asignatura['id']; ?>"><?php echo $asignatura['nombre_asignatura']; ?></option>
                                        <?php  } ?>
                                    </select>
                                </div>
                                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                    <label>&nbsp;</label>
                                    <button class="btn btn-success form-control">Asignar</button>
                                </div>
                            </form>

                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 mt-3">
                                    <?php if (count($_GET) > 0) { ?>
                                        <?php $alert = isset($_GET['mensaje']) ? "danger" : "success"; ?>
                                        <?php $mensaje = isset($_GET['mensaje']) ? $_GET['mensaje'] : $_GET['correcto']; ?>
                                        <div class="alert alert-<?php echo $alert; ?>"><?php echo $mensaje; ?></div>
                                    <?php } ?>
                                </div>
                            </div>
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
                            $usu_asig = new usuario_asignatura();
                            $usu_asig->setIdAsignatura($asigna['id']);
                            $listaUsuariosAsignatura = $usu_asig->listarUsuariosPorAsignatura();
                            ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse<?php echo $cant; ?>" aria-expanded="false" aria-controls="panelsStayOpen-collapse<?php echo $cant; ?>">
                                        <?php echo $asigna['nombre_asignatura'] ?>
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapse<?php echo $cant; ?>" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <?php if (count($listaUsuariosAsignatura) > 0) { ?>
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Usuario</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($listaUsuariosAsignatura as $usuario_asig) { ?>
                                                            <tr>
                                                                <td><?php echo $usuario_asig['nombre_completo']; ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } else { ?>
                                            <div class="alert alert-warning"> No hay estudiantes en esta asignatura </div>
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