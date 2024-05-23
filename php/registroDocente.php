<?php 
include("../modelos/usuarios.php");

$nombre = isset($_POST["docente_nombre"]) ? $_POST["docente_nombre"] : NULL;
$correo = isset($_POST["docente_correo"]) ? $_POST["docente_correo"] : NULL;
$telefono = isset($_POST["docente_telefono"]) ? $_POST["docente_telefono"] : NULL;
$tipo_documento = isset($_POST["docente_tipo_documento"]) ? $_POST["docente_tipo_documento"] : NULL;
$documento = isset($_POST["docente_documento"]) ? $_POST["docente_documento"] : NULL;
$contrasena = isset($_POST["docente_documento"]) ? $_POST["docente_documento"] : NULL;   
$usuarioD = isset($_POST["docente_usuario"]) ? TRIM($_POST["docente_usuario"]) : NULL;

$datosCorrectos = false;

if($nombre != NULL && $correo != NULL && $telefono != NULL && $tipo_documento != NULL && $documento != NULL && $contrasena != NULL){
    $datosCorrectos = true;
}

if($datosCorrectos){
    $usuario = new usuarios();

    $usuario->setNombreCompleto($nombre);
    $usuario->setCorreoInstitucional($correo);
    $usuario->setClave($contrasena);
    $usuario->setTelefono($telefono);
    $usuario->setTipoDocumento($tipo_documento);
    $usuario->setNumeroDocumento($documento);
    $usuario->setUsuario($usuarioD);
    $usuario->setRol(2);

    if($usuario->insertar()){
        $url = "listaDocentes.php?mensaje=Usuario%20" .  $usuarioD . "%20creado%20correctamente.";
        header("Location: $url");
    }
}else{
    header("Location: listaDocentes.php?mensaje=Por%20favor%20verifique%20la%20información.");
}
