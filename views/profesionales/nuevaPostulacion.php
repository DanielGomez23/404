<?php
session_start();
require_once '../../config/DATABASE.php';

// Verificar si llega el ID de la vacante
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
            alert('No se especificó la vacante a postular.');
            window.location.href='../landing.php';
          </script>";
    exit;
}

$id_oferta = intval($_GET['id']); // id de la vacante seleccionada

// Puedes dejar vacío el usuario si no hay sesión
$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : [
    'nombre' => '',
    'email'  => ''
];

// 🔴 Se elimina la verificación de login obligatorio
/*
if (!isset($_SESSION['cedula']) || $_SESSION['usuario_rol'] !== 'postulante') {
    echo "<script>
            alert('Debes iniciar sesión como postulante para aplicar.');
            window.location.href='../login.php';
          </script>";
    exit;
}
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postularse</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    link
    
</head>
<body>
    <div class="main-container">
        <!-- Panel Izquierdo -->
        <div class="left-panel">
            <div class="brand-content">
                <h1 class="brand-title">Antioquia-unida</h1>
                <h2 class="brand-subtitle">¡Bienvenido de nuevo!</h2>
                <p class="brand-description">
                    Inicia sesión y continúa construyendo tu futuro profesional con nosotros.
                </p>
                <a href="registro.php" class="register-link-btn">
                    ¿No tienes cuenta? Regístrate
                </a>
            </div>
        </div>

    <div class="container">
        <h2>Formulario de Postulación</h2>

        <form action="../../controllers/postulacionController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_oferta" value="<?= $_GET['id']; ?>">


            <label>Nombre completo:</label>
            <input type="text" name="nombre" 
                   value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

            <label>Correo electrónico:</label>
            <input type="email" name="correo" 
                   value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

            <label>Teléfono:</label>
            <input type="text" name="telefono" required>

            <label>Adjuntar hoja de vida (PDF):</label>
            <input type="file" name="cv" accept=".pdf" required>

            <label>Mensaje o motivación:</label>
            <textarea name="mensaje" rows="4" placeholder="Cuéntanos por qué te interesa esta vacante..." required></textarea>

            <input type="submit" name="postular" value="Enviar Postulación">
        </form>
    </div>
</body>
</html>
