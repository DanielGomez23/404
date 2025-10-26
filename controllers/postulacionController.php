<?php
session_start();
require_once "../config/Database.php";

class PostulacionController {

    public function postular() {
        $conn = Database::getConnection();

        if (!$conn) {
            die("Error: No hay conexión con la BD.");
        }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id_oferta = intval($_POST['id_oferta'] ?? 0);
            $nombre = $conn->real_escape_string($_POST['nombre'] ?? '');
            $correo = $conn->real_escape_string($_POST['correo'] ?? '');
            $telefono = $conn->real_escape_string($_POST['telefono'] ?? '');
            $mensaje = $conn->real_escape_string($_POST['mensaje'] ?? '');

            if ($id_oferta <= 0) {
                echo "<script>alert('Vacante no válida.'); history.back();</script>";
                exit;
            }

            if (!isset($_FILES['cv']) || $_FILES['cv']['error'] !== 0) {
                echo "<script>alert('Debes subir tu hoja de vida en PDF.'); history.back();</script>";
                exit;
            }

            $dir = __DIR__ . "/../../hojas_de_vida/";
            if (!is_dir($dir)) mkdir($dir, 0777, true);

            $ext = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
            if ($ext !== "pdf") {
                echo "<script>alert('Solo se aceptan archivos PDF.'); history.back();</script>";
                exit;
            }

            $cv_name = time() . "_" . basename($_FILES['cv']['name']);
            $dest = $dir . $cv_name;

            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $dest)) {
                echo "<script>alert('Error al subir el archivo.'); history.back();</script>";
                exit;
            }

            $cv_path = "hojas_de_vida/" . $cv_name;

            $sql = "INSERT INTO postulaciones (id_oferta, nombre, correo, telefono, cv, mensaje, fecha_postulacion, estado)
                    VALUES (?, ?, ?, ?, ?, ?, NOW(), 'enviada')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssss", $id_oferta, $nombre, $correo, $telefono, $cv_path, $mensaje);

            if ($stmt->execute()) {
                echo "<script>alert('Postulación enviada con éxito'); window.location.href='../views/landing.php';</script>";
                exit;
            } else {
                unlink($dest);
                echo "<script>alert('Error guardando datos'); history.back();</script>";
                exit;
            }
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    (new PostulacionController())->postular();
}
