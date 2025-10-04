<?php
require_once '../config/DATABASE.php';
require_once '../models/postulacion.php';
require_once '../controllers/postulacionController.php';

class PostulacionController {
    private Postulacion $postulacion;
    private Alerta $alerta;

    public function __construct() {
        $conn = Database::getConnection();
        $this->postulacion = new Postulacion($conn);

        $this->alerta = new Alerta();
    }

    public function postular() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postular'])) {
            $id_postulante = $_SESSION['usuario_id'];
            $id_oferta = $_POST['id_oferta'];

            // Validar rol
            if ($_SESSION['usuario_rol'] !== 'postulante') {
                $this->alerta->mostrarAlerta(
                    "error", "Acceso denegado", 
                    "Solo los postulantes pueden postularse a vacantes.", 
                    "../views/profesional/dash_profesinal.php"
                );
                return;
            }

            // Verificar si ya se postuló
            if ($this->postulacion->verificarPostulacion($id_postulante, $id_oferta)) {
                $this->alerta->mostrarAlerta(
                    "warning", "Ya te postulaste", 
                    "No puedes postularte dos veces a la misma vacante.", 
                    "../views/profesional/dash_profesinal.php"
                );
                return;
            }
              // Guardar postulación
              if ($this->postulacion->crearPostulacion($id_postulante, $id_oferta)) {
                $this->alerta->mostrarAlerta(
                    "success", "Postulación enviada", 
                    "Tu postulación fue registrada con éxito.", 
                    "../views/profesional/dash_profesinal.php"
                );
            } else {
                $this->alerta->mostrarAlerta(
                    "error", "Error", 
                    "No se pudo registrar la postulación.", 
                    "../views/profesional/dash_profesinal.php"
                );
            }
        }
    }
}
?>