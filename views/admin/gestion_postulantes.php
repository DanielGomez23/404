<?php
require_once '../../config/Database.php';
session_start();

//Control de acceso: solo permite reclutadores
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'reclutador') {
    header("Location: login.php");
    exit;
}


$conn = Database::getConnection();


// muestra solo 20 registros por página
$limit = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Consulta con orden y límites
$sql = "SELECT * FROM postulaciones ORDER BY fecha_postulacion DESC LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
$postulaciones = $result->fetch_all(MYSQLI_ASSOC);

// Total de postulaciones (para paginación y estadísticas)
$total = $conn->query("SELECT COUNT(*) AS total FROM postulaciones")->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Postulaciones - Reclutador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/gestion_u.css">
</head>
<body>

<div class="header-section">
    <div class="container">
        <div class="header-content">
            <div class="logo-section">
                <h1><i class="fas fa-users me-2"></i>Gestión de Postulaciones</h1>
                <p class="mb-0 opacity-75">Panel del Reclutador</p>
            </div>

            <div class="user-info">
                <button onclick="history.back()" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>Volver
                </button>
                
                <div class="user-badge">
                    <i class="fas fa-user-tie me-2"></i>
                    <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
                    <small class="d-block opacity-75"><?= htmlspecialchars($_SESSION['usuario_rol']) ?></small>
                </div>

                <a href="../../logout.php" class="btn-logout">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar sesión
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="main-content">
        
        
        <h2 class="section-title">
            <i class="fas fa-file-alt me-3"></i>Listado de Postulaciones
        </h2>

       
        <div class="stats-cards">
            <div class="stat-card">
                <div class="stat-number"><?= $total ?></div>
                <div>Total Postulaciones</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?= count(array_filter($postulaciones, fn($p) => stripos($p['mensaje'], 'experiencia') !== false)); ?>
                </div>
                <div>Con Experiencia</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">
                    <?= count(array_filter($postulaciones, fn($p) => stripos($p['mensaje'], 'práctica') !== false)); ?>
                </div>
                <div>Solicitando Práctica</div>
            </div>
            <div class="stat-card">
                <div class="stat-number"><?= date('Y') ?></div>
                <div>Año Actual</div>
            </div>
        </div>


        <div class="table-container">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th><i class="fas fa-user me-2"></i>Nombre</th>
                            <th><i class="fas fa-envelope me-2"></i>Correo</th>
                            <th><i class="fas fa-phone me-2"></i>Teléfono</th>
                            <th><i class="fas fa-file-pdf me-2"></i>Hoja de Vida</th>
                            <th><i class="fas fa-calendar-alt me-2"></i>Fecha</th>
                            <th><i class="fas fa-cogs me-2"></i>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($postulaciones)): ?>
                        <?php foreach ($postulaciones as $p): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($p['nombre']) ?></strong></td>
                                <td><?= htmlspecialchars($p['correo']) ?></td>
                                <td><?= htmlspecialchars($p['telefono']) ?></td>
                                <td>
                                    <a href="../../<?= htmlspecialchars($p['cv']) ?>" download class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>Ver PDF
                                    </a>
                                </td>
                                <td><?= date("d/m/Y H:i", strtotime($p['fecha_postulacion'])) ?></td>
                                <td>
                                    <button class="btn btn-info btn-modern" data-bs-toggle="modal" data-bs-target="#verModal<?= $p['id'] ?>">
                                        <i class="fas fa-eye me-1"></i>Ver Detalles
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal con detalles del postulante -->
                            <div class="modal fade" id="verModal<?= $p['id'] ?>" tabindex="-1" aria-labelledby="verModalLabel<?= $p['id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                <i class="fas fa-user me-2"></i>Detalles de <?= htmlspecialchars($p['nombre']) ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Correo:</strong> <?= htmlspecialchars($p['correo']) ?></p>
                                            <p><strong>Teléfono:</strong> <?= htmlspecialchars($p['telefono']) ?></p>
                                            <p><strong>Mensaje:</strong> <?= nl2br(htmlspecialchars($p['mensaje'])) ?></p>
                                            <p><strong>Fecha de postulación:</strong> <?= date("d/m/Y H:i", strtotime($p['fecha_postulacion'])) ?></p>
                                            <a href="../../<?= htmlspecialchars($p['cv']) ?>" download class="btn btn-primary">
                                                <i class="fas fa-file-pdf me-2"></i>Ver hoja de vida
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">
                                <div class="empty-state">
                                    <i class="fas fa-user-times fa-2x mb-2"></i>
                                    <h5>No hay postulaciones registradas</h5>
                                    <p class="text-muted">Aún no se ha recibido ninguna postulación.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        
            <?php if ($total_pages > 1): ?>
                <nav>
                    <ul class="pagination justify-content-center mt-3">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            <?php endif; ?>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
