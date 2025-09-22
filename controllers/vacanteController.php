<?php
require_once '../config/Database.php';
require_once '../models/vacante.php';
require_once '../controllers/AuthController.php';

session_start();

class VacanteController{
private Vacante $vacante;
private Alerta $alerta;


// función para postular la vacante
public function postularVacante() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postulacion'])) {
    $reclutador = trim($_POST['id_reclutador'] ?? '');

    if ($_SESSION['usuario_rol'] !== 'reclutador') {
        $this->alerta->mostrarAlerta("error", "Acceso denegado", "Solo los reclutadores pueden publicar vacantes.", "../views/login.php");
    }
        $titulo = trim($_POST['titulo'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $ubicacion = trim($_POST['ubicacion'] ?? '');
        $salario = trim($_POST['salario'] ?? 0);
        $requisitos = trim($_POST['requisitos'] ?? "");

        //-salario, -requisitos 

        if (!$titulo || !$descripcion || !$requisitos || !$salario || !$ubicacion) {
            $this->alerta->mostrarAlerta("warning", "Campos incompletos", "Todos los campos son obligatorios.", "../views/publicar_vacante.php");
        }

        if ($this->vacante->crearVacante($reclutador, $titulo, $descripcion, $requisitos, $salario, $ubicacion)) {
            $this->alerta->mostrarAlerta("success", "Vacante publicada", "Tu vacante fue publicada con éxito.", "../views/mis_vacantes.php");
        } else {
            $this->alerta->mostrarAlerta("error", "Error", "No se pudo publicar la vacante.", "../views/publicar_vacante.php");
        }
    }
}
}
//Conexión
$conn = Database::getConnection();

// Crear instancia del controlador
$vacanteController = new VacanteController();

// Ejecutar según formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postulacion'])) {
    $vacanteController->postularVacante();
}
?>