<?php
require_once '../../config/Database.php';
require_once '../../models/Usuarios.php';
session_start();

// // Solo permitir admins
// if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'ADMIN') {
//     header("Location: login.php");
//     exit;
// }

$conn = Database::getConnection();
$usuarioModel = new Usuario($conn);

// Consultar todos los usuarios de todas las tablas
$usuarios = $usuarioModel->obtenerTodosUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Antioquia Unida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/gestion_u.css">
    
</head>
<body>

    <!-- Header -->
    <div class="header-section">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <h1><i class="fas fa-users-cog me-2"></i>Panel de Administración</h1>
                    <p class="mb-0 opacity-75">Gestión de usuarios - Antioquia Unida</p>
                </div>
                <div class="user-info">
                    <button onclick="history.back()" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Volver
                    </button>
                    
                    <div class="user-badge">
                        <i class="fas fa-user-shield me-2"></i>
                        <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
                        <small class="d-block opacity-75"><?= htmlspecialchars($_SESSION['usuario_rol']) ?></small>
                    </div>
                    <a href="../logout.php" class="btn-logout">
                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="main-content">
            
            <!-- Título de la sección -->
            <h2 class="section-title">
                <i class="fas fa-users me-3"></i>Gestión de Usuarios
            </h2>

            <!-- Cards de estadísticas -->
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-number"><?= count($usuarios) ?></div>
                    <div>Total Usuarios</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <?= count(array_filter($usuarios, function($u) { return $u['rol'] === 'administrador'; })) ?>
                    </div>
                    <div>Administradores</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <?= count(array_filter($usuarios, function($u) { return $u['rol'] === 'profesional'; })) ?>
                    </div>
                    <div>Profesionales</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">
                        <?= count(array_filter($usuarios, function($u) { return $u['rol'] === 'empresa'; })) ?>
                    </div>
                    <div>Empresas</div>
                </div>
            </div>

            <!-- Tabla de usuarios -->
            <div class="table-container">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><i class="fas fa-id-card me-2"></i>Cédula</th>
                                <th><i class="fas fa-user me-2"></i>Nombre</th>
                                <th><i class="fas fa-envelope me-2"></i>Correo</th>
                                <th><i class="fas fa-user-tag me-2"></i>Rol</th>
                                <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($usuarios)): ?>
                            <?php foreach ($usuarios as $u): ?>
                                <tr>
                                    <td>
                                        <strong><?= htmlspecialchars($u['cedula']) ?></strong>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" 
                                                style="width: 40px; height: 40px; background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue)) !important;">
                                                <i class="fas fa-user text-white"></i>
                                            </div>
                                            <strong><?= htmlspecialchars($u['nombre']) ?></strong>
                                        </div>
                                    </td>
                                    <td>
                                        <i class="fas fa-envelope text-muted me-2"></i>
                                        <?= htmlspecialchars($u['email']) ?>
                                    </td>
                                    <td>
                                        <span class="role-badge role-<?= htmlspecialchars($u['rol']) ?>">
                                            <?= htmlspecialchars($u['rol']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <!-- Botón editar -->
                                        <button class="btn btn-edit btn-modern" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editarModal<?= $u['cedula'] ?>">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </button>

                                        <!-- Botón eliminar -->
                                        <form method="POST" action="../../controllers/AuthController.php" style="display:inline;">
                                            <input type="hidden" name="rol" value="<?= $u['rol'] ?>">
                                            <input type="hidden" name="cedula" value="<?= $u['cedula'] ?>">
                                            <button type="submit" name="eliminar" class="btn btn-delete btn-modern"
                                                    onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                                <i class="fas fa-trash me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal editar -->

<div class="modal fade" id="editarModal<?= $u['cedula'] ?>" tabindex="-1" aria-labelledby="editarModalLabel<?= $u['cedula'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel<?= $u['cedula'] ?>">
                    <i class="fas fa-user-edit me-2"></i>Editar Usuario
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="POST" action="../../controllers/AuthController.php">
                <div class="modal-body">
                    <!-- Rol oculto -->
                    <input type="hidden" name="rol" value="<?= htmlspecialchars($u['rol']) ?>">
                    <!-- Cedula original -->
                    <input type="hidden" name="cedula_original" value="<?= htmlspecialchars($u['cedula']) ?>">

                    <div class="mb-3">
                        <label for="cedula<?= $u['cedula'] ?>" class="form-label">
                            <i class="fas fa-id-card me-2"></i>Cédula
                        </label>
                        <input type="number" id="cedula<?= $u['cedula'] ?>" name="cedula" class="form-control" 
                               value="<?= htmlspecialchars($u['cedula']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="nombre<?= $u['cedula'] ?>" class="form-label">
                            <i class="fas fa-user me-2"></i>Nombre
                        </label>
                        <input type="text" id="nombre<?= $u['cedula'] ?>" name="nombre" class="form-control" 
                               value="<?= htmlspecialchars($u['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="correo<?= $u['cedula'] ?>" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Correo
                        </label>
                        <input type="email" id="correo<?= $u['cedula'] ?>" name="email" class="form-control" 
                               value="<?= htmlspecialchars($u['email']) ?>" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" name="editar" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="5">
            <div class="empty-state">
            <i class="fas fa-users"></i>
            <h5>No hay usuarios registrados</h5>
                <p class="text-muted">Aún no se han registrado usuarios en el sistema.</p>
            </div>
            </td>
            </tr>
<?php endif; ?>
</tbody>
            </table>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>