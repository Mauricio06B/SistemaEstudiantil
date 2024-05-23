<?php
// Interfaz para los controladores de autenticación
interface AutenticacionControllerInterface {
    public function login();
}

// Clase base para los controladores de autenticación
abstract class AutenticacionController implements AutenticacionControllerInterface {
    public function __construct() {
    }
    abstract public function login();

    /*protected function redirectToIndexWithError($error) {
        header("Location: index.php?error=$error");
        exit();
    }*/
}
// Implementación del controlador de autenticación para estudiantes
class EstudianteAutenticacionController extends AutenticacionController {
    public function login() {
        header("Location: formulario_estudiante.php");
    }
}

// Implementación del controlador de autenticación para docentes
class DocenteAutenticacionController extends AutenticacionController {
    public function login() {
        header("Location: formulario_docente.php");
    }
}

// Implementación del controlador de autenticación para administradores
class AdminAutenticacionController extends AutenticacionController {
    public function login() {
        header("Location: administrador.php");
    }
}
?>