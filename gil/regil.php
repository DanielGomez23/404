<?php session_start(); ?>

    <title>Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3>Registro de Usuario</h3>
                </div>
                <div class="card-body">
                    <form action="../controllers/AuthController.php" method="POST">
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula</label>
                            <input type="number" class="form-control" name="cedula" id="cedula" required>
                        </div>
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" required>
                        </div>
                        <div class="mb-3">
                            <label for="contrasena" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena" required>
                        </div>
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <select class="form-select" name="rol" id="rol" required>
                                <option value="">Seleccione un rol</option>
                                <option value="postulante">Postulante</option>
                                <option value="reclutador">Reclutador</option>
                                <option value="administrador">Administrador</option>
                            </select>
                        </div>
                        <button type="submit" name="registrar" class="btn btn-success w-100">Registrarse</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
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
    <title>Crear Cuenta - Antioquia-unida</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../public/css/registro.css">
    
    
</head>
<body>
    <div class="container-fluid main-container">
        <div class="row g-0">
            <div class="col-lg-6 left-panel">
                <div>
                    <div class="logo">Antioquia-unida</div>
                    <h2>¡Únete a nosotros!</h2>
                    <p>Crea tu cuenta y descubre un mundo de oportunidades profesionales esperándote.</p>
                    <a href="login.php" class="switch-btn" onclick="switchToLogin()">¿Ya tienes cuenta? Inicia sesión</a>
                </div>
            </div>

            <div class="col-lg-6 right-panel">
                <div class="form-container">
                    <h1 class="form-title">Crear Cuenta</h1>
                    <p class="form-subtitle">Únete a nuestra red profesional</p>

                    <form id="registerForm">
                        <div class="mb-4">
                            <label class="form-label">¿Cómo te quieres registrar?</label>
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="role-card" data-role="professional" onclick="selectRole('professional')">
                                        <div class="role-icon">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <div class="role-title">Profesional</div>
                                        <div class="role-desc">Busca oportunidades</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="role-card selected" data-role="company" onclick="selectRole('company')">
                                        <div class="role-icon">
                                            <i class="bi bi-building-fill"></i>
                                        </div>
                                        <div class="role-title">Empresa</div>
                                        <div class="role-desc">Encuentra talento</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="fullName" class="form-label" id="nameLabel">Nombre Completo</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <input type="text" class="form-control" id="fullName" placeholder="Tu nombre completo" required>
                            </div>
                        </div>

                        <div class="mb-3 company-field" id="companyNameField">
                            <label for="companyName" class="form-label">Nombre de la Empresa</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-building-fill"></i>
                                </span>
                                <input type="text" class="form-control" id="companyName" placeholder="Nombre de tu empresa">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                <input type="email" class="form-control" id="email" placeholder="tu@email.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" id="password" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="acceptTerms" required>
                                <label class="form-check-label" for="acceptTerms">
                                    Acepto los <a href="#" target="_blank">términos y condiciones</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary-custom" id="submitBtn">
                            <span id="btnText">Crear Cuenta</span>
                        </button>

                        <div class="social-divider">
                            <span>O regístrate con</span>
                        </div>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

    <script>
        let selectedRole = 'company'; 

        function selectRole(role) {
        
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
            });

            document.querySelector(`[data-role="${role}"]`).classList.add('selected');
            
            selectedRole = role;

            // Handle company name field and labels
            const companyField = document.getElementById('companyNameField');
            const companyInput = document.getElementById('companyName');
            const nameLabel = document.getElementById('nameLabel');
            const nameInput = document.getElementById('fullName');

            if (role === 'company') {
              
                companyField.classList.add('show');
                companyInput.required = true;
                
     
                nameLabel.textContent = 'Nombre del Representante';
                nameInput.placeholder = 'Nombre del representante legal';
            } else {
                companyField.classList.remove('show');
                companyInput.required = false;
                companyInput.value = '';
                
                nameLabel.textContent = 'Nombre Completo';
                nameInput.placeholder = 'Tu nombre completo';
            }
        }

        function switchToLogin() {
            alert('Redirigiendo al formulario de login...');
        }

        function socialLogin(provider) {
            alert(`Registrándose con ${provider}...`);
        }

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;

            if (password !== confirmPassword) {
                alert('Las contraseñas no coinciden');
                return;
            }

            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            
            submitBtn.disabled = true;
            btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Creando cuenta...';

            const formData = {
                name: document.getElementById('fullName').value,
                email: document.getElementById('email').value,
                password: password,
                role: selectedRole,
                acceptTerms: document.getElementById('acceptTerms').checked
            };

            if (selectedRole === 'company') {
                formData.companyName = document.getElementById('companyName').value;
            }

            setTimeout(() => {
                submitBtn.disabled = false;
                btnText.textContent = 'Crear Cuenta';

                console.log('Registration Data:', formData);
                
                alert('¡Cuenta creada exitosamente! Revisa los datos en la consola.');
            }, 2000);
        });

        document.addEventListener('DOMContentLoaded', function() {
            selectRole('company');
        });

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
