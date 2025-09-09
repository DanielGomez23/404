<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antioquia Unida - Networking Profesional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="stylesheet" href="../public/css/landing.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
            <i class="fas fa-shield-alt me-2"></i>
                Antioquia-unida
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#empresas">Empresas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profesionales">Profesionales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                </ul>
                
            <div class="d-flex">
                    <a href="login.php" class="btn btn-outline-custom">Iniciar sesión</a>
                    <a href="registro.php" class="btn btn-outline-custom">Registro</a>
            </div>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center hero-content">
                    <h1 class="hero-title">
                        Conecta con profesionales y<br>
                        empresas cerca de ti
                    </h1>
                    <p class="hero-subtitle">Donde las ideas y el talento se transforman en oportunidades </p>

                    <div class="cta-buttons">
                        <a class="btn btn-orange pulse" href="registro.php"> Comienza</a>
                        <a class="btn btn-orange" href="funcionamiento.php">¿Cómo funciona?</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="empresas" class="features-section">
        <div class="container">
            <h2 class="section-title">¿Por qué elegir Antioquia-unida?</h2>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating">
                        <div class="feature-icon">
                            <i data-lucide="users"></i>
                        </div>
                        <h3 class="feature-title">Red profesional activa</h3>
                        <p class="feature-description">
                            Relacionate con expertos de tu sector, amplía tu círculo profesional y encuentra oportunidades para trabajar en conjunto.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating" style="animation-delay: 0.5s;">
                        <div class="feature-icon">
                            <i data-lucide="building-2"></i>
                        </div>
                        <h3 class="feature-title">Empresas</h3>
                        <p class="feature-description">
                            Explora ofertas laborales de empresas confiables y encuentra el trabajo que mejor se adapte a tu experiencia y habilidades.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating" style="animation-delay: 1s;">
                        <div class="feature-icon">
                            <i data-lucide="user-check"></i>
                        </div>
                        <h3 class="feature-title">Domina tu Perfil Profesional</h3>
                        <p class="feature-description">
                            Controla tu perfil, consulta tus estadísticas y mantén tu presencia profesional siempre actualizada.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating" style="animation-delay: 1.5s;">
                        <div class="feature-icon">
                            <i data-lucide="link"></i>
                        </div>
                        <h3 class="feature-title">Conexiones Estratégicas</h3>
                        <p class="feature-description">
                            Emparejamos perfiles y empresas según intereses, habilidades y metas en común para generar oportunidades efectivas.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating" style="animation-delay: 2s;">
                        <div class="feature-icon">
                            <i data-lucide="message-circle"></i>
                        </div>
                        <h3 class="feature-title">Comunicación Profesional Protegida</h3>
                        <p class="feature-description">
                            Interactúa con tus contactos de manera segura y eficiente usando nuestro sistema de mensajería interno.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4 animate-on-scroll">
                    <div class="feature-card floating" style="animation-delay: 2.5s;">
                        <div class="feature-icon">
                            <i data-lucide="trending-up"></i>
                        </div>
                        <h3 class="feature-title">Impulsa tu Presencia Profesional</h3>
                        <p class="feature-description">
                            Descubre qué tan lejos ha llegado tu perfil y encuentra oportunidades para aumentar tu alcance.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Sección de imagen de fondo de pantalla completa -->
<section class="fullscreen-background-section d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="overlay-content text-center">
                    <h1 class="overlay-title display-2 display-md-1 mb-4">
                        Impulsa tu carrera profesional
                    </h1>
                    <p class="overlay-subtitle lead fs-4 fs-md-3 mb-5">
                        Únete a la red más grande de profesionales en Antioquia y descubre oportunidades que transformarán tu futuro.
                    </p>
                    <div class="cta-buttons">
                        <a class="btn btn-orange pulse" href="registro.php"> Unete ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer-section">
    

    <!-- Main Footer -->
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <!-- Columna 1: Información de la empresa -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand">
                        <h4 class="brand-title">Antioquia-unida</h4>
                        <p class="brand-description">
                            Conectando el talento antioqueño con las mejores oportunidades. 
                            Construyemos puentes entre profesionales y empresas para crear un futuro próspero.
                        </p>
                        <div class="social-links">
                            <a href="https://x.com/vanegas85183" class="social-link floating" style="animation-delay: 0.1s;">
                                <i data-lucide="twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/nicolas-vanegas-a7b35a306/" class="social-link floating" style="animation-delay: 0.2s;">
                                <i data-lucide="linkedin"></i>
                            </a>
                            <a href="https://www.instagram.com/_.da_ni._/" class="social-link floating" style="animation-delay: 0.3s;">
                                <i data-lucide="instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@nicolasvanegas2655" class="social-link floating" style="animation-delay: 0.3s;">
                                <i data-lucide="youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Columna 2: Enlaces rápidos -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Navegación</h5>
                    <ul class="footer-links">
                        <li><a href="#inicio">Inicio</a></li>
                        <li><a href="#empresas">Empresas</a></li>
                        <li><a href="#profesionales">Profesionales</a></li>
                        <li><a href="funcionamiento.php">¿Cómo funciona?</a></li>
                        <li><a href="#contacto">Contacto</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Para profesionales -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Profesionales</h5>
                    <ul class="footer-links">
                        <li><a href="registro.php">Crear perfil</a></li>
                        <li><a href="login.php">Iniciar sesión</a></li>
                        <li><a href="#">Buscar empleos</a></li>
                        <li><a href="#">Networking</a></li>
                        <li><a href="#">Mi perfil</a></li>
                    </ul>
                </div>

                <!-- Columna 4: Para empresas -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Empresas</h5>
                    <ul class="footer-links">
                        <li><a href="#">Registrar empresa</a></li>
                        <li><a href="#">Publicar empleos</a></li>
                        <li><a href="#">Buscar talento</a></li>
                        <li><a href="#">Planes empresariales</a></li>
                        <li><a href="#">Portal empresarial</a></li>
                    </ul>
                </div>

                <!-- Columna 5: Contacto -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Contacto</h5>
                    <div class="contact-info">
                        <div class="contact-item mb-3">
                            <i data-lucide="map-pin" class="contact-icon"></i>
                            <span>Rionegro, Antioquia Colombia</span>
                        </div>
                        <div class="contact-item mb-3">
                            <i data-lucide="mail" class="contact-icon"></i>
                            <span>antioquia_unida@gmail.com</span>
                        </div>
                        <div class="contact-item">
                            <i data-lucide="phone" class="contact-icon"></i>
                            <span>+57 3206580651</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright mb-0">
                        &copy; 2025 Antioquia-unida. Todos los derechos reservados.
                    </p>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-links">
                        <a href="#">Política de Privacidad</a>
                        <a href="#">Términos de Uso</a>
                        <a href="#">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Decorative elements -->
    <div class="footer-decoration">
        <div class="decoration-circle circle-1"></div>
        <div class="decoration-circle circle-2"></div>
        <div class="decoration-circle circle-3"></div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        // Observe all elements with animate-on-scroll class
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

    </script>
</body>
</html>