<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/registro.css">
    
</head>
<body>
    <div class="main-container">
        <!-- Panel Izquierdo -->
        <div class="left-panel">
            <div class="brand-content">
                <h1 class="brand-title">Antioquia-unida</h1>
                <h2 class="brand-subtitle">¡Únete a nosotros!</h2>
                <p class="brand-description">
                    Crea tu cuenta y descubre un mundo de oportunidades profesionales esperándote.
                </p>
                <a href="login.php" class="login-link-btn">
                    ¿Ya tienes cuenta? Inicia sesión
                </a>
            </div>
        </div>

        <!-- Panel Derecho - Formulario -->
        <div class="right-panel">
            <div class="form-container">
                <div class="form-header">
                    <h2 class="form-title">Crear Cuenta</h2>
                    <p class="form-subtitle">Únete a nuestra red profesional</p>
                </div>

                <form action="../controllers/AuthController.php" method="POST">
                    <!-- Selector de tipo de usuario -->
                    <div class="user-type-selector">
                        <label class="selector-label">¿Cómo te quieres registrar?</label>
                        <div class="user-type-options">
                            <div class="user-type-option">
                                <input type="radio" name="rol" value="postulante" id="profesional" class="user-type-input" required>
                                <label for="profesional" class="user-type-card">
                                    <div class="user-type-icon">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <div class="user-type-title">Profesional</div>
                                    <div class="user-type-desc">Busca oportunidades</div>
                                </label>
                            </div>
                            <div class="user-type-option">
                                <input type="radio" name="rol" value="reclutador" id="empresa" class="user-type-input" required>
                                <label for="empresa" class="user-type-card">
                                    <div class="user-type-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="user-type-title">Empresa </div>
                                    <div class="user-type-desc">Encuentra talento</div>
                                </label>
                            </div>
                             <div class="user-type-option">
                                <input type="radio" name="rol" value="administrador" id="admin" class="user-type-input" required>
                                <label for="admin" class="user-type-card">
                                    <div class="user-type-icon">
                                        <i class="fas fa-building"></i>
                                    </div>
                                    <div class="user-type-title">Administrador</div>
                                    <div class="user-type-desc">El poder en tus manos</div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Cédula -->
                    <div class="form-group">
                        <label for="cedula" class="form-label">Número de Cédula</label>
                        <div class="input-icon">
                            <i class="fas fa-id-card"></i>
                            <input type="number" class="form-control" name="cedula" id="cedula" 
                                   placeholder="Tu número de cédula" required>
                        </div>
                    </div>

                    <!-- Nombre Completo -->
                    <div class="form-group">
                        <label for="nombre" class="form-label">Nombre Completo</label>
                        <div class="input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control" name="nombre" id="nombre" 
                                   placeholder="Tu nombre completo" required>
                        </div>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="form-group">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <div class="input-icon">
                            <i class="fas fa-envelope"></i>
                            <input type="email" class="form-control" name="correo" id="correo" 
                                   placeholder="ejemplo@correo.com" required>
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

                    <!-- Confirmar Contraseña -->
                    <div class="form-group">
                        <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña</label>
                        <div class="input-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" class="form-control" name="confirmar_contrasena" id="confirmar_contrasena" 
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <!-- Términos y condiciones -->
                    <div class="terms-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            Acepto los <a href="#">términos y condiciones</a>
                        </label>
                    </div>

                    <!-- Botón de crear cuenta -->
                    <button type="submit" name="registrar" class="btn-create">
                        Crear Cuenta
                    </button>
                </form>

                <!-- Social Login -->
                <div class="social-login">
                    <div class="social-divider">O regístrate con</div>
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
        // Validación de contraseñas
        document.getElementById('confirmar_contrasena').addEventListener('input', function() {
            const password = document.getElementById('contrasena').value;
            const confirmPassword = this.value;
            
            if (password !== confirmPassword) {
                this.setCustomValidity('Las contraseñas no coinciden');
            } else {
                this.setCustomValidity('');
            }
        });

        // Actualizar placeholder del selector de rol
        document.querySelectorAll('input[name="rol"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                // Aquí puedes agregar lógica adicional si necesitas
                console.log('Rol seleccionado:', this.value);
            });
        });
    </script>
</body>
</html>