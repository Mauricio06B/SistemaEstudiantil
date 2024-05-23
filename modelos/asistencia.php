<?php 
include_once("../datos/basedatos.php");

class asistencia extends basedatos{
    private $id;
    private $id_clase;
    private $id_usuario;
    private $estado_asistencia;
    private $conn;

    // Constructor que inicializa todos los atributos en NULL por defecto
    public function __construct($id = NULL, $id_clase = NULL, $id_usuario = NULL, $estado_asistencia = NULL) {
        $this->id = $id;
        $this->id_clase = $id_clase;
        $this->id_usuario = $id_usuario;
        $this->estado_asistencia = $estado_asistencia;

        $base = new basedatos("localhost","id22127220_admin","123456Qwert7y*","id22127220_registro_estudiantes");
        $base->conectar();
        $this->conn = $base->getConexion();
    }

    // Métodos getter
    public function getId() {
        return $this->id;
    }

    public function getIdClase() {
        return $this->id_clase;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getEstadoAsistencia() {
        return $this->estado_asistencia;
    }

    // Métodos setter
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdClase($id_clase) {
        $this->id_clase = $id_clase;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setEstadoAsistencia($estado_asistencia) {
        $this->estado_asistencia = $estado_asistencia;
    }

    // Listar todos los registros
    public function listarTodos($conexion) {
        $query = "SELECT * FROM asistencia";
        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Listar todos los registros
    public function insertar() {
        $query = "INSERT INTO asistencia (id_clase, id_usuario, estado_asistencia) VALUES (?, ?, ?)";
        $estado = 1;
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("iii", $this->id_clase, $this->id_usuario, $estado);
        $result = $stmt->execute();
        return $result;
    }

    // Listar asistencias materia 
    public function listar_asistencias_materias() {
        $query = "SELECT *
                  FROM asistencia a
                  INNER JOIN clase c ON c.id = a.id_clase";
        $estado = 1;
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sss", $this->id_clase, $this->id_usuario, $estado);
        $result = $stmt->execute();
        return $result;
    }

    // Listar asistencias materia 
    public function listar_asistencias_usuario_clase() {
        $query = "SELECT *
        FROM asistencia a
        WHERE a.id_clase = ? AND a.id_usuario = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $this->id_clase, $this->id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    

}
