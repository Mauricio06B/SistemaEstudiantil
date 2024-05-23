<?php
include('sesionActiva.php');
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

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
            <?php
            include("barraLateral.php");
            include("../modelos/usuario_asignatura.php");
            ?>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xl-10">
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 2) { ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">&nbsp;</div>
                    <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1 col-xl-1">&nbsp;</div>
                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="text-center">Mis materias</h5>
                            </div>
                            <div class="card-body">
                                <?php if (!isset($_GET['codigo'])) { ?>
                                    <?php
                                    $usuario_asignatura = new usuario_asignatura();
                                    $usuario_asignatura->setIdUsuario($_SESSION['id']);
                                    $listaDeAsignaturas = $usuario_asignatura->listarPorUsuario();
                                    ?>

                                    <div class="row">
                                        <div class="col-4">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <?php $conteo = 1; ?>
                                                <?php foreach ($listaDeAsignaturas as $asignatura) { ?>
                                                    <?php $nombre = $asignatura['nombre_asignatura']; ?>
                                                    <?php $active = $conteo == 1 ? "active" : ""; ?>
                                                    <a class="list-group-item list-group-item-action <?php echo $active; ?>" id="list-<?php echo $conteo; ?>-list" data-bs-toggle="list" href="#list-<?php echo $conteo; ?>" role="tab" aria-controls="list-<?php echo $conteo++; ?>"><?php echo $nombre; ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="col-8">
                                            <div class="tab-content" id="nav-tabContent">
                                                <?php $conteo = 1; ?>
                                                <?php foreach ($listaDeAsignaturas as $asignatura) { ?>
                                                    <?php
                                                    $nombre = $asignatura['nombre_asignatura'];
                                                    $active = $conteo == 1 ? "show active" : "";
                                                    $asig2  = new usuario_asignatura();
                                                    $asig2->setIdAsignatura($asignatura['id']);
                                                    $listaClases = $asig2->listarClasesAsignatura();
                                                    ?>
                                                    <div class="tab-pane fade <?php echo $active; ?>" id="list-<?php echo $conteo; ?>" role="tabpanel" aria-labelledby="list-<?php echo $conteo++; ?>-list">
                                                        <div class="row mb-3">
                                                            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                <?php if (count($listaClases) > 0) { ?>
                                                                    <a class="btn btn-primary form-control" target="_blank" href="lista_asistencias.php?asig=<?php echo $asignatura['id']; ?>">Ver asistencias</a>
                                                                <?php } else { ?>
                                                                    <a class="btn btn-danger form-control" href="#">No hay clases</a>
                                                                <?php } ?>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <?php $numeroClase = 1; ?>
                                                            <?php foreach ($listaClases as $clase) { ?>
                                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Clase #<?php echo $numeroClase++; ?></h5>
                                                                            <p class="card-text">Fecha: <?php echo $clase['fecha']; ?></p>
                                                                            <div>
                                                                                <?php if ($clase['estado'] == 1) {
                                                                                    echo generarQr($clase['id_clase'], $clase['id']);
                                                                                } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning">No tienes permiso para ingresar a este módulo.</div>
            <?php } ?>
        </div>

    </div>
    </div>
    </div>
</body>

</html>

<?php

function generarQr($codigoClase, $codigoAsig)
{

    // Texto o URL que deseas codificar en el QR
    $texto = "https://gestionacademicawilly.000webhostapp.com/php/clase_asistencias.php?clase_id=" . $codigoClase . "&a=" . $codigoAsig;

    // Nombre del archivo de imagen QR que se generará (opcional)
    $archivoQR = 'qr' . $codigoClase . '.png';

    // Tamaño y margen del código QR (opcional)
    $tamaño = 5; // Tamaño de los módulos en píxeles
    $margen = 0; // Margen en módulos

    // Generar el código QR
    QRcode::png($texto, $archivoQR, QR_ECLEVEL_L, $tamaño, $margen);

    return '<img src="' . $archivoQR . '" />';
}
