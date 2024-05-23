<?php
include("../modelos/asignatura.php");

$codigo = isset($_POST['codigo']) ? $_POST['codigo'] : NULL;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : NULL;
$aula = isset($_POST['aula']) ? $_POST['aula'] : NULL;
$departamento = isset($_POST['departamento']) ? $_POST['departamento'] : NULL;
$anio = isset($_POST['anio']) ? $_POST['anio'] : NULL;
$periodo = isset($_POST['periodo']) ? $_POST['periodo'] : NULL;

$datosCorrectos = false;

if ($codigo != NULL && $nombre != NULL && $aula != NULL && $departamento != NULL && $anio != NULL && $periodo != NULL) {
    $datosCorrectos = true;
}

if ($datosCorrectos) {
    $asig = new asignatura();

    $asig->setCodigo($codigo);
    $asig->setNombreAsignatura($nombre);
    $asig->setAulaAsignatura($aula);
    $asig->setDepartamentoAsignatura($departamento);
    $asig->setAnio($anio);
    $asig->setPeriodo($periodo);

    if ($asig->insertar()) {
        $url = "listaAsignaturas.php?mensaje=Asignatura%20" .  $nombre . "%20creado%20correctamente.";
        header("Location: $url");
    }
} else {
    header("Location: listaAsignaturas.php?mensaje=Por%20favor%20verifique%20la%20información.");
}
