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
            // Limpiar entradas
            $nombre   = mysqli_real_escape_string($conn, $_POST['nombre']);
            $correo   = mysqli_real_escape_string($conn, $_POST['correo']);
            $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
            $mensaje  = mysqli_real_escape_string($conn, $_POST['mensaje']);

            // Manejo de archivo CV (PDF)
            $ruta_destino = "";
            if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === 0) {
                // Carpeta de destino absoluta
                $directorio = __DIR__ . "/../../hojas_de_vida/";

                // Crear carpeta si no existe
                if (!is_dir($directorio)) {
                    if (!mkdir($directorio, 0777, true)) {
                        die("Error al crear la carpeta de destino para hojas de vida. Ruta: " . $directorio);
                    }
                }

                $cv_nombre = basename($_FILES["cv"]["name"]);
                $tipo_archivo = strtolower(pathinfo($cv_nombre, PATHINFO_EXTENSION));

                // Validar tipo PDF
                if ($tipo_archivo !== "pdf") {
                    echo "<script>alert('Solo se permiten archivos PDF'); window.history.back();</script>";
                    exit;
                }

                // Crear nombre único para el archivo
                $nombre_unico = time() . "_" . $cv_nombre;
                $ruta_destino = $directorio . $nombre_unico;

                // Mover archivo
                if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $ruta_destino)) {
                    echo "<script>alert('Error al subir el archivo. Verifica permisos de la carpeta.'); window.history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('No se envió el archivo CV'); window.history.back();</script>";
                exit;
            }

            // Ruta relativa para guardar en BD
            $ruta_relativa = "hojas_de_vida/" . basename($ruta_destino);

            // Guardar en la base de datos
            $sql = "INSERT INTO postulaciones (nombre, correo, telefono, cv, mensaje, fecha_postulacion)
                    VALUES ('$nombre', '$correo', '$telefono', '$ruta_relativa', '$mensaje', NOW())";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Postulación enviada correctamente.'); window.location.href='../views/landing.php';</script>";
                exit;
            } else {
                // Si falla, eliminar el archivo subido
                if (file_exists($ruta_destino)) {
                    unlink($ruta_destino);
                }
                echo "<script>alert('Error al guardar en la base de datos.'); window.history.back();</script>";
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
