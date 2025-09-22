<?php
class Vacante {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }
        public function crearVacante($idReclutador, $titulo, $descripcion, $requisitos, $salario, $ubicacion) {
            $sql = "INSERT INTO vacantes (id_reclutador, titulo, descripcion, requisitos, salario, ubicacion) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("isssis", $idReclutador, $titulo, $descripcion, $requisitos, $salario, $ubicacion);
    
            return $stmt->execute();
        }
}
?>