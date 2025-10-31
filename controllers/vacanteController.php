<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/vacante.php';
require_once __DIR__ . '/AuthController.php';

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
        
        public function eliminarVacante()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
                if (!isset($_SESSION['usuario_id'])) {
                    header("Location: ../views/login.php");
                    exit;
                }
                
                $idVacante = (int) $_GET['id'];
                $idReclutador = (int) $_SESSION['usuario_id'];
                
                if ($this->vacante->eliminarVacante($idVacante, $idReclutador)) {
                    $this->alerta->mostrarAlerta(
                        "success",
                        "Vacante eliminada",
                        "La vacante fue eliminada correctamente.",
                        "../views/empresas/dash_reclutadores.php"
                    );
                } else {
                    $this->alerta->mostrarAlerta(
                        "error",
                        "Error",
                        "No se pudo eliminar la vacante.",
                        "../views/empresas/dash_reclutadores.php"
                    );
                }
            }
        }


        public function actualizarCalificacion()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vacante_id'], $_POST['calificacion'])) {
        $idVacante = intval($_POST['vacante_id']);
        $calificacion = $_POST['calificacion'];

        $permitidas = ['normal', 'buena', 'recomendada', 'destacada'];

        if (!in_array($calificacion, $permitidas)) {
            echo "<script>alert('Calificación no válida'); history.back();</script>";
            exit;
        }

        if ($this->vacante->actualizarCalificacion($idVacante, $calificacion)) {
            echo "<script>alert('Calificación actualizada correctamente'); window.location.href='../views/admin/vacantes.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar la calificación'); history.back();</script>";
        }
    }
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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $vacanteController = new VacanteController();

    switch ($_GET['action']) {
        case 'eliminar':
            $vacanteController->eliminarVacante();
            break;

        default:
            echo "Acción no reconocida.";
            break;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion'])) {
    $vacanteController = new VacanteController();

    if ($_POST['accion'] === 'actualizarCalificacion') {
        $vacanteController->actualizarCalificacion();
    }
}



?>
