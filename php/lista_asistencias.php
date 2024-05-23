<?php
include("sesionActiva.php");

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include('encabezado.php');
    include("../librerias/phpqrcode/qrlib.php");
    ?>
</head>

<body class="">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <?php
            include("barraLateral.php");
            include("../modelos/usuario_asignatura.php");
            include("../modelos/asistencia.php");
            include("../modelos/usuarios.php");

            $codigoAsig = isset($_GET['asig']) ? $_GET['asig'] : NULL;
            $listaAsistencias = array();
            if ($codigoAsig != NULL) {
                $asig  = new usuario_asignatura();
                $asig->setIdAsignatura($codigoAsig);
                $listaClases = $asig->listarClasesAsignatura();

                $usuario = new usuario_asignatura();
                $usuario->setIdAsignatura($codigoAsig);
                $listaUsuarios = $usuario->listarUsuariosPorAsignatura();

                $asistencia = new asistencia();
            }
            ?>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
            <div class="row">
                <div class="col-xs-11 col-sm-11 col-md-11 col-lg-11 col-xl-11">
                    <?php if ($codigoAsig != NULL) { ?>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Usuario</th>
                                        <?php $cant = 1; ?>
                                        <?php foreach ($listaClases as $clase) { ?>
                                            <th class="text-center"><?php echo "clase " . $cant . " / " . $clase['fecha']; ?></th>
                                        <?php $cant++;
                                        } ?>
                                    </tr>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($listaUsuarios as $usuario) { ?>
                                        <tr>
                                            <td><?php echo $usuario['nombre_completo'] ?></td>
                                            <?php $cant = 1; ?>
                                            <?php foreach ($listaClases as $clase) { ?>
                                                <?php 
                                                    $asistencia->setIdUsuario($usuario['id_usuario']);
                                                    $asistencia->setIdClase($clase['id_clase']);
                                                    $asistencia_usuario = $asistencia->listar_asistencias_usuario_clase();
                                                    $texto = empty($asistencia_usuario) ? "<i class='bi bi-calendar-x text-danger'></i>" : "<i class='bi bi-calendar-check text-success'></i>";
                                                ?>
                                                <th class="text-center"><?php echo $texto; ?></th>
                                            <?php $cant++;
                                            } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    <?php } else { ?>

                    <?php }  ?>
                </div>

            </div>
        </div>
    </div>
</body>