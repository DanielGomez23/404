<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // <-- necesario para usar $_SESSION

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

    // función para crear la vacante (solo reclutadores)
    public function postularVacante() {
        // Solo procesar si viene del formulario correcto
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postulacion'])) {

            // Verificar que el usuario esté logueado y sea reclutador
            if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'reclutador') {
                $this->alerta->mostrarAlerta(
                    "error",
                    "Acceso denegado",
                    "Solo los reclutadores pueden publicar vacantes.",
                    "../views/login.php"
                );
                return;
            }

            // Obtener el id del reclutador desde la sesión (ajustado)
            if (!isset($_SESSION['usuario_id']) || empty($_SESSION['usuario_id'])) {
                $this->alerta->mostrarAlerta(
                    "error",
                    "Sesión inválida",
                    "No se encontró identificación del reclutador en la sesión. Inicia sesión nuevamente.",
                    "../views/login.php"
                );
                return;
            }

            $reclutador = (int) $_SESSION['usuario_id']; // <-- corregido aquí

            // Campos del formulario
            $titulo = trim($_POST['titulo'] ?? '');
            $descripcion = trim($_POST['descripcion'] ?? '');
            $ubicacion = trim($_POST['ubicacion'] ?? '');
            $requisitos = trim($_POST['requisitos'] ?? '');
            $salario_min = trim($_POST['salario_min'] ?? 0);
            $salario_max = trim($_POST['salario_max'] ?? 0);
            $modalidad = trim($_POST['modalidad'] ?? 'No definida'); 
            $nivel = trim($_POST['nivel'] ?? 'No indicado');         

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
            if ($this->vacante->crearVacante($reclutador, $titulo, $descripcion, $ubicacion, $requisitos, $salario_min, $salario_max, $modalidad, $nivel)) {
                $this->alerta->mostrarAlerta(
                    "success",
                    "Vacante publicada",
                    "Tu vacante fue publicada con éxito.",
                    "../views/empresas/dash_reclutadores.php"
                );
            } else {
                $this->alerta->mostrarAlerta(
                    "error",
                    "Error",
                    "No se pudo publicar la vacante.",
                    "../views/empresas/new_vacancy.php"
                );
            }
        }
    }

    public function listarVacantes() {
        return $this->vacante->obtenerVacantes();
    }
}

// Conexión
$conn = Database::getConnection();

// Crear instancia del controlador
$vacanteController = new VacanteController();

// Ejecutar según formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['postulacion'])) {
    $vacanteController->postularVacante();
}
?>
