<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../backend/conexion/conexion.php";
include "../../backend/proyectos/obtener-proyecto.php";
include "../../backend/usuarios/obtener-usuario.php";

if (!isset($_SESSION['id_empresa'])) {
    header("Location: http://localhost/pruebas/views/public/login.html");
    exit();
}

$id_empresa = $_SESSION['id_empresa'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Proyectos - CodeFlow</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="logo-icon"><i class="fas fa-code"></i></span>
                    <span class="logo-text">CodeFlow</span>
                </div>
            </div>

            <div class="company-profile">
                <div class="company-avatar">
                    <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff"
                        alt="Tech Solutions">
                </div>
                <div class="company-info">
                    <h3><?php echo htmlspecialchars($nombre_usuario) ?></h3>
                    <p>Plan <?php echo htmlspecialchars($datos['tipo_suscripcion']) ?></p>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul>
                    <li>
                        <a href="dashboard.php">
                            <i class="fas fa-home"></i>
                            <span>Inicio</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-briefcase"></i>
                            <span>Proyectos</span>
                        </a>
                    </li>
                    <li>
                        <a href="postulaciones.php">
                            <i class="fas fa-users"></i>
                            <span>Postulaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href="suscripcion.php">
                            <i class="fas fa-coins"></i>
                            <span>Suscripciones</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer create-project-btn">
                <a class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo proyecto
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <div class="header-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar proyectos, freelancers...">
                </div>

                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">
                            <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff"
                                alt="Usuario">
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Filtros y acciones -->
                <section class="projects-header">
                    <h1>Mis Proyectos</h1>

                    <div class="projects-controls">
                        <div class="projects-filters">
                            <div class="filter-group">
                                <label for="status-filter">Estado:</label>
                                <select id="status-filter" class="custom-select">
                                    <option value="all">Todos</option>
                                    <option value="active">Activos</option>
                                    <option value="in-progress">En progreso</option>
                                    <option value="completed">Completados</option>
                                    <option value="pending">Pendientes</option>
                                </select>
                            </div>

                            <div class="filter-group">
                                <label for="date-filter">Fecha:</label>
                                <select id="date-filter" class="custom-select">
                                    <option value="recent">Más recientes</option>
                                    <option value="oldest">Más antiguos</option>
                                    <option value="deadline">Por fecha límite</option>
                                </select>
                            </div>

                            <button class="btn btn-outline">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                        </div>

                        <div class="projects-actions">
                            <button class="btn btn-primary">
                                <i class="fas fa-sync-alt"></i> Actualizar
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Listado de proyectos -->
                <section class="projects-list-section">
                    <div class="projects-list-header">
                        <div class="projects-count">
                            <span>Mostrando <strong>5</strong> de <strong>12</strong> proyectos</span>
                        </div>

                        <div class="projects-view">
                            <button class="view-btn active" data-view="grid">
                                <i class="fas fa-th-large"></i>
                            </button>
                            <button class="view-btn" data-view="list">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Vista en cuadrícula -->
                    <div class="projects-grid">
                        <!-- Proyecto 1 -->
                        <?php foreach ($proyectosPorEstado as $estado => $proyectos): ?>
                            <?php foreach ($proyectos as $proyecto):?>
                                <div class="project-card-container">
                                    <div class="project-card-header">
                                        <h3><?php echo htmlspecialchars($proyecto['titulo'])?></h3>
                                        <span class="project-status <?php echo strtolower(str_replace(' ', '-', $estado))?>">
                                            <?php echo $estado; ?>
                                        </span>
                                    </div>

                                    <div class="project-card-body">
                                        <p class="project-description"><?php echo htmlspecialchars($proyecto['descripcion']) ?></p>

                                        <div class="project-meta">
                                            <div class="meta-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>Inicio: <?php echo htmlspecialchars($proyecto['fecha_creacion']) ?></span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-clock"></i>
                                                <span>Límite: <?php echo htmlspecialchars($proyecto['fecha_finalizacion']) ?></span>
                                            </div>
                                            <div class="meta-item">
                                                <i class="fas fa-wallet"></i>
                                                <span>Presupuesto: $<?php echo htmlspecialchars($proyecto['monto']) ?></span>
                                            </div>
                                        </div>

                                        <div class="project-progress">
                                            <div class="progress-info">
                                                <span>Progreso</span>
                                                <span>0%</span>
                                            </div>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 0%"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="project-card-footer">
                                        <div class="project-actions">
                                            <button class="btn btn-outline btn-small">
                                                <i class="fas fa-eye"></i> Ver
                                            </button>
                                            <button class="btn btn-primary btn-small">
                                                <i class="fas fa-pencil-alt"></i> Editar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        <?php endforeach;?>
                    </div>

                    <!-- Paginación -->
                    <div class="projects-pagination">
                        <button class="pagination-btn disabled">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="pagination-btn active">1</button>
                        <button class="pagination-btn">2</button>
                        <button class="pagination-btn">3</button>
                        <button class="pagination-btn">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </section>
            </div>
        </main>

        <!-- Modal User Dropdown -->
        <div class="modal" id="userModal" aria-hidden="true" style="display: none;">
            <div class="modal-overlay" tabindex="-1" data-close-user-modal>
                <div class="modal-container user-modal" role="dialog" aria-modal="true">
                    <div class="user-modal-header">
                        <div class="user-info">
                            <div class="user-avatar large">
                                <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff"
                                    alt="Usuario">
                            </div>
                            <div>
                                <h3><?php echo htmlspecialchars($nombre_usuario) ?></h3>
                                <p><?php echo htmlspecialchars($datos['correo_corporativo']) ?></p>
                                <span class="badge-plan">Plan <?php echo htmlspecialchars($datos['tipo_suscripcion']) ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="user-modal-body">
                        <ul class="user-options">
                            <li class="option-item">
                                <a href="#" class="option-link">
                                    <i class="fas fa-user-edit"></i>
                                    <span>Editar perfil</span>
                                </a>
                            </li>
                            <li class="option-item">
                                <a href="#" class="option-link">
                                    <i class="fas fa-cog"></i>
                                    <span>Configuración</span>
                                </a>
                            </li>
                            <li class="option-divider"></li>
                            <li class="option-item">
                                <a href="../public/login.html" class="option-link">
                                    <i class="fas fa-exchange-alt"></i>
                                    <span>Cambiar de cuenta</span>
                                </a>
                            </li>
                            <li class="option-item">
                                <a href="../public/index.html" class="option-link logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Cerrar sesión</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Crear Proyecto -->
    <div class="project-modal" id="createProjectModal" aria-hidden="true" style="display: none;">
        <div class="modal-overlay" tabindex="-1" data-close-modal>
            <div class="modal-container medium" role="dialog" aria-modal="true">
                <button class="modal-close" aria-label="Cerrar modal" id="close-modal">
                    <i class="fas fa-times"></i>
                </button>

                <div class="modal-header">
                    <h3><i class="fas fa-plus-circle"></i> Crear Nuevo Proyecto</h3>
                </div>

                <form id="projectForm" method="POST" action="../../backend/proyectos/crear-proyecto.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="projectTitle">Título del proyecto*</label>
                            <div class="input-text">
                                <input type="text" name="title-project" id="projectTitle" placeholder="Ej: Desarrollo de app móvil" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="projectDescription">Descripción detallada*</label>
                            <div class="input-text">
                                <textarea name="description-project" class="projectDescription" rows="5"
                                placeholder="Describe los objetivos, requisitos y especificaciones del proyecto..."
                                required></textarea>
                            </div>
                            <div class="char-counter"><span id="descCounter">0</span>/1000</div>
                        </div>

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="projectBudget">Presupuesto (USD)*</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                    <input type="number" name="budget-project" id="projectBudget" min="100" step="50" placeholder="Ej: 1500"
                                        required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="projectDeadline">Fecha límite*</label>
                                <div class="input-with-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                    <input type="date" name="limit-date" id="projectDeadline" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-rocket"></i> Publicar Proyecto
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../../assets/js/proyectos.js"></script>
</body>

</html>