<?php
$codigoClase = isset($_GET['clase_id']) ? $_GET['clase_id'] : NULL;
$codigoAsignatura = isset($_GET['a']) ? $_GET['a'] : NULL;
if ($codigoClase != NULL) {
    include("../modelos/clase.php");
    $clase = new clase();
    $clase->setId($codigoAsignatura);

    $datosClase = $clase->consultar();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php
    include('encabezado.php');
    include("../librerias/phpqrcode/qrlib.php");
    ?>
    <script src="../js/clase_asistencia.js"></script>
</head>

<body class="">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12"> &nbsp;
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="text-center"><?php echo "Asignatura: " . $datosClase['nombre_asignatura']; ?></h3>
                        <h4 class="text-center"><?php echo "Aula: " . $datosClase['aula_asignatura']; ?></h4>
                    </div>
                </div>
                <div class="card-body">

                    <form id="form_guardarAsistencia">
                        <lable for="input_codigo_estudiante">Código de estudiante: </lable>
                        <input id="input_codigo_estudiante" name="codigo_estudiante" value="" class="form-control">
                        <input id="input_codigo_clase" name="codigo_clase" value="<?php echo $codigoClase; ?>" class="hidden">
                        <br>
                        <button class="btn btn-primary form-control" form="form_guardarAsistencia">Guardar asistencia</button>
                    </form>
                    <br>
                    <div id="mensaje_asistencia">

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>