<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/dash_admin.css">
</head>
<body>
    <!-- Header Administrativo -->
    <nav class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="navbar-brand">
                    <i class="fas fa-shield-alt me-2"></i>
                    Antioquia-Unida
                    <span class="admin-badge">ADMIN</span>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="nav-links d-none d-md-flex">
                        <a href="#" class="nav-link">Dashboard</a>
                        <a href="#" class="nav-link">Reportes</a>
                        <a href="#" class="nav-link">Configuración</a>
                    </div>
                    
                    <a href="../logout.php" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Encabezado Admin -->
    <section class="admin-hero">
        <div class="container">
            <div class="fade-in">
                <h1 class="admin-title">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    Panel de Administración
                </h1>
                <p class="admin-subtitle">
                    Gestiona y supervisa toda la plataforma de Antioquia-Unida desde aquí
                </p>
                
                <div class="admin-stats">
                    <div class="stat-item">
                        <span class="stat-number">1,247</span>
                        <div class="stat-label">Usuarios Activos</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">200</span>
                        <div class="stat-label">Empresas</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">156</span>
                        <div class="stat-label">Ofertas Laborales</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Panel de Administración -->
    <section class="admin-panel">
        <div class="container">
            <h2 class="panel-title">Herramientas de Gestión</h2>
            
            <div class="admin-grid">
                <!-- Gestión de Usuarios -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-title">Gestión de Usuarios</h3>
                    <p class="card-description">
                        Administra todos los usuarios de la plataforma, postulantes, reclutadores y sus permisos.
                    </p>
                    <a href="../gestion_usuarios.php" class="card-action">
                        <i class="fas fa-user-cog me-2"></i>
                        Gestionar Usuarios
                    </a>
                </div>

                <!-- Gestión de Empresas -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="card-title">Empresas Registradas</h3>
                    <p class="card-description">
                        Supervisa y valida las empresas registradas, sus ofertas de trabajo y actividad.
                    </p>
                    <a href="gestion_empresas.php" class="card-action">
                        <i class="fas fa-building me-2"></i>
                        Ver Empresas
                    </a>
                </div>

                <!-- Ofertas Laborales -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="card-title">Ofertas Laborales</h3>
                    <p class="card-description">
                        Modera y gestiona todas las ofertas de trabajo publicadas en la plataforma.
                    </p>
                    <a href="gestion_ofertas.php" class="card-action">
                        <i class="fas fa-briefcase me-2"></i>
                        Gestionar Ofertas
                    </a>
                </div>

                <!-- Reportes y Analíticas -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h3 class="card-title">Reportes y Analíticas</h3>
                    <p class="card-description">
                        Genera reportes detallados sobre el uso de la plataforma y estadísticas clave.
                    </p>
                    <a href="reportes.php" class="card-action">
                        <i class="fas fa-chart-line me-2"></i>
                        Ver Reportes
                    </a>
                </div>

                <!-- Configuración del Sistema -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="card-title">Configuración</h3>
                    <p class="card-description">
                        Ajusta la configuración general del sistema, parámetros y opciones avanzadas.
                    </p>
                    <a href="configuracion.php" class="card-action">
                        <i class="fas fa-cog me-2"></i>
                        Configurar Sistema
                    </a>
                </div>

                <!-- Mensajería y Comunicación -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h3 class="card-title">Comunicación</h3>
                    <p class="card-description">
                        Gestiona mensajes del sistema, notificaciones y comunicación con usuarios.
                    </p>
                    <a href="mensajeria.php" class="card-action">
                        <i class="fas fa-paper-plane me-2"></i>
                        Centro de Mensajes
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>