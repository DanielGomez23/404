<?php

session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Vacante - Antioquia Unida</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/vacancy.css">
</head>
<body>
    <!-- Header Empresarial -->
    <nav class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="navbar-brand">
                    <i class="fas fa-building me-2"></i>
                    Antioquia-Unida
                    <span class="admin-badge">EMPRESA</span>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="nav-links d-none d-md-flex">
                        <a href="#" class="nav-link">Dashboard</a>
                        <a href="#" class="nav-link">Mis Vacantes</a>
                        <a href="#" class="nav-link">Candidatos</a>
                        <a href="#" class="nav-link">Perfil</a>
                    </div>
                    
                    <a href="../logout.php" class="btn btn-logout">
                        <i class="fas fa-sign-out-alt me-1"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Encabezado Hero -->
    <section class="admin-hero">
        <div class="container">
            <div class="fade-in">
                <h1 class="admin-title">
                    <i class="fas fa-plus-circle me-3"></i>
                    Crear Nueva Vacante
                </h1>
                <p class="admin-subtitle">
                    Encuentra el talento perfecto para tu empresa publicando una nueva oportunidad laboral
                </p>
            </div>
        </div>
    </section>

    <!-- Panel de Formulario -->
    <section class="form-panel">
        <div class="container">
            <div class="form-container">
                <div class="form-card fade-in">
                    <div class="form-header">
                        <h2 class="form-title">
                            <i class="fas fa-briefcase me-2"></i>
                            Información de la Vacante
                        </h2>
                        <p class="form-subtitle">
                            Completa todos los campos para crear una vacante atractiva y detallada
                        </p>
                    </div>
                    <form id="crearVacanteForm" action="../../controllers/vacanteController.php" method="POST">
                            <input type="hidden" name="id_reclutador" value="<?php echo $_SESSION['usuario_id']; ?>

                        <!-- Título del Puesto -->
                        <div class="form-section">
                            <label for="titulo" class="form-label">
                                <i class="fas fa-tag"></i>
                                Título del Puesto <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="titulo" 
                                name="titulo" 
                                placeholder="Ej: Desarrollador Frontend, Contador Senior, Diseñador Gráfico..."
                                required
                            >
                        </div>

                        <!-- Descripción -->
                        <div class="form-section">
                            <label for="descripcion" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Descripción del Puesto <span class="required">*</span>
                            </label>
                            <textarea 
                                class="form-control" 
                                id="descripcion" 
                                name="descripcion" 
                                rows="5"
                                placeholder="Describe las responsabilidades principales, el ambiente de trabajo, oportunidades de crecimiento y todo lo que haga atractiva esta posición..."
                                required
                            ></textarea>
                        </div>

                        <!-- Ubicación -->
                        <div class="form-section">
                            <label for="ubicacion" class="form-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Ubicación <span class="required">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control" 
                                id="ubicacion" 
                                name="ubicacion" 
                                placeholder="Ej: Medellín, Antioquia | Bogotá, Cundinamarca  "
                                required
                            >
                        </div>

                        <!-- Salario -->
                        <div class="form-section">
                            <label for="salario" class="form-label">
                                <i class="fas fa-dollar-sign"></i>
                                Rango Salarial <span class="required">*</span>
                            </label>
                            <div class="salary-input-group">
                                <div class="d-flex">
                                    <span class="currency-label">COP $</span>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="salario_min" 
                                        name="salario_min" 
                                        placeholder="Salario mínimo"
                                        style="border-radius: 0 12px 12px 0; border-left: none;"
                                        required
                                    >
                                </div>
                                <div class="d-flex">
                                    <span class="currency-label">COP $</span>
                                    <input 
                                        type="number" 
                                        class="form-control" 
                                        id="salario_max" 
                                        name="salario_max" 
                                        placeholder="Salario máximo"
                                        style="border-radius: 0 12px 12px 0; border-left: none;"
                                    >
                                </div>
                            </div>
                            <small class="text-muted mt-2 d-block">
                                <i class="fas fa-info-circle me-1"></i>
                                Si el salario máximo se deja vacío, se mostrará como "Desde $X"
                            </small>
                        </div>

                        <!-- Requisitos -->
                        <div class="form-section">
                            <label for="requisitos" class="form-label">
                                <i class="fas fa-list-check"></i>
                                Requisitos y Cualificaciones <span class="required">*</span>
                            </label>
                            <textarea 
                                class="form-control" 
                                id="requisitos" 
                                name="requisitos" 
                                rows="6"
                                placeholder="Lista los requisitos indispensables y deseables:&#10;• Educación requerida&#10;• Experiencia mínima&#10;• Habilidades técnicas&#10;• Competencias blandas&#10;• Certificaciones&#10;• Idiomas..."
                                required
                            ></textarea>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>
                                Cancelar
                            </button>
                            <button type="submit" name="postulacion" class="btn btn-primary">
                                <i class="fas fa-check me-2"></i>
                                Publicar Vacante
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.getElementById('crearVacanteForm').addEventListener('submit', function(e) {
    const salarioMin = document.getElementById('salario_min').value;
    const salarioMax = document.getElementById('salario_max').value;

    if (salarioMin && salarioMax && parseInt(salarioMax) < parseInt(salarioMin)) {
        e.preventDefault(); // evita enviar al backend
        alert('El salario máximo debe ser mayor al mínimo');
    }
});
    </script>
</body>
</html>