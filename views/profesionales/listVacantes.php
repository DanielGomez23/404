<?php

SESSION_START();

require_once '../../config/DATABASE.php';
require_once '../../models/usuarios.php';

$conn = Database::getConnection();
$usuarioModel = new Usuario($conn);

$vacantes = $usuarioModel->obtenerVacantes();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/listar_vacantes.css">
</head>
<body>
    <!-- Header Profesional -->
    <nav class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="navbar-brand">
                    <i class="fas fa-shield-alt me-2"></i>
                    Antioquia-Unida
                    <span class="admin-badge">profesional</span>
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


<!-- Filtros -->
<div class="container">
    <div class="filters-section fade-in">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" class="form-control filter-input" placeholder="Buscar por título o empresa...">
            </div>
            <div class="col-md-3">
                <select class="form-select filter-input">
                    <option selected>Todas las categorías</option>
                    <option>Tecnología</option>
                    <option>Ventas</option>
                    <option>Administración</option>
                    <option>Producción</option>
                    <option>Servicio al Cliente</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select filter-input">
                    <option selected>Todas las ciudades</option>
                    <option>Medellín</option>
                    <option>Bello</option>
                    <option>Envigado</option>
                    <option>Itagüí</option>
                    <option>Rionegro</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-filter w-100">
                    <i class="fas fa-search me-2"></i>
                    Buscar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Lista de Vacantes -->
<div class="row">
    <?php foreach ($vacantes as $vacante): ?>
        <div class="col-md-4 mb-4"> 
            <div class="vacante-card fade-in h-100">
                <div class="vacante-header">
                    <div>
                        <h2 class="vacante-title"><?= $vacante['titulo'] ?></h2>
                        <div class="vacante-empresa">
                            <i class="fas fa-building"></i>
                            <?= $vacante['empresa'] ?>
                        </div>
                    </div>

                    <span class="vacante-badge <?= ($vacante['tipo'] == 'Urgente') ? 'urgente' : '' ?>">
                        <i class="fas <?= ($vacante['tipo'] == 'Urgente') ? 'fa-fire' : 'fa-star' ?> me-1"></i>
                        <?= $vacante['tipo'] ?>
                    </span>
                </div>

                <div class="vacante-info">
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span><?= $vacante['ubicacion'] ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <span><?= $vacante['modalidad'] ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-dollar-sign"></i>
                        <span><?= $vacante['salario_min'] ?> - <?= $vacante['salario_max'] ?></span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span><?= $vacante['nivel'] ?></span>
                    </div>
                </div>

                <p class="vacante-description">
                    <?= $vacante['descripcion'] ?>
                </p>

                <div class="vacante-footer">
                    <span class="vacante-fecha">
                        <i class="fas fa-calendar-alt me-2"></i>
                        Publicado el <?= date("d/m/Y", strtotime($vacante['fecha_publicacion'])) ?>
                    </span>
                    <div>
                        <a href="#" class="btn-ver-mas">
                            <i class="fas fa-info-circle me-2"></i>
                            Ver más
                        </a>
                        <a href="#" class="btn-aplicar">
                            <i class="fas fa-paper-plane me-2"></i>
                            Aplicar ahora
                        </a>
                    </div>
                </div>
            </div>

        </div>
    <?php endforeach; ?>
</div>
</body>
</html>

