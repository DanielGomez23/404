<?php
class Postulacion{
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
    

    public function crearPostulacion($id_postulante, $id_oferta) {
        $query = "INSERT INTO postulaciones (id_postulante, id_oferta) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$id_postulante, $id_oferta]);
    }
    public function verificarPostulacion($id_postulante, $id_oferta) {
        $query = "SELECT id FROM postulaciones WHERE id_postulante = ? AND id_oferta = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id_postulante, $id_oferta]);
        return $stmt->fetch();
    }
}
?>