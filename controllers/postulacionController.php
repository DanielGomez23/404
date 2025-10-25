<?php
session_start();
require_once "../config/DATABASE.php"; 

class PostulacionController {

    public function postular() {
        $conn = Database::getConnection();

        // Validar conexión
        if (!$conn) {
            die("Error: No hay conexión a la base de datos.");
        }

        // Verificar si se envió el formulario
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // ✅ Verificar que el usuario sea postulante
            if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'postulante') {
                echo "<script>alert('Solo los postulantes pueden aplicar a vacantes.'); window.location.href='../views/login.php';</script>";
                exit;
            }

            // ✅ Verificar sesión
            if (!isset($_SESSION['cedula']) || empty($_SESSION['cedula'])) {
                echo "<script>alert('Error: sesión inválida. Inicia sesión nuevamente.'); window.location.href='../views/login.php';</script>";
                exit;
            }

            $id_postulante = (int) $_SESSION['cedula']; // postulante actual
            $id_oferta = intval($_POST['id_oferta'] ?? 0); // vacante seleccionada

            if ($id_oferta <= 0) {
                echo "<script>alert('No se pudo identificar la vacante.'); window.history.back();</script>";
                exit;
            }

            // Campos opcionales del formulario
            $mensaje  = mysqli_real_escape_string($conn, $_POST['mensaje'] ?? '');
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono'] ?? '');

            // ✅ Manejo de archivo CV (PDF)
            $ruta_destino = "";
            if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === 0) {
                $directorio = __DIR__ . "/../../hojas_de_vida/";

                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $cv_nombre = basename($_FILES["cv"]["name"]);
                $tipo_archivo = strtolower(pathinfo($cv_nombre, PATHINFO_EXTENSION));

                if ($tipo_archivo !== "pdf") {
                    echo "<script>alert('Solo se permiten archivos PDF'); window.history.back();</script>";
                    exit;
                }

                $nombre_unico = time() . "_" . $cv_nombre;
                $ruta_destino = $directorio . $nombre_unico;

                if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $ruta_destino)) {
                    echo "<script>alert('Error al subir el archivo.'); window.history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Debes adjuntar tu hoja de vida en formato PDF.'); window.history.back();</script>";
                exit;
            }

            // ✅ Ruta relativa para guardar en BD
            $ruta_relativa = "hojas_de_vida/" . basename($ruta_destino);

            // ✅ Insertar postulación enlazada a postulante y vacante
            $sql = "INSERT INTO postulaciones (id_postulante, id_oferta, cv, mensaje, fecha_postulacion, estado)
                    VALUES (?, ?, ?, ?, NOW(), 'enviada')";

            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                die("Error en prepare: " . $conn->error);
            }

            $stmt->bind_param("iiss", $id_postulante, $id_oferta, $ruta_relativa, $mensaje);

            if ($stmt->execute()) {
                echo "<script>alert('Postulación enviada correctamente.'); window.location.href='../views/landing.php';</script>";
                exit;
            } else {
                if (file_exists($ruta_destino)) {
                    unlink($ruta_destino);
                }
                echo "<script>alert('Error al guardar la postulación.'); window.history.back();</script>";
                exit;
            }
        }
    }
}

// Ejecutar el controlador si se envía el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $controller = new PostulacionController();
    $controller->postular();
}
?>
