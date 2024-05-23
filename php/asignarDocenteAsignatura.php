<?php
include("../modelos/usuario_asignatura.php");

$asignatura = isset($_POST['asignatura']) ? $_POST['asignatura'] : NULL;
$docente = isset($_POST['docente']) ? $_POST['docente'] : NULL;


$datosCorrectos = false;

if ($asignatura != NULL && $docente != NULL) {
    $datosCorrectos = true;
}

if ($datosCorrectos) {
    $asig = new usuario_asignatura();

    $asig->setIdAsignatura($asignatura);
    $asig->setIdUsuario($docente);

    $existe = $asig->listarPorAsignaturayUsuario();
    if($existe != NULL) {
        header("Location: listaAsignaturas.php?mensaje=Esta asignación ya existe.");
    }else{
        if ($asig->insertar()) {
            $url = "listaAsignaturas.php?correcto=Asignación%20realizada%20correctamente.";
            header("Location: $url");
        }else{
            $url = "listaAsignaturas.php?mensaje=Error%20al%20guardar.";
            header("Location: $url");
        }
    }
    
} else {
    header("Location: listaAsignaturas.php?mensaje=Por%20favor%20verifique%20la%20información.");
}
