<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Dashboard - CodeFlow</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.css">
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
                    <h3>Carlos Méndez</h3>
                    <p>Desarrollador Fullstack</p>
                    <div class="freelancer-rating">
                        <i class="fas fa-star"></i>
                        <span>4.8</span>
                        <span>(85 proyectos)</span>
                    </div>
                </div>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="active">
                        <a href="#">
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
                    <li>
                        <a href="#">
                            <i class="fas fa-diagram-project"></i>
                            <span>Mis Proyectos</span>
                        </a>
                    </li>
                    <li>
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
                        <a href="../public/suscripcion.html">
                            <i class="fas fa-coins"></i>
                            <span>Suscripciones</span>
                        </a>
                    </li>
                </ul>
            </nav>
            
            <div class="sidebar-footer">
                <a href="#" class="btn btn-primary btn-block">
                    <i class="fas fa-search"></i> Buscar proyectos
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
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos Méndez">
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>
            
            <div class="dashboard-content">
                <!-- Bienvenida y estadísticas -->
                <section class="welcome-section">
                    <div class="welcome-message">
                        <h1>Bienvenido, <span>Carlos</span></h1>
                        <p>Aquí tienes un resumen de tu actividad y proyectos</p>
                    </div>
                    
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-info">
                                <h3>5</h3>
                                <p>Proyectos activos</p>
                            </div>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i> 1 nuevo
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="stat-info">
                                <h3>85</h3>
                                <p>Proyectos completados</p>
                            </div>
                            <div class="stat-trend">
                                <i class="fas fa-equals"></i> estable
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div class="stat-info">
                                <h3>$3,250</h3>
                                <p>Ingresos este mes</p>
                            </div>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i> 20% más
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="stat-info">
                                <h3>92%</h3>
                                <p>Trabajos a tiempo</p>
                            </div>
                            <div class="stat-trend down">
                                <i class="fas fa-arrow-down"></i> 3% menos
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Proyectos y actividad -->
                <section class="projects-section">
                    <div class="current-projects">
                        <div class="section-header">
                            <h2>Proyectos activos</h2>
                            <a href="#" class="view-all">Ver todos</a>
                        </div>
                        
                        <div class="projects-list">
                            <div class="project-card">
                                <div class="project-header">
                                    <div class="project-client">
                                        <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff" alt="Tech Solutions">
                                        <div>
                                            <h3>App de Comercio Electrónico</h3>
                                            <p>Tech Solutions</p>
                                        </div>
                                    </div>
                                    <span class="project-status in-progress">En progreso</span>
                                </div>
                                <p class="project-description">Desarrollo de aplicación móvil con React Native y Firebase</p>
                                <div class="project-meta">
                                    <div class="project-deadline">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Entrega: 15 Ago 2023</span>
                                    </div>
                                    <div class="project-payment">
                                        <i class="fas fa-wallet"></i>
                                        <span>$2,500</span>
                                    </div>
                                </div>
                                <div class="project-progress">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 65%"></div>
                                    </div>
                                    <span>65% completado</span>
                                </div>
                                <div class="project-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-comments"></i> Mensajes
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-tasks"></i> Actualizar
                                    </button>
                                </div>
                            </div>
                            
                            <div class="project-card">
                                <div class="project-header">
                                    <div class="project-client">
                                        <img src="https://ui-avatars.com/api/?name=Digital+Agency&background=6e3aed&color=fff" alt="Digital Agency">
                                        <div>
                                            <h3>API REST para Plataforma</h3>
                                            <p>Digital Agency</p>
                                        </div>
                                    </div>
                                    <span class="project-status review">En revisión</span>
                                </div>
                                <p class="project-description">Desarrollo de API con Node.js, Express y MongoDB</p>
                                <div class="project-meta">
                                    <div class="project-deadline">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Entrega: 5 Ago 2023</span>
                                    </div>
                                    <div class="project-payment">
                                        <i class="fas fa-wallet"></i>
                                        <span>$1,800</span>
                                    </div>
                                </div>
                                <div class="project-progress">
                                    <div class="progress-bar">
                                        <div class="progress-fill" style="width: 100%"></div>
                                    </div>
                                    <span>100% completado</span>
                                </div>
                                <div class="project-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-comments"></i> Mensajes
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-check"></i> Finalizar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="freelancer-activity">
                        <div class="section-header">
                            <h2>Tu actividad</h2>
                            <a href="#" class="view-all">Ver historial</a>
                        </div>
                        
                        <div class="activity-chart">
                            <canvas id="freelancerChart"></canvas>
                        </div>
                        
                        <div class="quick-actions">
                            <h3>Acciones rápidas</h3>
                            <div class="actions-grid">
                                <a href="#" class="action-card">
                                    <i class="fas fa-search"></i>
                                    <span>Buscar proyectos</span>
                                </a>
                                <a href="#" class="action-card">
                                    <i class="fas fa-file-alt"></i>
                                    <span>Crear propuesta</span>
                                </a>
                                <a href="#" class="action-card">
                                    <i class="fas fa-clock"></i>
                                    <span>Registrar horas</span>
                                </a>
                                <a href="#" class="action-card">
                                    <i class="fas fa-file-invoice"></i>
                                    <span>Generar factura</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Proyectos recomendados y clientes -->
                <section class="recommendations-section">
                    <div class="recommended-projects">
                        <div class="section-header">
                            <h2>Proyectos recomendados</h2>
                            <a href="#" class="view-all">Ver más</a>
                        </div>
                        
                        <div class="projects-grid">
                            <div class="project-card small">
                                <div class="project-header">
                                    <h3>Diseño UI/UX para App</h3>
                                    <span class="project-budget">$1,200 - $1,500</span>
                                </div>
                                <p class="project-description">Rediseño de interfaz para aplicación de salud móvil</p>
                                <div class="project-skills">
                                    <span>Figma</span>
                                    <span>UI/UX</span>
                                    <span>Prototipado</span>
                                </div>
                                <div class="project-meta">
                                    <div class="project-client">
                                        <i class="fas fa-building"></i>
                                        <span>HealthTech Inc.</span>
                                    </div>
                                    <div class="project-deadline">
                                        <i class="fas fa-clock"></i>
                                        <span>2 días restantes</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-small">
                                    <i class="fas fa-paper-plane"></i> Enviar propuesta
                                </button>
                            </div>
                            
                            <div class="project-card small">
                                <div class="project-header">
                                    <h3>Desarrollo WordPress</h3>
                                    <span class="project-budget">$800 - $1,000</span>
                                </div>
                                <p class="project-description">Creación de sitio web corporativo con WordPress y WooCommerce</p>
                                <div class="project-skills">
                                    <span>WordPress</span>
                                    <span>PHP</span>
                                    <span>WooCommerce</span>
                                </div>
                                <div class="project-meta">
                                    <div class="project-client">
                                        <i class="fas fa-building"></i>
                                        <span>Fashion Boutique</span>
                                    </div>
                                    <div class="project-deadline">
                                        <i class="fas fa-clock"></i>
                                        <span>5 días restantes</span>
                                    </div>
                                </div>
                                <button class="btn btn-primary btn-block btn-small">
                                    <i class="fas fa-paper-plane"></i> Enviar propuesta
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="client-connections">
                        <div class="section-header">
                            <h2>Tus clientes</h2>
                            <a href="#" class="view-all">Ver todos</a>
                        </div>
                        
                        <div class="clients-list">
                            <div class="client-card">
                                <div class="client-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff" alt="Tech Solutions">
                                </div>
                                <div class="client-info">
                                    <h3>Tech Solutions</h3>
                                    <div class="client-stats">
                                        <div class="client-projects">
                                            <i class="fas fa-briefcase"></i>
                                            <span>4 proyectos</span>
                                        </div>
                                        <div class="client-rating">
                                            <i class="fas fa-star"></i>
                                            <span>4.9/5.0</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline btn-small">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                            
                            <div class="client-card">
                                <div class="client-avatar">
                                    <img src="https://ui-avatars.com/api/?name=Digital+Agency&background=6e3aed&color=fff" alt="Digital Agency">
                                </div>
                                <div class="client-info">
                                    <h3>Digital Agency</h3>
                                    <div class="client-stats">
                                        <div class="client-projects">
                                            <i class="fas fa-briefcase"></i>
                                            <span>2 proyectos</span>
                                        </div>
                                        <div class="client-rating">
                                            <i class="fas fa-star"></i>
                                            <span>5.0/5.0</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline btn-small">
                                    <i class="fas fa-envelope"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="availability-card">
                            <h3>Disponibilidad</h3>
                            <p>Actualmente estás marcado como <strong>Disponible</strong></p>
                            <div class="availability-options">
                                <button class="btn btn-success btn-small">
                                    <i class="fas fa-check-circle"></i> Disponible
                                </button>
                                <button class="btn btn-outline btn-small">
                                    <i class="fas fa-moon"></i> Limitado
                                </button>
                                <button class="btn btn-outline btn-small">
                                    <i class="fas fa-times-circle"></i> No disponible
                                </button>
                            </div>
                        </div>
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
                                <h3>Carlos Méndez</h3>
                                <p>carlos@example.com</p>
                                <span class="badge-plan">Plan Empresa</span>
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

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
    <script src="../../assets/js/dashboard.js" defer></script>
</body>
</html>