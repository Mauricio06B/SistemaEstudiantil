<?php
include('AutenticacionController.php');
include('AutenticacionControllerFactory.php');
include('../modelos/usuarios.php');

$nombreUsuario = isset($_POST['usuario']) ? $_POST['usuario'] : NULL;
$claveUsuario = isset($_POST['clave']) ? $_POST['clave'] : NULL;

if ($nombreUsuario != NULL && $claveUsuario != NULL) {
    $autenticacionController = AutenticacionControllerFactory::createController($nombreUsuario, $claveUsuario);
   if (!$autenticacionController) {
        header("Location: cerrarSesion.php");
        exit();
    }
    $autenticacionController->login($nombreUsuario, $claveUsuario);
}else{
    header("Location: index.php?error=Usuario%20no%20valido");
}
?>