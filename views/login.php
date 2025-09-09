<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/login.css">
   
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

        <!-- Panel Derecho - Formulario -->
        <div class="right-panel">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="form-title">Iniciar Sesión</h2>
                    <p class="form-subtitle">Accede a tu cuenta profesional</p>
                </div>

                <form action="../controllers/AuthController.php" method="POST">
                    <!-- Selector de Rol -->
                    <div class="form-group">
                        <label for="rol" class="form-label">Tipo de Usuario</label>
                        <div class="input-icon">
                            <i class="fas fa-user-tag"></i>
                            <select class="form-select" name="rol" id="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="postulante">Postulante</option>
                                <option value="reclutador">Reclutador</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" name="correo" id="correo" 
                                   placeholder="tu@correo.com" required>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="form-group">
                        <label for="contrasena" class="form-label">Contraseña</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Botón de iniciar sesión -->
                    <button type="submit" name="login" class="btn-login" >
                        Ingresar
                    </button>

                    <!-- Enlace para recuperar contraseña -->
                    <div class="additional-options">
                        <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>
                </form>

                <!-- otras posibiliades de iniciar sesion -->
                <div class="social-login">
                    <div class="social-divider">O inicia sesión con</div>
                    <div class="social-buttons">
                        <a href="#" class="social-btn">
                            <i class="fab fa-google"></i>
                            Google
                        </a>
                        <a href="#" class="social-btn">
                            <i class="fab fa-linkedin"></i>
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
       
        document.getElementById('rol').addEventListener('change', function() {
            console.log('Rol seleccionado:', this.value);
        });

        // Guardar el rol seleccionado 
        const rolSelect = document.getElementById('rol');
        const savedRole = localStorage.getItem('selectedRole');
        if (savedRole) {
            rolSelect.value = savedRole;
        }

        rolSelect.addEventListener('change', function() {
            localStorage.setItem('selectedRole', this.value);
        });
    </script>
</body>
</html>