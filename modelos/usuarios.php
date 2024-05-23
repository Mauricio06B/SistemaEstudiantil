<?php

include_once('../datos/basedatos.php');



class usuarios extends basedatos

{

    private $id;

    private $usuario;

    private $clave;

    private $nombre_completo;

    private $rol;

    private $correo_institucional;

    private $telefono;

    private $tipo_documento;

    private $numero_documento;

    private $conn;



    public function __construct($id = NULL, $usuario = NULL, $clave = NULL, $nombre_completo = NULL, $rol = NULL, $correo_institucional = NULL, $telefono = NULL, $tipo_documento = NULL, $numero_documento = NULL)

    {

        $this->id = $id;

        $this->usuario = $usuario;

        $this->clave = $clave;

        $this->nombre_completo = $nombre_completo;

        $this->rol = $rol;

        $this->correo_institucional = $correo_institucional;

        $this->telefono = $telefono;

        $this->tipo_documento = $tipo_documento;

        $this->numero_documento = $numero_documento;



        $base = new basedatos("localhost", "id22127220_admin", "123456Qwert7y*", "id22127220_registro_estudiantes");

        $base->conectar();

        $this->conn = $base->getConexion();

    }



    // Setters

    public function setId($id)

    {

        $this->id = $id;

    }



    public function setUsuario($usuario)

    {

        $this->usuario = $usuario;

    }



    public function setClave($clave)

    {

        $this->clave = $clave;

    }



    public function setNombreCompleto($nombre_completo)

    {

        $this->nombre_completo = $nombre_completo;

    }



    public function setRol($rol)

    {

        $this->rol = $rol;

    }



    public function setCorreoInstitucional($correo_institucional)

    {

        $this->correo_institucional = $correo_institucional;

    }



    public function setTelefono($telefono)

    {

        $this->telefono = $telefono;

    }



    public function setTipoDocumento($tipo_documento)

    {

        $this->tipo_documento = $tipo_documento;

    }



    public function setNumeroDocumento($numero_documento)

    {

        $this->numero_documento = $numero_documento;

    }



    // Getters

    public function getId()

    {

        return $this->id;

    }



    public function getUsuario()

    {

        return $this->usuario;

    }



    public function getClave()

    {

        return $this->clave;

    }



    public function getNombreCompleto()

    {

        return $this->nombre_completo;

    }



    public function getRol()

    {

        return $this->rol;

    }



    public function getCorreoInstitucional()

    {

        return $this->correo_institucional;

    }



    public function getTelefono()

    {

        return $this->telefono;

    }



    public function getTipoDocumento()

    {

        return $this->tipo_documento;

    }



    public function getNumeroDocumento()

    {

        return $this->numero_documento;

    }



    // Métodos para interactuar con la base de datos

    public function consultar()

    {

        $sql = "SELECT * FROM usuario WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $this->id);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();

    }



    public function consultarPorDocumento()

    {

        $sql = "SELECT * FROM usuario WHERE numero_documento = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param("i", $this->numero_documento);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->fetch_assoc();

    }



    public function listarTodos()

    {

        $sql = "SELECT * FROM usuario";

        $result = $this->conn->query($sql);

        $usuarios = [];

        while ($row = $result->fetch_assoc()) {

            $usuarios[] = $row;

        }

        return $usuarios;

    }



    public function listarTodosDocentes()

    {

        $sql = "SELECT * FROM usuario WHERE rol = 2";

        $result = $this->conn->query($sql);

        $usuarios = [];

        while ($row = $result->fetch_assoc()) {

            $usuarios[] = $row;

        }

        return $usuarios;

    }

    public function listarPorRol()
    {

        $sql = "SELECT * FROM usuario WHERE rol = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->rol);
        $stmt->execute();
        $result = $stmt->get_result();
        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Iterar sobre los resultados y obtenerlos como arrays asociativos
            while ($row = $result->fetch_assoc()) {
                $usuarios[] = $row;
            }
            return $usuarios;
        } else {
            $usuarios = array();
            return $usuarios;
        }
    }

    public function actualizar()
    {

        $sql = "UPDATE usuario SET usuario=?, clave=?, nombre_completo=?, rol=?, correo_institucional=?, telefono=?, tipo_documento=?, numero_documento=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssssi", $this->usuario, $this->clave, $this->nombre_completo, $this->rol, $this->correo_institucional, $this->telefono, $this->tipo_documento, $this->numero_documento, $this->id);
        return $stmt->execute();
    }

    public function eliminar()
    {
        $sql = "DELETE FROM usuario  WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    public function consultarUsuario()
    {
        $sql = "SELECT * FROM usuario WHERE Usuario = ? AND Clave = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $this->usuario, $this->clave);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertar()
    {
        $sql = "INSERT INTO usuario (usuario, clave, nombre_completo, rol, correo_institucional, telefono, tipo_documento, numero_documento) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssissis", $this->usuario, $this->clave, $this->nombre_completo, $this->rol, $this->correo_institucional, $this->telefono, $this->tipo_documento, $this->numero_documento);
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows == 1) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }
}

