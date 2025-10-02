<?php
class Vacante {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

  public function crearVacante($idReclutador, $titulo, $descripcion, $ubicacion, $requisitos, $salario_min, $salario_max) {
    $sql = "INSERT INTO ofertas_trabajo 
            (id_reclutador, titulo, descripcion, ubicacion, fecha_publicacion, requisitos, salario_min, salario_max) 
            VALUES (?, ?, ?, ?, NOW(), ?, ?, ?)";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        die("Error en prepare: " . $this->conn->error);
    }

    $stmt->bind_param("issssdd", 
        $idReclutador, 
        $titulo, 
        $descripcion, 
        $ubicacion, 
        $requisitos, 
        $salario_min, 
        $salario_max
    );

    if (!$stmt->execute()) {
        die("Error en execute: " . $stmt->error);
    }

    return true;
}

}
?>