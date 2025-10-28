<?php
class Vacante {
    private mysqli $conn;

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function crearVacante($idReclutador, $titulo, $descripcion, $ubicacion, $requisitos, $salario_min, $salario_max, $modalidad = 'No definida', $nivel = 'No indicado') {
        $sql = "INSERT INTO ofertas_trabajo 
                (id_reclutador, titulo, descripcion, ubicacion, fecha_publicacion, requisitos, salario_min, salario_max, modalidad, nivel) 
                VALUES (?, ?, ?, ?, NOW(), ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die('Error en prepare: ' . $this->conn->error);
        }

        $stmt->bind_param(
            "issssddss",
            $idReclutador,
            $titulo,
            $descripcion,
            $ubicacion,
            $requisitos,
            $salario_min,
            $salario_max,
            $modalidad,
            $nivel
        );

        if (!$stmt->execute()) {
            die('Error en execute: ' . $stmt->error);
        }

        return true;
    }

    public function eliminarVacante($idVacante, $idReclutador)
{
    $sql = "DELETE FROM ofertas_trabajo WHERE id = ? AND id_reclutador = ?";
    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        die('Error al preparar la consulta: ' . $this->conn->error);
    }

    $stmt->bind_param("ii", $idVacante, $idReclutador);

    if ($stmt->execute()) {
        return $stmt->affected_rows > 0;
    } else {
        error_log('Error al eliminar vacante: ' . $stmt->error);
        return false;
    }
}


}
?>
