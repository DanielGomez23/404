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
    <link rel="stylesheet" href="../../public/css/styles.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #f8f9fa;
        }

        .main-container {
            display: flex;
            min-height: 100vh;
        }

        /* Panel izquierdo azul */
        .left-panel {
            flex: 1;
            background: linear-gradient(135deg, #4A90E2 0%, #357ABD 50%, #2E5A87 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
        }

        .brand-content {
            text-align: center;
            z-index: 1;
            position: relative;
        }

        .brand-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.1;
        }

        .brand-subtitle {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            opacity: 0.95;
        }

        .brand-description {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2.5rem;
            line-height: 1.5;
        }

        .register-link-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            display: inline-block;
        }

        .register-link-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        /* Panel derecho del formulario */
        .container {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        /* Título del formulario */
        .container h2 {
            background: transparent;
            color: #2d3748;
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            padding: 0;
            border-radius: 0;
            margin-bottom: 0.5rem;
            position: relative;
            box-shadow: none;
        }

        .container h2::after {
            content: 'Completa todos los campos para postularte';
            display: block;
            font-size: 1rem;
            font-weight: 400;
            color: #718096;
            margin-top: 0.5rem;
        }

        /* Formulario */
        .container form {
            background: transparent;
            padding: 2rem 0;
            border-radius: 0;
            box-shadow: none;
            border: none;
            animation: fadeInUp 0.8s ease-out;
            max-width: 500px;
            margin: 0 auto;
            width: 100%;
        }

        /* Labels */
        .container label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
            margin-top: 1.5rem;
            display: block;
            font-size: 1rem;
        }

        .container label:first-of-type {
            margin-top: 0;
        }

        /* Inputs de texto, email, tel */
        .container input[type="text"],
        .container input[type="email"],
        .container input[type="tel"] {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            font-family: 'Inter', sans-serif;
        }

        .container input[type="text"]:focus,
        .container input[type="email"]:focus,
        .container input[type="tel"]:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .container input[type="text"]:hover,
        .container input[type="email"]:hover,
        .container input[type="tel"]:hover {
            border-color: #cbd5e0;
        }

        .container input::placeholder {
            color: #a0aec0;
        }

        /* Input de archivo */
        .container input[type="file"] {
            width: 100%;
            padding: 1rem;
            border: 2px dashed #e2e8f0;
            border-radius: 8px;
            background: #f7fafc;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Inter', sans-serif;
        }

        .container input[type="file"]:hover {
            border-color: #4A90E2;
            background: #edf2f7;
        }

        .container input[type="file"]:focus {
            outline: none;
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
        }

        /* Textarea */
        .container textarea {
            width: 100%;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
            min-height: 100px;
            resize: vertical;
            font-family: 'Inter', sans-serif;
        }

        .container textarea:focus {
            border-color: #4A90E2;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.1);
            outline: none;
        }

        .container textarea:hover {
            border-color: #cbd5e0;
        }

        .container textarea::placeholder {
            color: #a0aec0;
        }

        /* Input hidden */
        .container input[type="hidden"] {
            display: none;
        }

        /* Botón de envío */
        .container input[type="submit"] {
            width: 100%;
            background: #4A90E2;
            border: none;
            padding: 1rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            color: white;
            cursor: pointer;
            margin-top: 1.5rem;
        }

        .container input[type="submit"]:hover {
            background: #357ABD;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(74, 144, 226, 0.3);
        }

        .container input[type="submit"]:active {
            transform: translateY(0);
        }

        /* Animaciones */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }
            
            .left-panel {
                min-height: 40vh;
                padding: 2rem 1rem;
            }
            
            .brand-title {
                font-size: 2rem;
            }
            
            .brand-subtitle {
                font-size: 1.2rem;
            }
            
            .container {
                padding: 2rem 1rem;
            }
        }

        @media (max-width: 480px) {
            .container form {
                padding: 0 0.5rem;
            }
            
            .brand-title {
                font-size: 1.5rem;
            }
            
            .brand-description {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Panel Izquierdo -->
        <div class="left-panel">
            <div class="brand-content">
                <h1 class="brand-title">Antioquia-unida</h1>
                <h2 class="brand-subtitle">¡Tu próxima oportunidad!</h2>
                <p class="brand-description">
                    Estás a un paso de postularte a esta gran oportunidad laboral. Completa el formulario y comparte tu experiencia con nosotros.
                </p>
                <a href="listVacantes.php" class="register-link-btn">
                    ← Volver a Ofertas
                </a>
            </div>
        </div>

        <!-- Panel Derecho - Formulario -->
        <div class="container">
            <h2>Formulario de Postulación</h2>

            <form action="../../controllers/postulacionController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id_oferta" value="<?= $_GET['id'] ?? ''; ?>">

                <label>Nombre completo:</label>
                <input type="text" name="nombre" 
                       value="<?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?>" required>

                <label>Correo electrónico:</label>
                <input type="email" name="correo" 
                       value="<?php echo htmlspecialchars($usuario['email'] ?? ''); ?>" required>

                <label>Teléfono:</label>
                <input type="text" name="telefono" required>

                <label>Adjuntar hoja de vida (PDF):</label>
                <input type="file" name="cv" accept=".pdf" required>

                <label>Mensaje o motivación:</label>
                <textarea name="mensaje" rows="4" placeholder="Cuéntanos por qué te interesa esta vacante..." required></textarea>

                <input type="submit" name="postular" value="Enviar Postulación">
            </form>
        </div>
    </div>
</body>
</html>