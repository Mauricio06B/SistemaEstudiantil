<?php
class basedatos {
    private $host;
    private $usuario;
    private $clave;
    private $db;
    private $conexion;

    public function __construct($host, $usuario, $clave, $db) {
        $this->host = $host;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->db = $db;
    }

    public function conectar() {
        $this->conexion = mysqli_connect($this->host, $this->usuario, $this->clave, $this->db);
        return $this->conexion;
    }

    public function cerrarConexion() {
        mysqli_close($this->conexion);
    }

    public function getConexion(){
        return $this->conexion;
    }
}

?>