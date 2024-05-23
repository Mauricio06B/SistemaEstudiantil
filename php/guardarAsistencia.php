<?php
include("../modelos/asistencia.php");
include("../modelos/usuarios.php");

$codigo_estudiante = isset($_POST['codigo_estudiante']) ? $_POST['codigo_estudiante'] : NULL;
$id_clase = isset($_POST['id_clase']) ? $_POST['id_clase'] : NULL;
$resultado = array();

$resultado['resultado'] = false;
if ($codigo_estudiante != NULL && $id_clase != NULL) {
    $usuario = new usuarios();
    $usuario->setNumeroDocumento($codigo_estudiante);
    $encontrado = $usuario->consultarPorDocumento();
    
    if ($encontrado != null) {

        $asistencia = new asistencia();
        $asistencia->setIdUsuario($encontrado['id']);
        $asistencia->setIdClase($id_clase);
        $insertado = $asistencia->insertar();
        
        if ($insertado) {
            $resultado['encontrados'] = $encontrado;
            $resultado['resultado'] = "OK";
            $resultado['clase'] = $id_clase;

        }
    }
}
echo json_encode($resultado);
