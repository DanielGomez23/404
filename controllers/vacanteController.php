<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/Database.php';
require_once '../models/vacante.php';
require_once '../controllers/AuthController.php';


class VacanteController {
    private Vacante $vacante;
    private Alerta $alerta;

    public function __construct() {
        // Conexión a la BD
        $conn = Database::getConnection();
        if (!$conn) {
            die("Error de conexión a la base de datos");
        }

        // Inicializar dependencias
        $this->vacante = new Vacante($conn);
        $this->alerta = new Alerta();
    }

    // función para postular la vacante
    public function postularVacante() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postulacion'])) {
            $reclutador = trim($_POST['id_reclutador']) ?? '';

            // Solo reclutadores pueden publicar
            if ($_SESSION['usuario_rol'] !== 'reclutador') {
                $this->alerta->mostrarAlerta(
                    "error", 
                    "Acceso denegado", 
                    "Solo los reclutadores pueden publicar vacantes.", 
                    "../views/login.php"
                );
                return;
            }

            // Campos del formulario
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $ubicacion = trim($_POST['ubicacion'] ?? '');
            $requisitos = trim($_POST['requisitos'] ?? '');
            $salario_min = trim($_POST['salario_min'] ?? 0);
            $salario_max = trim($_POST['salario_max'] ?? 0);

            // Validación
            if (!$titulo || !$descripcion || !$requisitos || !$ubicacion || !$salario_min || !$salario_max) {
                $this->alerta->mostrarAlerta(
                    "warning", 
                    "Campos incompletos", 
                    "Todos los campos son obligatorios.", 
                    "../views/empresas/new_vacancy.php"
                );
                return;
            }

 


            // Llamar al modelo
            if ($this->vacante->crearVacante($reclutador, $titulo, $descripcion, $ubicacion, $requisitos, $salario_min, $salario_max)) {
                $this->alerta->mostrarAlerta(
                    "success", 
                    "Vacante publicada", 
                    "Tu vacante fue publicada con éxito.", 
                    "../views/empresas/dash_reclutador.php"
                );
            } else {
                $this->alerta->mostrarAlerta(
                    "error", 
                    "Error", 
                    "No se pudo publicar la vacante.", 
                    "../views/empresas/dash_reclutador.php"
                );
            }
        }
    }

    public function listarVacantes() {
        return $this->vacante->obtenerVacantes();
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