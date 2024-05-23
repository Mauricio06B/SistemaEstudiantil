<?php

include_once("../datos/basedatos.php");
class usuario_asignatura extends basedatos{
    // Atributos
    private $id;
    private $id_asignatura;
    private $id_usuario;
    private $conn;

    // Constructor
    public function __construct($id_asignatura = NULL, $id_usuario = NULL) {
        $this->id_asignatura = $id_asignatura;
        $this->id_usuario = $id_usuario;

        $base = new basedatos("localhost","id22127220_admin","123456Qwert7y*","id22127220_registro_estudiantes");
        $base->conectar();
        $this->conn = $base->getConexion();
    }
    // Getters y Setters
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }

    public function getIdAsignatura() {
        return $this->id_asignatura;
    }

    public function setIdAsignatura($id_asignatura) {
        $this->id_asignatura = $id_asignatura;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    // Métodos
    // Consultar un registro por ID
    public function consultar() {
        $sql = "SELECT * FROM usuario_asignatura WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function insertar()
    {
        $sql = "INSERT INTO usuario_asignatura (id_asignatura, id_usuario) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $this->id_asignatura, $this->id_usuario);
        $stmt->execute();

        // Verificar si la inserción fue exitosa
        if ($stmt->affected_rows == 1) {
            return true; // Inserción exitosa
        } else {
            return false; // Error en la inserción
        }
    }

    // Listar todos los registros
    public function listarTodos($conexion) {
        $query = "SELECT * FROM usuario_asignatura";
        $result = $conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     // Listar registros por usuario
     public function listarPorUsuario() {
        $sql = "SELECT ua.id ua_id, a.*
                FROM usuario_asignatura ua
                INNER JOIN asignatura a ON a.id = ua.id_asignatura
                WHERE id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Listar registros por usuario
    public function listarUsuariosPorAsignatura() {
        $sql = "SELECT ua.id ua_id, a.*, u.nombre_completo, u.id id_usuario
                FROM usuario_asignatura ua
                INNER JOIN asignatura a ON a.id = ua.id_asignatura
                INNER JOIN usuario u ON u.id = ua.id_usuario
                WHERE a.id = ? AND u.rol = 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id_asignatura);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

     // Listar registros por usuario

     public function listarClasesAsignatura() {
        $sql = "SELECT a.id, a.codigo, a.nombre_asignatura, a.aula_asignatura, a.departamento_asignatura, a.anio, a.periodo,
                        c.id id_clase, c.id_asignatura, c.fecha, c.aula, c.estado
                FROM asignatura a
                INNER JOIN clase c ON a.id = c.id_asignatura
                WHERE a.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id_asignatura);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Listar registros por asignatura y usuario
    public function listarPorAsignaturayUsuario() {
        $sql = "SELECT ua.id, a.*
                FROM usuario_asignatura ua
                INNER JOIN asignatura a ON a.id = ua.id_asignatura
                WHERE id_asignatura = ? AND id_usuario = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $this->id_asignatura, $this->id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Actualizar un registro
    public function actualizar() {
        $sql = "UPDATE usuario_asignatura SET id_asignatura = ?, id_usuario = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $this->id_asignatura, $this->id_usuario, $this->id);
        return $stmt->execute();
    }

    // Eliminar un registro
    public function eliminar() {
        $sql = "DELETE FROM usuario_asignatura WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }
}