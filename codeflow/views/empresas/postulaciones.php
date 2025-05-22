<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include "../../backend/conexion/conexion.php";
include "../../backend/proyectos/obtener-postulacion-empresa.php";
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
    <title>Postulaciones - CodeFlow</title>
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
                    <li>
                        <a href="proyectos.php">
                            <i class="fas fa-briefcase"></i>
                            <span>Proyectos</span>
                        </a>
                    </li>
                    <li class="active">
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
                <!-- Encabezado de postulaciones -->
                <section class="welcome-section">
                    <div class="welcome-message">
                        <h1>Postulaciones a tus proyectos</h1>
                        <p>Revisa y gestiona los freelancers que han aplicado a tus proyectos</p>
                    </div>
                </section>

                <!-- Listado de postulaciones -->
                <section class="applications-section">
                    <div class="section-header">
                        <h2>Postulaciones recientes</h2>
                        <div class="applications-count">
                            <span>Mostrando <strong>8</strong> de <strong>24</strong> postulaciones</span>
                        </div>
                    </div>

                    <div class="applications-list">
                        <!-- Tarjeta de postulación -->
                        <?php foreach ($datos_postulacion as $dato): ?>
                            <div class="application-card">
                                <div class="application-header">
                                    <div class="freelancer-info-postulacion">
                                        <div class="freelancer-avatar">
                                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Méndez">
                                        </div>
                                        <div class="freelancer-details">
                                            <h3><?php echo htmlspecialchars($dato['nombre_freelancer']) ?></h3>
                                            <p><?php echo htmlspecialchars($dato['titulo_freelancer']) ?></p>
                                            <div class="freelancer-rating">
                                                <i class="fas fa-star"></i>
                                                <span>4.9</span>
                                                <span>(42 proyectos)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="application-meta">
                                        <span class="project-name"><?php echo htmlspecialchars($dato['nombre_proyecto']) ?></span>
                                        <span class="application-date">Postuló el <?php echo htmlspecialchars($dato['fecha_postulacion']) ?></span>
                                        <span class="application-status abierto"><?php echo htmlspecialchars($dato['estado']) ?></span>
                                    </div>
                                </div>
                                
                                <div class="application-body">
                                    <div class="application-bio">
                                        <p>"<?php echo htmlspecialchars($dato['descripcion_freelancer']) ?>"</p>
                                    </div>
                                </div>
                                
                                <div class="application-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-eye"></i> Ver perfil
                                    </button>
                                    <form method="POST" action="../../backend/proyectos/aceptar-postulacion.php">
                                        <input type="hidden" name="id-postulacion" value="<?php echo htmlspecialchars($dato['id_postulacion'])?>">
                                        <input type="hidden" name="accion" value="Aceptada">
                                        <button class="btn btn-primary btn-small">
                                            <i class="fas fa-check"></i> Aceptar
                                        </button>
                                    </form>
                                    <form method="POST" action="../../backend/proyectos/aceptar-postulacion.php">
                                        <input type="hidden" name="id-postulacion" value="<?php echo htmlspecialchars($dato['id_postulacion'])?>">
                                        <input type="hidden" name="accion" value="Rechazada">
                                        <button class="btn btn-danger btn-small">
                                            <i class="fas fa-times"></i> Rechazar
                                        </button>
                                    </form>
                                    <button class="btn btn-secondary btn-small">
                                        <i class="fas fa-comment"></i> Mensaje
                                    </button>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    
                    <div class="pagination-controls">
                        <button class="btn btn-outline btn-small" disabled>
                            <i class="fas fa-chevron-left"></i> Anterior
                        </button>
                        <span class="page-info">Página 1 de 3</span>
                        <button class="btn btn-outline btn-small">
                            Siguiente <i class="fas fa-chevron-right"></i>
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
                                <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff" alt="Usuario">
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

    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>