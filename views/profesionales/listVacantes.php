<?php
session_start();
require_once '../../config/Database.php';

// Solo permitir acceso a profesionales
// if (!isset($_SESSION['usuario_rol']) || $_SESSION['usuario_rol'] !== 'profesional') {
//     header("Location: ../login.php");
//     exit;
// }

// Conexión
$conn = Database::getConnection();

// Consultar vacantes publicadas
$sql = "SELECT o.id_oferta, o.titulo, o.descripcion, o.ubicacion, 
               o.salario_min, o.salario_max, o.fecha_publicacion, e.nombre_empresa 
        FROM ofertas_trabajo o
        JOIN reclutadores e ON o.id_reclutador = e.id_reclutador
        ORDER BY o.fecha_publicacion DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes Disponibles - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
        }
        .vacante-card {
            border-radius: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform .2s ease, box-shadow .2s ease;
        }
        .vacante-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        .btn-postular {
            background-color: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            transition: background-color .2s ease;
        }
        .btn-postular:hover {
            background-color: #5568d1;
        }
        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-bottom: 2rem;
        }
        .header h1 {
            font-weight: 700;
        }
        .empresa {
            color: #667eea;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <header class="header">
        <h1><i class="fas fa-briefcase me-2"></i> Vacantes Disponibles</h1>
        <p>Explora oportunidades laborales publicadas por las empresas</p>
    </header>

    <div class="container">
        <div class="row g-4">
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($vacante = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card vacante-card p-3 h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">
                                    <i class="fas fa-tag me-2 text-primary"></i>
                                    <?= htmlspecialchars($vacante['titulo']); ?>
                                </h5>
                                <h6 class="empresa mb-2">
                                    <i class="fas fa-building me-1"></i>
                                    <?= htmlspecialchars($vacante['nombre_empresa']); ?>
                                </h6>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-map-marker-alt me-1"></i>
                                    <?= htmlspecialchars($vacante['ubicacion']); ?>
                                </p>
                                <p class="card-text flex-grow-1">
                                    <?= substr(htmlspecialchars($vacante['descripcion']), 0, 120) . '...'; ?>
                                </p>
                                <p class="mt-2 mb-3 fw-semibold">
                                    <i class="fas fa-dollar-sign me-1"></i>
                                    <?= number_format($vacante['salario_min'], 0, ',', '.'); ?>
                                    <?php if ($vacante['salario_max']): ?>
                                        - <?= number_format($vacante['salario_max'], 0, ',', '.'); ?>
                                    <?php else: ?>
                                        +
                                    <?php endif; ?>
                                </p>
                                <p class="text-muted small mb-3">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    Publicada el <?= date("d/m/Y", strtotime($vacante['fecha_publicacion'])); ?>
                                </p>
                                <a href="detalle_vacante.php?id=<?= $vacante['id_oferta']; ?>" class="btn btn-postular mt-auto">
                                    <i class="fas fa-eye me-1"></i> Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12 text-center">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> No hay vacantes disponibles actualmente.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>