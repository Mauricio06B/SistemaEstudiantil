<?php 
include_once("../datos/basedatos.php");

class clase extends basedatos {
    private $id;
    private $id_asignatura;
    private $fecha;
    private $aula;
    private $estado;
    private $conn;

    // Constructor
    public function __construct() {
        $this->id = null;
        $this->id_asignatura = null;
        $this->fecha = null;
        $this->aula = null;
        $this->estado = null;

        $base = new basedatos("localhost","id22127220_admin","123456Qwert7y*","id22127220_registro_estudiantes");
        $base->conectar();
        $this->conn = $base->getConexion();
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdAsignatura() {
        return $this->id_asignatura;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getAula() {
        return $this->aula;
    }

    public function getEstado() {
        return $this->estado;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdAsignatura($id_asignatura) {
        $this->id_asignatura = $id_asignatura;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function setAula($aula) {
        $this->aula = $aula;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    // Métodos para interactuar con la base de datos
    public function consultar() {
        $sql = "SELECT c.*, a.nombre_asignatura, a.aula_asignatura
                FROM clase c
                INNER JOIN asignatura a ON a.id = c.id_asignatura
                WHERE a.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Métodos para interactuar con la base de datos
    public function consultarFiltros() {
        $sql = "SELECT c.*, a.nombre_asignatura, a.aula_asignatura
                FROM clase c
                INNER JOIN asignatura a ON a.id = c.id_asignatura
                WHERE c.fecha = ? AND c.id_asignatura = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $this->fecha, $this->id_asignatura);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertar()
    {
        $sql = "INSERT INTO clase (id_asignatura, fecha, aula, estado) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $this->id_asignatura, $this->fecha, $this->aula, $this->estado);
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows == 1) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    // Métodos para interactuar con la base de datos
    public function listarClasesAsignatura() {
        $sql = "SELECT c.*, a.nombre_asignatura, a.aula_asignatura, (SELECT u.nombre_completo FROM usuario u INNER JOIN usuario_asignatura ua ON ua.id_usuario = u.id WHERE ua.id_asignatura = a.id AND u.rol = 2) docente
                FROM clase c
                INNER JOIN asignatura a ON a.id = c.id_asignatura
                WHERE a.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id_asignatura);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    

}

