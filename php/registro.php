<?php 

include("../modelos/usuarios.php");
$nombre = isset($_POST["usuario"]) ? $_POST["usuario"] : NULL;
$correo = isset($_POST["correo"]) ? $_POST["correo"] : NULL;
$telefono = isset($_POST["telefono"]) ? $_POST["telefono"] : NULL;
$tipo_documento = isset($_POST["tipo_documento"]) ? $_POST["tipo_documento"] : NULL;
$documento = isset($_POST["documento"]) ? $_POST["documento"] : NULL;
$contrasena = isset($_POST["contrasena"]) ? $_POST["contrasena"] : NULL;   

$datosCorrectos = false;

if($nombre != NULL && $correo != NULL && $telefono != NULL && $tipo_documento != NULL && $documento != NULL && $contrasena != NULL){
    $datosCorrectos = true;
}
if($datosCorrectos){
    $usuario = new usuarios();
    $usuarioAleatorio = crearUsuarioAleatorio($nombre, $tipo_documento, $documento);
    $usuario->setNombreCompleto($nombre);
    $usuario->setCorreoInstitucional($correo);
    $usuario->setClave($contrasena);
    $usuario->setTelefono($telefono);
    $usuario->setTipoDocumento($tipo_documento);
    $usuario->setNumeroDocumento($documento);
    $usuario->setUsuario($usuarioAleatorio);
    $usuario->setRol(1);

    if($usuario->insertar()){
        $url = "index.php?correcto=Usuario%20" .  $usuarioAleatorio . "%20creado%20correctamente.";
        header("Location: $url");
    }
}else{
    header("Location: crearCuenta.php?mensaje=Por%20favor%20verifique%20la%20información.");
}

function crearUsuarioAleatorio($nombre, $tipo_documento, $documento){
        $nombreSinEspacios = str_replace(" ","",$nombre);
        return substr($nombreSinEspacios, 0, 8).$tipo_documento.substr($documento, 0,3);
}