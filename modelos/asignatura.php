<?php
include_once("../datos/basedatos.php");
class asignatura extends basedatos
{
    private $id;
    private $codigo;
    private $nombre_asignatura;
    private $aula_asignatura;
    private $departamento_asignatura;
    private $anio;
    private $periodo;
    private $conn;

    public function __construct(
        $id = NULL,
        $codigo = NULL,
        $nombre_asignatura = NULL,
        $aula_asignatura = NULL,
        $departamento_asignatura = NULL,
        $anio = NULL,
        $periodo = NULL
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->nombre_asignatura = $nombre_asignatura;
        $this->aula_asignatura = $aula_asignatura;
        $this->departamento_asignatura = $departamento_asignatura;
        $this->anio = $anio;
        $this->periodo = $periodo;

        $base = new basedatos("localhost", "id22127220_admin", "123456Qwert7y*", "id22127220_registro_estudiantes");
        $base->conectar();
        $this->conn = $base->getConexion();
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getNombreAsignatura()
    {
        return $this->nombre_asignatura;
    }

    public function getAulaAsignatura()
    {
        return $this->aula_asignatura;
    }

    public function getDepartamentoAsignatura()
    {
        return $this->departamento_asignatura;
    }

    public function getAnio()
    {
        return $this->anio;
    }

    public function getPeriodo()
    {
        return $this->periodo;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function setNombreAsignatura($nombre_asignatura)
    {
        $this->nombre_asignatura = $nombre_asignatura;
    }

    public function setAulaAsignatura($aula_asignatura)
    {
        $this->aula_asignatura = $aula_asignatura;
    }

    public function setDepartamentoAsignatura($departamento_asignatura)
    {
        $this->departamento_asignatura = $departamento_asignatura;
    }

    public function setAnio($anio)
    {
        $this->anio = $anio;
    }

    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;
    }

    // Método para insertar datos
    public function insertar()
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO asignatura (codigo, nombre_asignatura, aula_asignatura, departamento_asignatura, anio, periodo) VALUES (?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param(
            "ssssii",
            $this->codigo,
            $this->nombre_asignatura,
            $this->aula_asignatura,
            $this->departamento_asignatura,
            $this->anio,
            $this->periodo
        );

        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            return true;
        } else {
            return false;
        }
    }

    // Método para consultar datos y asignarlos a los sets
    public function consultar($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM asignatura WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($fila = $resultado->fetch_assoc()) {
            $this->id = $fila['id'];
            $this->codigo = $fila['codigo'];
            $this->nombre_asignatura = $fila['nombre_asignatura'];
            $this->aula_asignatura = $fila['aula_asignatura'];
            $this->departamento_asignatura = $fila['departamento_asignatura'];
            $this->anio = $fila['anio'];
            $this->periodo = $fila['periodo'];
            return true;
        } else {
            return false;
        }
    }

    // Método para consultar todas las asignaturas con filtrado
    public function consultarTodas($filtros = [])
    {
        $query = "SELECT a.*, 
                  (SELECT u.id 
                    FROM usuario u 
                    INNER JOIN usuario_asignatura ua ON ua.id_asignatura = a.id AND ua.id_usuario = u.id AND u.rol = 2) id_usuario, 
                  (SELECT u.nombre_completo 
                    FROM usuario u 
                    INNER JOIN usuario_asignatura ua ON ua.id_asignatura = a.id AND ua.id_usuario = u.id AND u.rol = 2) nombre_usuario
            FROM asignatura a
            WHERE id IS NOT NULL ";
        $tipos = "";
        $parametros = [];

        if (!empty($filtros['anio'])) {
            $query .= " AND anio = ?";
            $tipos .= "i";
            $parametros[] = $filtros['anio'];
        }

        if (!empty($filtros['periodo'])) {
            $query .= " AND periodo = ?";
            $tipos .= "i";
            $parametros[] = $filtros['periodo'];
        }

        if (!empty($filtros['departamento_asignatura'])) {
            $query .= " AND departamento_asignatura = ?";
            $tipos .= "s";
            $parametros[] = $filtros['departamento_asignatura'];
        }

        if (!empty($filtros['nombre_asignatura'])) {
            $query .= " AND nombre_asignatura LIKE ?";
            $tipos .= "s";
            $parametros[] = "%" . $filtros['nombre_asignatura'] . "%";
        }

        if (!empty($filtros['codigo'])) {
            $query .= " AND codigo = ?";
            $tipos .= "s";
            $parametros[] = $filtros['codigo'];
        }
        $query .= " ORDER BY anio DESC, periodo DESC";

        $stmt = $this->conn->prepare($query);

        if (!empty($tipos)) {
            $stmt->bind_param($tipos, ...$parametros);
        }

        $stmt->execute();
        $resultado = $stmt->get_result();
        $asignaturas = [];

        while ($fila = $resultado->fetch_assoc()) {

            $asignaturas[] = $fila;
        }

        return $asignaturas;
    }

    // Método para consultar todas las asignaturas con filtrado
    public function consultarTodasSinDocente()
    {
        $query = "SELECT a.*, 
                        (SELECT u.id 
                        FROM usuario u 
                        INNER JOIN usuario_asignatura ua ON ua.id_asignatura = a.id AND ua.id_usuario = u.id AND u.rol = 2) id_usuario
                        FROM asignatura a
                        WHERE id IS NOT NULL AND (SELECT u.id 
                                                  FROM usuario u 
                                                  INNER JOIN usuario_asignatura ua ON ua.id_asignatura = a.id 
                                                  AND ua.id_usuario = u.id AND u.rol = 2) IS NULL ";

        $query .= " ORDER BY anio DESC, periodo DESC";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        $resultado = $stmt->get_result();
        $asignaturas = [];

        while ($fila = $resultado->fetch_assoc()) {

            $asignaturas[] = $fila;
        }

        return $asignaturas;
    }
}
