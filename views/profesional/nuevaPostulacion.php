<?php
session_start();
require_once "../../config/DATABASE.php"; // Carga la clase Database

// 🔹 Crear la conexión
$conn = Database::getConnection();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Validar conexión
    if (!$conn) {
        die("Error: No hay conexión a la base de datos.");
    }

    // Limpiar entradas
    $nombre   = mysqli_real_escape_string($conn, $_POST['nombre']);
    $correo   = mysqli_real_escape_string($conn, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $mensaje  = mysqli_real_escape_string($conn, $_POST['mensaje']);

    // 📁 Manejo de archivo CV (PDF)
    $ruta_destino = "";
    if (isset($_FILES["cv"]) && $_FILES["cv"]["error"] === 0) {

        // ✅ Carpeta dentro del mismo directorio
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
            echo "<script>alert('❌ Solo se permiten archivos PDF'); window.history.back();</script>";
            exit;
        }

        // Crear nombre único para el archivo
        $nombre_unico = time() . "_" . $cv_nombre;
        $ruta_destino = $directorio . $nombre_unico;

        // Mover archivo
        if (!move_uploaded_file($_FILES["cv"]["tmp_name"], $ruta_destino)) {
            echo "<script>alert('❌ Error al subir el archivo. Verifica permisos de la carpeta.'); window.history.back();</script>";
            exit;
        }

    } else {
        echo "<script>alert('❌ No se envió el archivo CV'); window.history.back();</script>";
        exit;
    }

    // Ruta relativa para guardar en BD
    $ruta_relativa = "hojas_de_vida/" . basename($ruta_destino);

    // Guardar en la base de datos
    $sql = "INSERT INTO postulaciones (nombre, correo, telefono, cv, mensaje, fecha_postulacion)
            VALUES ('$nombre', '$correo', '$telefono', '$ruta_relativa', '$mensaje', NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('✅ Postulación enviada correctamente.'); window.location.href='landing.php';</script>";
        exit;
    } else {
        // Si falla, eliminar el archivo subido
        if (file_exists($ruta_destino)) {
            unlink($ruta_destino);
        }
        echo "<script>alert('❌ Error al guardar en la base de datos.'); window.history.back();</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postularse a la Vacante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            color: #444;
        }
        input, textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            width: 100%;
        }
        input[type="submit"] {
            background-color: #667eea;
            color: white;
            cursor: pointer;
            border: none;
            font-weight: bold;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #5a6fd6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Formulario de Postulación</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Nombre completo:</label>
            <input type="text" name="nombre" required>

            <label>Correo electrónico:</label>
            <input type="email" name="correo" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Adjuntar hoja de vida (PDF):</label>
            <input type="file" name="cv" accept=".pdf" required>

            <label>Mensaje o motivación:</label>
            <textarea name="mensaje" rows="4" placeholder="Cuéntanos por qué te interesa esta vacante..." required></textarea>

            <input type="submit" value="Enviar Postulación">
        </form>
    </div>
</body>
</html>
