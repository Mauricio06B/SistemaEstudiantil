<?php

include("../modelos/usuario_asignatura.php");

$id_usuario = isset($_POST["id_usuario"]) ? $_POST["id_usuario"] : NULL;
$id_asignatura = isset($_POST["id_asignatura"]) ? $_POST["id_asignatura"] : NULL;
$datosCorrectos = false;

if ($id_usuario != NULL && $id_asignatura != NULL) {
    $datosCorrectos = true;
}

if ($datosCorrectos) {
    $usu_asig = new usuario_asignatura();
    $usu_asig->setIdUsuario($id_usuario);
    $usu_asig->setIdAsignatura($id_asignatura);
    $existe = $usu_asig->listarPorAsignaturayUsuario();

    if ($existe == NULL) {
        if ($usu_asig->insertar()) {
            $url = "lista_usuarios_asignaturas.php?correcto=Estudiante%20asignado%20correctamente.";
            header("Location: $url");
        }else{
            header("Location: lista_usuarios_asignaturas.php?mensaje=Por%20favor%20verifique%20la%20información.");
        }
    }else{
        header("Location: lista_usuarios_asignaturas.php?mensaje=El%20estudiante%20ya%20ha%20sido%20asignado%20a%20esta%20asignatura.");
    }
} else {
    header("Location: listaDocentes.php?mensaje=Por%20favor%20verifique%20la%20información.");
}
