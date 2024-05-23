<?php
// Factoría para crear instancias de controladores de autenticación
class AutenticacionControllerFactory
{
    public static function createController($usuario, $Clave)
    {
        $usuarioEncontrado = AutenticacionControllerFactory::validateData($usuario, $Clave);
        $rol = $usuarioEncontrado != NULL ? $usuarioEncontrado['rol'] : NULL;

        if ($usuarioEncontrado != NULL) {
            session_start();
            $_SESSION['usuario'] =  $usuarioEncontrado['usuario'];
            $_SESSION['nombre_completo'] =  $usuarioEncontrado['nombre_completo'];
            $_SESSION['id'] =  $usuarioEncontrado['id'];
            $_SESSION['rol'] =  $usuarioEncontrado['rol'];
        }

        switch ($rol) {
            case '1':
                return new EstudianteAutenticacionController();
            case '2':
                return new DocenteAutenticacionController();
            case '3':
                return new AdminAutenticacionController();
            default:
                return null;
        }
    }

    public static function validateData($nombreUsuario, $clave)
    {
        $usuario = new usuarios();
        $usuario->setUsuario($nombreUsuario);
        $usuario->setClave($clave);
        $usuarioEncontrado = $usuario->consultarUsuario();
        return $usuarioEncontrado;
    }
}