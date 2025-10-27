<?php 
require_once '../../config/Database.php';
session_start();

// Control de acceso
if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'reclutador') {
    header("Location: login.php");
    exit;
}

$conn = Database::getConnection();

// ✅ Detección inteligente del ID del reclutador
$id_reclutador = $_SESSION['cedula'] 
    ?? $_SESSION['usuario_id'] 
    ?? null;

if (!$id_reclutador) {
    die("Error: No se puede identificar al reclutador. Inicia sesión nuevamente.");
}

// Paginación
$limit = 20;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// ✅ Consulta filtrada por el reclutador
$sql = "SELECT p.*, o.titulo
        FROM postulaciones p
        INNER JOIN ofertas_trabajo o ON p.id_oferta = o.id
        WHERE o.id_reclutador = ?
        ORDER BY p.fecha_postulacion DESC
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $id_reclutador, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();
$postulaciones = $result->fetch_all(MYSQLI_ASSOC);

// ✅ Total solo de sus postulaciones
$sqlTotal = "SELECT COUNT(*) AS total 
             FROM postulaciones p
             INNER JOIN ofertas_trabajo o ON p.id_oferta = o.id
             WHERE o.id_reclutador = ?";

$stmt_total = $conn->prepare($sqlTotal);
$stmt_total->bind_param("i", $id_reclutador);
$stmt_total->execute();
$total = $stmt_total->get_result()->fetch_assoc()['total'];
$total_pages = ceil($total / $limit);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
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

                <a href="../logout.php" class="btn-logout">
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
                <div>Total Postulaciones Recibidas</div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Vacante</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Hoja de Vida</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if (!empty($postulaciones)): ?>
                        <?php foreach ($postulaciones as $p): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($p['titulo']) ?></strong></td>
                                <td><?= htmlspecialchars($p['nombre']) ?></td>
                                <td><?= htmlspecialchars($p['correo']) ?></td>
                                <td><?= htmlspecialchars($p['telefono']) ?></td>
                                <td>
                                    <a href="../../<?= htmlspecialchars($p['cv']) ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>Ver PDF
                                    </a>
                                </td>
                                <td><?= date("d/m/Y H:i", strtotime($p['fecha_postulacion'])) ?></td>
                        
                                <td>
                                    <form method="POST" action="../../controllers/PostulacionController.php" style="display:inline;">
                                        <input type="hidden" name="accion" value="actualizarEstado">
                                        <input type="hidden" name="id_postulacion" value="<?= htmlspecialchars($p['id'], ENT_QUOTES) ?>">
                                        <select name="estado" class="btn btn-info btn-modern" onchange="this.form.submit()">
                                            <option value="enviada" <?= $p['estado'] === 'enviada' ? 'selected' : '' ?>>Enviada</option>
                                            <option value="vista" <?= $p['estado'] === 'vista' ? 'selected' : '' ?>>Vista</option>
                                            <option value="rechazada" <?= $p['estado'] === 'rechazada' ? 'selected' : '' ?>>Rechazada</option>
                                            <option value="aceptada" <?= $p['estado'] === 'aceptada' ? 'selected' : '' ?>>Aceptada</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="7" class="text-center text-muted">No hay postulaciones disponibles.</td></tr>
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


<script>
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".estado-selector").forEach(select => {
        select.addEventListener("change", async () => {
            const id = select.dataset.id;
            const estado = select.value;

            const formData = new URLSearchParams();
            formData.append("accion", "cambiarEstado");
            formData.append("id_oferta", id);
            formData.append("estado", estado);

            try {
                const res = await fetch("../../controllers/postulacionController.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: formData.toString()
                });

                const text = await res.text();
                if (text.trim() === "ok") {
                    alert("Estado actualizado correctamente");
                } else {
                    alert("Error al actualizar el estado");
                }
            } catch (err) {
                alert("Error de conexión con el servidor");
            }
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
