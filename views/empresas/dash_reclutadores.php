<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/dash_reclutador.css">
    <link rel="stylesheet" href="../../public/css/header.css">
    <link rel="stylesheet" href="../../public/css/footer.css">
</head>
<body>
    <!-- Header Administrativo -->
<?php
$rol_usuario = "Empresa"; 
include_once '../header.php';
?>

    <!-- Encabezado Admin -->
    <section class="admin-hero">
        <div class="container">
            <div class="fade-in">
                <h1 class="admin-title">
                    <i class="fas fa-tachometer-alt me-3"></i>
                    Panel de Reclutador
                </h1>
                <p class="admin-subtitle">
                    Gestiona y supervisa toda la plataforma de Antioquia-Unida desde aquí
                </p>
                
                <div class="admin-stats">
                    <div class="stat-item">
                        <span class="stat-number">5</span>
                        <div class="stat-label">Vacantes Activas</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">400</span>
                        <div class="stat-label">Postulaciones recibidas</div>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">20</span>
                        <div class="stat-label">Contrataciones realizadas</div>
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
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="card-title">Vacantes</h3>
                    <p class="card-description">
                    </p>
                    <a href="new_vacancy.php" class="card-action">
                        <i class="fas fa-user-cog me-2"></i>
                        Crear vacantes
                    </a>
                </div>

                <!-- Gestión de Empresas -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="card-title">Postulantes</h3>
                    <p class="card-description">
                    </p>
                    <a href="gestion_postulantes.php" class="card-action">
                        <i class="fas fa-building me-2"></i>
                        Ver 
                    </a>
                </div>

                <!-- Ofertas Laborales -->
                <div class="admin-card fade-in">
                    <div class="card-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3 class="card-title">Mis Vacantes</h3>
                    <p class="card-description">
                    </p>
                    <a href="misVacantes.php" class="card-action">
                        <i class="fas fa-briefcase me-2"></i>
                        Gestiona tu perfil
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

    <?php include_once '../footer.php'; ?>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>