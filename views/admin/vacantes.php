<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once '../../controllers/vacanteController.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../login.php");
    exit;
}

$query = "SELECT * FROM ofertas_trabajo ORDER BY fecha_publicacion DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$vacantes = $result->fetch_all(MYSQLI_ASSOC);

$vacanteController = new VacanteController();
$vacanteController->eliminarVacante();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Vacantes - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/listar_vacantes.css">
    <link rel="stylesheet" href="../../public/css/header.css">
</head>
<body>

    <?php include_once '../header.php'; ?>

    <div class="container my-4">
        <h1 class="text-center mb-4">Mis Vacantes Publicadas</h1>
        
        <?php if (empty($vacantes)): ?>
            <div class="alert alert-info text-center fade-in">
                <i class="fas fa-info-circle me-2"></i>
                Aún no has publicado ninguna vacante.
            </div>
        <?php else: ?>

        <div class="row">
            <?php foreach ($vacantes as $vacante): ?>
                <div class="col-md-4 mb-4"> 
                    <div class="vacante-card fade-in h-100">
                        <div class="vacante-header">
                            <div>
                                <h2 class="vacante-title"><?= htmlspecialchars($vacante['titulo']); ?></h2>
                                <div class="vacante-empresa">
                                    <i class="fas fa-building"></i>
                                    <?= htmlspecialchars($vacante['descripcion']); ?>
                                </div>
                            </div>

                            <?php if ($vacante['calificacion'] != 'normal'): ?>
        <?php
        $badges = [
            'buena' => ['class' => 'buena', 'icon' => 'fa-thumbs-up', 'text' => 'Buena Oferta'],
            'recomendada' => ['class' => 'recomendada', 'icon' => 'fa-star', 'text' => 'Recomendada'],
            'destacada' => ['class' => 'urgente', 'icon' => 'fa-fire', 'text' => 'Destacada']
        ];
        $badge = $badges[$vacante['calificacion']];
        ?>
        <span class="vacante-badge <?= $badge['class']; ?>">
            <i class="fas <?= $badge['icon']; ?> me-1"></i>
            <?= $badge['text']; ?>
        </span>
    <?php endif; ?>

    <form method="POST" action="../../controllers/vacanteController.php">
    <input type="hidden" name="accion" value="actualizarCalificacion">
    <input type="hidden" name="vacante_id" value="<?= $vacante['id']; ?>">

    <select name="calificacion" class="form-select form-select-sm" onchange="this.form.submit()">
        <option value="normal" <?= $vacante['calificacion'] == 'normal' ? 'selected' : ''; ?>>Normal</option>
        <option value="buena" <?= $vacante['calificacion'] == 'buena' ? 'selected' : ''; ?>>Buena</option>
        <option value="recomendada" <?= $vacante['calificacion'] == 'recomendada' ? 'selected' : ''; ?>>Recomendada</option>
        <option value="destacada" <?= $vacante['calificacion'] == 'destacada' ? 'selected' : ''; ?>>Destacada</option>
    </select>
</form>



</div>
 <div class="vacante-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?= htmlspecialchars($vacante['ubicacion']); ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span><?= htmlspecialchars($vacante['modalidad']); ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span><?= htmlspecialchars($vacante['salario_min']); ?> - <?= htmlspecialchars($vacante['salario_max']); ?></span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-graduation-cap"></i>
                                <span><?= htmlspecialchars($vacante['nivel']); ?></span>
                            </div>
                        </div>

                        <p class="vacante-description">
                            <?= htmlspecialchars($vacante['descripcion']); ?>
                        </p>

                        <div class="vacante-footer">
                            <span class="vacante-fecha">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Publicado el <?= date("d/m/Y", strtotime($vacante['fecha_publicacion'])); ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

</body>
</html>
