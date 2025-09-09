<<<<<<< HEAD
<?php session_start(); ?>
=======
>>>>>>> 67422f1 (Avance en login,registro y landing page)
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Iniciar Sesión</h3>
                </div>
                <div class="card-body">
                    <form action="../controllers/AuthController.php" method="POST">
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" name="rol" id="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="postulante">Postulante</option>
                                <option value="reclutador">Reclutador</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100">Ingresar</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>





























<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Antioquia-unida</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    
   <link rel="stylesheet" href="../public/css/login.css">

</head>
<body>
    <div class="container-fluid main-container">
        <div class="row g-0">
            <!-- Left Panel -->
            <div class="col-lg-6 left-panel">
                <div>
                    <div class="logo">Antioquia-unida</div>
                    <h2>¡Bienvenido de vuelta!</h2>
                    <p>Conecta con profesionales y empresas cerca de ti. Donde las ideas y el talento se transforman en oportunidades.</p>
                    <a href="registro.php" class="switch-btn" onclick="switchToRegister()">¿No tienes cuenta? Regístrate</a>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="col-lg-6 right-panel">
                <div class="form-container">
                    <h1 class="form-title">Iniciar Sesión</h1>
                    <p class="form-subtitle">Accede a tu cuenta profesional</p>

                    <form id="loginForm" novalidate>
                        <!-- Email Field -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input 
                                    type="email" 
                                    class="form-control" 
                                    id="email" 
                                    placeholder="tu@email.com" 
                                    required
                                >
                                <div class="validation-tooltip" id="emailTooltip" style="display: none;">
                                    Completa este campo
                                </div>
                            </div>
                            <div class="invalid-feedback" id="emailFeedback"></div>
                            <div class="valid-feedback" id="emailValidFeedback"></div>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input 
                                    type="password" 
                                    class="form-control" 
                                    id="password" 
                                    placeholder="••••••••" 
                                    required
                                >
                            </div>
                            <div class="invalid-feedback" id="passwordFeedback"></div>
                        </div>

                        <!-- Options Row -->
                        <div class="login-options">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">
                                    Recordarme
                                </label>
                            </div>
                            <a href="#" class="forgot-password" onclick="forgotPassword()">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                            <span id="btnText">Iniciar Sesión</span>
                        </button>

                        <!-- Social Login Divider -->
                        <div class="social-divider">
                            <span>O continúa con</span>
                        </div>

                        <!-- Social Login Buttons -->
                        <div class="row g-2">
                            <div class="col-6">
                                <a href="#" class="btn btn-social" onclick="socialLogin('google')">
                                    <i class="bi bi-google"></i>
                                    Google
                                </a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-social" onclick="socialLogin('linkedin')">
                                    <i class="bi bi-linkedin"></i>
                                    LinkedIn
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <script>
        // Email validation function
        function validateEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }

        // Real-time email validation
        document.getElementById('email').addEventListener('input', function() {
            const email = this.value;
            const emailFeedback = document.getElementById('emailFeedback');
            const emailValidFeedback = document.getElementById('emailValidFeedback');
            const emailTooltip = document.getElementById('emailTooltip');

            if (email === '') {
                this.classList.remove('is-valid', 'is-invalid');
                emailTooltip.style.display = 'block';
                emailFeedback.textContent = '';
                emailValidFeedback.textContent = '';
            } else if (validateEmail(email)) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                emailTooltip.style.display = 'none';
                emailFeedback.textContent = '';
                emailValidFeedback.textContent = 'Correo válido';
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                emailTooltip.style.display = 'none';
                emailFeedback.textContent = 'Por favor ingresa un correo válido';
                emailValidFeedback.textContent = '';
            }
        });

        // Hide tooltip when email field gets focus
        document.getElementById('email').addEventListener('focus', function() {
            const emailTooltip = document.getElementById('emailTooltip');
            if (this.value === '') {
                emailTooltip.style.display = 'none';
            }
        });

        // Show tooltip when email field loses focus and is empty
        document.getElementById('email').addEventListener('blur', function() {
            const emailTooltip = document.getElementById('emailTooltip');
            if (this.value === '') {
                emailTooltip.style.display = 'block';
            }
        });

        // Password validation
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const passwordFeedback = document.getElementById('passwordFeedback');

            if (password === '') {
                this.classList.remove('is-valid', 'is-invalid');
                passwordFeedback.textContent = '';
            } else if (password.length < 6) {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
                passwordFeedback.textContent = 'La contraseña debe tener al menos 6 caracteres';
            } else {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
                passwordFeedback.textContent = '';
            }
        });

        // Form submission
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;

            // Validate form
            let isValid = true;

            // Email validation
            if (!email) {
                document.getElementById('email').classList.add('is-invalid');
                document.getElementById('emailFeedback').textContent = 'El correo es requerido';
                isValid = false;
            } else if (!validateEmail(email)) {
                document.getElementById('email').classList.add('is-invalid');
                document.getElementById('emailFeedback').textContent = 'Por favor ingresa un correo válido';
                isValid = false;
            }

            // Password validation
            if (!password) {
                document.getElementById('password').classList.add('is-invalid');
                document.getElementById('passwordFeedback').textContent = 'La contraseña es requerida';
                isValid = false;
            }

            if (!isValid) {
                return;
            }

            // Show loading state
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            submitBtn.disabled = true;
            btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Iniciando sesión...';

            // Collect form data
            const formData = {
                email: email,
                password: password,
                rememberMe: rememberMe
            };

            // Simulate API call
            setTimeout(() => {
                // Reset button
                submitBtn.disabled = false;
                btnText.textContent = 'Iniciar Sesión';

                // Log the data (replace with actual API call)
                console.log('Login Data:', formData);
                
                alert('¡Login exitoso! Revisa los datos en la consola.');
            }, 2000);
        });

        function switchToRegister() {
            alert('Redirigiendo al formulario de registro...');
            // Aquí implementarías la navegación al registro
        }

        function forgotPassword() {
            alert('Función de recuperar contraseña...');
            // Aquí implementarías la lógica de recuperación de contraseña
        }

        function socialLogin(provider) {
            alert(`Iniciando sesión con ${provider}...`);
            // Aquí implementarías la lógica de OAuth
        }

        // Input focus effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                const inputGroup = this.closest('.input-group');
                if (inputGroup) {
                    inputGroup.classList.add('focused');
                }
            });

            input.addEventListener('blur', function() {
                const inputGroup = this.closest('.input-group');
                if (inputGroup) {
                    inputGroup.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>