<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../../backend/conexion/conexion.php';
include '../../backend/tareas/obtener-tareas.php';
include '../../backend/usuarios/obtener-usuario.php';

if (!isset($_SESSION['id_freelancer'])) {
    header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas del Proyecto - CodeFlow</title>
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

            <div class="freelancer-profile">
                <div class="freelancer-avatar">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Méndez">
                    <span class="online-status"></span>
                </div>
                <div class="freelancer-info">
                    <h3><?php echo htmlspecialchars($nombre_usuario) ?></h3>
                    <p><?php echo htmlspecialchars($datos['titulo']) ?></p>
                    <div class="freelancer-rating">
                        <i class="fas fa-star"></i>
                        <span>4.9</span>
                        <span>(42 proyectos)</span>
                    </div>
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
                    <a href="mis-proyectos.php">
                            <i class="fas fa-diagram-project"></i>
                            <span>Mis Proyectos</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="tareas.php">
                            <i class="fas fa-tasks"></i>
                            <span>Tareas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-envelope"></i>
                            <span>Mensajes</span>
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
                    <input type="text" placeholder="Buscar tareas, proyectos...">
                </div>

                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">3</span>
                    </button>
                    <button class="message-btn">
                        <i class="fas fa-envelope"></i>
                        <span class="message-badge">5</span>
                    </button>
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario">
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Listado de tareas -->
                <section class="tasks-section">
                    <div class="section-header">
                        <h2>Tareas asignadas</h2>
                        <div class="tasks-stats">
                            <span class="stat-item-task">
                                <i class="fas fa-circle text-warning"></i>
                                <span>En progreso</span>
                            </span>
                            <span class="stat-item-task">
                                <i class="fas fa-circle text-success"></i>
                                <span>Completadas</span>
                            </span>
                        </div>
                    </div>

                    <div class="tasks-list">
                        <!-- Tarea 1 -->
                        <?php foreach ($tareas as $tarea) : ?>
                            <div class="project-header collapsible-header" onclick="toggleCollapse(this)">
                                <div class="project-title">
                                    <h1>Desarrollo de App Móvil</h1>
                                    <span class="project-status in-progress">En progreso</span>
                                </div>
                                
                                <div class="project-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-building"></i>
                                        <span>Tech Solutions</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Entrega: 15 Ago 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-wallet"></i>
                                        <span>Presupuesto: $2,800</span>
                                    </div>
                                </div>

                                <div class="project-description-task">
                                    <p>Aplicación de comercio electrónico para iOS y Android con React Native. Debe incluir carrito de compras, pasarela de pago, sistema de valoraciones y panel de administración.</p>
                                </div>

                                <i class="fas fa-chevron-down collapse-icon"></i>
                            </div>

                            <div class="collapsible-content">
                                <div class="task-card">
                                    <div class="task-header">
                                        <div class="task-title">
                                            <h3>Implementar carrito de compras</h3>
                                        </div>
                                        <div class="task-meta">
                                            <span class="task-date">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span>Vence: 25 Jul 2023</span>
                                            </span>
                                            <span class="task-status in-progress">En progreso</span>
                                        </div>
                                    </div>
                                    
                                    <div class="task-body">
                                        <div class="task-description">
                                            <p>Desarrollar el componente de carrito de compras con las siguientes funcionalidades: agregar/eliminar productos, calcular total, aplicar descuentos y guardar temporalmente los items.</p>
                                        </div>
                                        
                                        <div class="task-progress">
                                            <label>Progreso: 65%</label>
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: 65%"></div>
                                            </div>
                                            <button class="btn btn-outline btn-xsmall">
                                                <i class="fas fa-edit"></i> Actualizar progreso
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="task-comments">
                                        <h4><i class="fas fa-comments"></i> Comentarios (3)</h4>
                                        
                                        <div class="comments-list">
                                            <!-- Comentario 1 -->
                                            <div class="comment-item">
                                                <div class="comment-header">
                                                    <div class="comment-author">
                                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="María Rodríguez">
                                                        <span>María Rodríguez (Cliente)</span>
                                                    </div>
                                                    <span class="comment-date">Hace 2 días</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>Recuerda que el carrito debe mantener los items aunque el usuario cierre la app. También necesitamos que muestre productos recomendados basados en lo que el usuario ha agregado.</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Comentario 2 -->
                                            <div class="comment-item">
                                                <div class="comment-header">
                                                    <div class="comment-author">
                                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Méndez">
                                                        <span>Tú</span>
                                                    </div>
                                                    <span class="comment-date">Ayer</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>He implementado la persistencia usando AsyncStorage. ¿Los productos recomendados deben venir del backend o los podemos manejar localmente con una lista predefinida?</p>
                                                </div>
                                            </div>
                                            
                                            <!-- Comentario 3 -->
                                            <div class="comment-item">
                                                <div class="comment-header">
                                                    <div class="comment-author">
                                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="María Rodríguez">
                                                        <span>María Rodríguez (Cliente)</span>
                                                    </div>
                                                    <span class="comment-date">Hoy</span>
                                                </div>
                                                <div class="comment-content">
                                                    <p>Los recomendados deben venir del backend, ya tenemos un endpoint para eso. Te enviaré la documentación del API.</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="add-comment">
                                            <div class="comment-input">
                                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Tu avatar">
                                                <textarea placeholder="Escribe un comentario..."></textarea>
                                            </div>
                                            <div class="comment-actions">
                                                <button class="btn btn-outline btn-small">
                                                    <i class="fas fa-paperclip"></i> Adjuntar archivo
                                                </button>
                                                <button class="btn btn-primary btn-small">
                                                    <i class="fas fa-paper-plane"></i> Enviar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="task-actions">
                                        <button class="btn btn-success btn-small">
                                            <i class="fas fa-check"></i> Marcar como completada
                                        </button>
                                        <button class="btn btn-delete btn-small">
                                            <i class="fas fa-xmark"></i> Eliminar tarea
                                        </button>
                                        <button class="btn btn-outline btn-small">
                                            <i class="fas fa-flag"></i> Reportar problema
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                    
                    <div class="pagination-controls">
                        <button class="btn btn-outline btn-small">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </button>
                        <span class="page-info">Página 1 de 2</span>
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
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario">
                            </div>
                            <div>
                                <h3><?php echo htmlspecialchars($nombre_usuario) ?></h3>
                                <p><?php echo htmlspecialchars($datos['correo']) ?></p>
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
                                <a href="#" class="option-link">
                                    <i class="fas fa-exchange-alt"></i>
                                    <span>Cambiar de cuenta</span>
                                </a>
                            </li>
                            <li class="option-item">
                                <a href="#" class="option-link logout">
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

    <script src="../../assets/js/tareas.js"></script>
</body>

</html>