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

            <div class="freelancer-profile">
                <div class="freelancer-avatar">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos M.">
                    <span class="online-status"></span>
                </div>
                <div class="freelancer-info">
                    <h3>Carlos Martínez</h3>
                    <p>Fullstack Developer</p>
                    <div class="freelancer-rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span>4.7</span>
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
                    <li class="active">
                        <a href="proyectos.php">
                            <i class="fas fa-briefcase"></i>
                            <span>Proyectos</span>
                            <span class="menu-badge">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-building"></i>
                            <span>Clientes</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-file-contract"></i>
                            <span>Contratos</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-chart-line"></i>
                            <span>Analíticas</span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-wallet"></i>
                            <span>Pagos</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <a href="#" class="btn btn-primary btn-block">
                    <i class="fas fa-plus"></i> Buscar proyectos
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <div class="header-search">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Buscar proyectos, clientes...">
                </div>

                <div class="header-actions">
                    <button class="notification-btn">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">2</span>
                    </button>
                    <button class="message-btn">
                        <i class="fas fa-envelope"></i>
                        <span class="message-badge">1</span>
                    </button>
                    <div class="user-dropdown">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario">
                        </div>
                        <span>Carlos</span>
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
                                <label for="date-filter">Ordenar por:</label>
                                <select id="date-filter" class="custom-select">
                                    <option value="recent">Más recientes</option>
                                    <option value="oldest">Más antiguos</option>
                                    <option value="deadline">Fecha límite</option>
                                    <option value="payment">Mayor pago</option>
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
                            <span>Mostrando <strong>3</strong> de <strong>8</strong> proyectos</span>
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
                        <div class="project-card-container highlight">
                            <div class="project-card-header">
                                <h3>Desarrollo App Móvil</h3>
                                <span class="project-status in-progress">En progreso</span>
                                <span class="highlight-badge">Prioritario</span>
                            </div>

                            <div class="project-card-body">
                                <div class="project-client">
                                    <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff"
                                        alt="Tech Solutions">
                                    <div>
                                        <h3>Tech Solutions</h3>
                                        <p>Empresa • 4.8 ★</p>
                                    </div>
                                </div>

                                <p class="project-description">Desarrollo de aplicación de comercio electrónico para iOS
                                    y Android con React Native. Se requiere integración con API de pagos y sistema de
                                    recomendaciones.</p>

                                <div class="project-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Inicio: 15 Jun 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Límite: 15 Ago 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-wallet"></i>
                                        <span>Presupuesto: $2,800</span>
                                    </div>
                                </div>

                                <div class="project-progress">
                                    <div class="progress-info">
                                        <span>Progreso</span>
                                        <span>65%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 65%"></div>
                                    </div>
                                </div>

                                <div class="project-skills">
                                    <span>React Native</span>
                                    <span>Firebase</span>
                                    <span>Node.js</span>
                                </div>
                            </div>

                            <div class="project-card-footer">
                                <div class="project-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-comments"></i> Chat
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-tasks"></i> Tareas
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Proyecto 2 -->
                        <div class="project-card-container">
                            <div class="project-card-header">
                                <h3>API Sistema de Pagos</h3>
                                <span class="project-status active">Activo</span>
                            </div>

                            <div class="project-card-body">
                                <div class="project-client">
                                    <img src="https://ui-avatars.com/api/?name=Fintech+Inc&background=1a1a2e&color=fff"
                                        alt="Fintech Inc">
                                    <div>
                                        <h3>Fintech Inc</h3>
                                        <p>Startup • 4.5 ★</p>
                                    </div>
                                </div>

                                <p class="project-description">Desarrollo de API segura para procesamiento de pagos con
                                    Node.js y Stripe. Implementación de webhooks y sistema de notificaciones.</p>

                                <div class="project-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Inicio: 1 Jul 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Límite: 30 Sep 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-wallet"></i>
                                        <span>Presupuesto: $3,500</span>
                                    </div>
                                </div>

                                <div class="project-progress">
                                    <div class="progress-info">
                                        <span>Progreso</span>
                                        <span>25%</span>
                                    </div>
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 25%"></div>
                                    </div>
                                </div>

                                <div class="project-skills">
                                    <span>Node.js</span>
                                    <span>Stripe API</span>
                                    <span>MongoDB</span>
                                </div>
                            </div>

                            <div class="project-card-footer">
                                <div class="project-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-comments"></i> Chat
                                    </button>
                                    <button class="btn btn-primary btn-small" id="btn-task">
                                        <i class="fas fa-tasks"></i> Tareas
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Proyecto 3 -->
                        <div class="project-card-container">
                            <div class="project-card-header">
                                <h3>Rediseño Sitio Web</h3>
                                <span class="project-status completed">Completado</span>
                            </div>

                            <div class="project-card-body">
                                <div class="project-client">
                                    <img src="https://ui-avatars.com/api/?name=Creative+Agency&background=4a25a8&color=fff"
                                        alt="Creative Agency">
                                    <div>
                                        <h3>Creative Agency</h3>
                                        <p>Agencia • 4.9 ★</p>
                                    </div>
                                </div>

                                <p class="project-description">Rediseño completo del sitio web corporativo con WordPress
                                    y WooCommerce. Optimización de velocidad y diseño responsive.</p>

                                <div class="project-meta">
                                    <div class="meta-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Inicio: 1 May 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-clock"></i>
                                        <span>Completado: 10 Jun 2023</span>
                                    </div>
                                    <div class="meta-item">
                                        <i class="fas fa-wallet"></i>
                                        <span>Ganancia: $1,200</span>
                                    </div>
                                </div>

                                <div class="project-rating">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                    <span>4.7/5.0</span>
                                </div>

                                <div class="project-skills">
                                    <span>WordPress</span>
                                    <span>WooCommerce</span>
                                    <span>PHP</span>
                                </div>
                            </div>

                            <div class="project-card-footer">
                                <div class="project-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-eye"></i> Ver
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-redo"></i> Repetir
                                    </button>
                                </div>
                            </div>
                        </div>
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
    </div>
    
</body>
<script src="../../assets/js/proyectos.js"></script>

</html>