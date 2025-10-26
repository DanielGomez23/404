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
