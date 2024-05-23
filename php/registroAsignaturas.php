<?php
include("../modelos/usuarios.php");

$codigo = isset($asignatura['codigo']) ? $asignatura['codigo'] : NULL;
$nombre = isset($asignatura['nombre_asignatura']) ? $asignatura['nombre_asignatura'] : NULL;
$aula = isset($asignatura['aula_asignatura']) ? $asignatura['aula_asignatura'] : NULL;
$departamento = isset($asignatura['departamento_asignatura']) ? $asignatura['departamento_asignatura'] : NULL;
$anio = isset($asignatura['anio']) ? $asignatura['anio'] : NULL;
$periodo = isset($asignatura['periodo']) ? $asignatura['periodo'] : NULL;

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

    if ($usuario->insertar()) {
        $url = "listaAsignaturas.php?mensaje=Usuario%20" .  $usuarioD . "%20creado%20correctamente.";
        header("Location: $url");
    }
} else {
    header("Location: listaAsignaturas.php?mensaje=Por%20favor%20verifique%20la%20información.");
}
