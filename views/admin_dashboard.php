<?php
require_once '../config/Database.php';
require_once '../models/Usuarios.php';
session_start();

// Solo permitir admins
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'administrador') {
    header("Location: login.php");
    exit;
}

$conn = Database::getConnection();
$usuarioModel = new Usuario($conn);

// Consultar todos los usuarios de todas las tablas
$usuarios = $usuarioModel->obtenerTodosUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <!-- Header con usuario y cerrar sesión -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Panel de Administración</h2>
        <div>
            <span class="me-3">👤 <?= htmlspecialchars($_SESSION['usuario_nombre']) ?> (<?= htmlspecialchars($_SESSION['usuario_rol']) ?>)</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
        </div>
    </div>

    <!-- Tabla de usuarios -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['cedula']) ?></td>
                    <td><?= htmlspecialchars($u['nombre']) ?></td>
                    <td><?= htmlspecialchars($u['email']) ?></td>
                    <td><?= htmlspecialchars($u['rol']) ?></td>
                    <td>
                        <!-- Botón editar -->
                        <button class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editarModal<?= $u['cedula'] ?>">Editar</button>

                        <!-- Botón eliminar -->
                        <form method="POST" action="../controllers/AuthController.php" style="display:inline;">
                            <input type="hidden" name="rol" value="<?= $u['rol'] ?>">
                            <input type="hidden" name="cedula" value="<?= $u['cedula'] ?>">
                            <button type="submit" name="eliminar" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar este usuario?')">
                                Eliminar
                            </button>
                        </form>
                    </td>
                </tr>

                <!-- Modal editar -->
                <div class="modal fade" id="editarModal<?= $u['cedula'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <form method="POST" action="../controllers/AuthController.php" class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Editar Usuario</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="rol" value="<?= $u['rol'] ?>">

                                <div class="mb-3">
                                    <label class="form-label">Cédula</label>
                                    <input type="number" name="cedula" class="form-control" value="<?= $u['cedula'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" value="<?= $u['nombre'] ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Correo</label>
                                    <input type="email" name="correo" class="form-control" value="<?= $u['email'] ?>" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="editar" class="btn btn-primary">Guardar cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="5" class="text-center">No hay usuarios registrados.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
