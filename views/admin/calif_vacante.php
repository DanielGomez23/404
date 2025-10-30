<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../../config/database.php';

// Verificar que sea administrador
if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] != 'administrador') {
    header("Location: ../login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['vacante_id']) && isset($_POST['calificacion'])) {
        $vacante_id = intval($_POST['vacante_id']);
        $calificacion = $_POST['calificacion'];
        
        // Validar que la calificación sea válida
        $calificaciones_validas = ['normal', 'buena', 'recomendada', 'destacada'];
        
        if (in_array($calificacion, $calificaciones_validas)) {
            $query = "UPDATE ofertas_trabajo SET calificacion = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $calificacion, $vacante_id);
            
            if ($stmt->execute()) {
                $_SESSION['mensaje_exito'] = "Calificación actualizada correctamente";
            } else {
                $_SESSION['mensaje_error'] = "Error al actualizar la calificación: " . $conn->error;
            }
            $stmt->close();
        } else {
            $_SESSION['mensaje_error'] = "Calificación no válida";
        }
    } else {
        $_SESSION['mensaje_error'] = "Datos incompletos";
    }
} else {
    $_SESSION['mensaje_error'] = "Método no permitido";
}

// Redirigir de vuelta a la lista de vacantes
header("Location: listar_vacantes.php");
exit;
?>