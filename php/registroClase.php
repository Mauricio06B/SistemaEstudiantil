<?php

include("../modelos/clase.php");

$fecha_completa = date('Y-m-d H:i_s');

$fecha = isset($_POST["id_usuario"]) ? $_POST["id_usuario"] : NULL;
$hora = isset($_POST["hora"]) ? $_POST["hora"] : NULL;

if($fecha != NULL && $hora != NULL){
    $fecha_completa = $fecha ." " . convertirHora($hora);
}

$id_asignatura = isset($_POST["id_asignatura"]) ? $_POST["id_asignatura"] : NULL;

$fecha = isset($_POST["fecha"]) ? $_POST['fecha'] : NULL;
$aula = isset($_POST['aula']) ? $_POST['aula'] : NULL;

$datosCorrectos = false;

if ($id_asignatura != NULL && $fecha != NULL && $aula != NULL) {
    $datosCorrectos = true;
}

if ($datosCorrectos) {
    $clase = new clase();
    $clase->setIdAsignatura($id_asignatura);
    $clase->setFecha($fecha);
    $clase->setAula($aula);
    $clase->setEstado(1);
    $existe = $clase->consultarFiltros();

    if ($existe == NULL) {
        if ($clase->insertar()) {
            $url = "lista_clases.php?mensaje=Clase%20agendada%20correctamente.";
            header("Location: $url");
        }else{
            header("Location: lista_clases.php?mensaje=Por%20favor%20verifique%20la%20información.");
        }
    }else{
        header("Location: lista_clases.php?mensaje=Clase%20previamente%20agendada");
    }
} else {
    header("Location: lista_clases.php?mensaje=Por%20favor%20verifique%20la%20información.");
}


function convertirHora($fecha){
    
    // Hora en formato AM/PM
    $hora_am_pm = $fecha;
    
    // Convertir a hora militar
    $hora_militar = date("H:i", strtotime($hora_am_pm));
    
    return $hora_militar;
} 