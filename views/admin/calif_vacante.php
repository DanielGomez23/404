<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../../config/Database.php';
require_once '../../models/vacante.php';
require_once '../../controllers/Alertas.php'; // si ya tienes la clase Alerta

$conn = Database::getConnection();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vacante_id'], $_POST['calificacion'])) {
    $idVacante = (int) $_POST['vacante_id'];
    $nuevaCalificacion = trim($_POST['calificacion']);
    $idReclutador = (int) $_SESSION['usuario_id'];

    $vacante = new Vacante($conn);
    if ($vacante->actualizarCalificacion($idVacante, $idReclutador, $nuevaCalificacion)) {
        header("Location: dash_reclutadores.php");
        exit;
    } else {
        echo "<div style='color:red;text-align:center;margin-top:20px;'>Error al actualizar la calificación.</div>";
    }
} else {
    header("Location: dash_reclutadores.php");
    exit;
}
?>
