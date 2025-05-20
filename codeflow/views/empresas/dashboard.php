<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empresa - CodeFlow</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
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

            <div class="company-profile">
                <div class="company-avatar">
                    <img src="https://ui-avatars.com/api/?name=Tech+Solutions&background=6e3aed&color=fff"
                        alt="Tech Solutions">
                </div>
                <div class="company-info">
                    <h3>Tech Solutions</h3>
                    <p>Plan Empresa</p>
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
                            <i class="fas fa-users"></i>
                            <span>Freelancers</span>
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
                            <span>Facturación</span>
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
                    <button class="message-btn">
                        <i class="fas fa-envelope"></i>
                        <span class="message-badge">5</span>
                    </button>
                    <div class="user-dropdown" id="user-dropdown">
                        <div class="user-avatar">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Usuario">
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Bienvenida y estadísticas -->
                <section class="welcome-section">
                    <div class="welcome-message">
                        <h1>Bienvenido, <span>Tech Solutions</span></h1>
                        <p>Aquí tienes un resumen de tu actividad reciente</p>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="stat-info">
                                <h3>12</h3>
                                <p>Proyectos activos</p>
                            </div>
                            <div class="stat-trend up">
                                <i class="fas fa-arrow-up"></i> 2 nuevos
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-info">
                                <h3>8</h3>
                                <p>Freelancers trabajando</p>
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
                                <h3>24</h3>
                                <p>Proyectos completados</p>
                            </div>
                            <div class="stat-trend">
                                <i class="fas fa-equals"></i> estable
                            </div>
                        </div>

                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="stat-info">
                                <h3>$8,450</h3>
                                <p>Invertido este mes</p>
                            </div>
                            <div class="stat-trend down">
                                <i class="fas fa-arrow-down"></i> 15% menos
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Gráficos y proyectos recientes -->
                <section class="analytics-section">
                    <div class="analytics-chart">
                        <div class="section-header">
                            <h2>Actividad mensual</h2>
                            <select class="chart-period">
                                <option>Últimos 7 días</option>
                                <option selected>Últimos 30 días</option>
                                <option>Últimos 90 días</option>
                            </select>
                        </div>
                        <canvas id="activityChart"></canvas>
                    </div>

                    <div class="recent-projects">
                        <div class="section-header">
                            <h2>Proyectos</h2>
                            <a href="proyectos.php" class="view-all">Ver todos</a>
                        </div>

                        <div class="projects-list">
                            <div class="project-card">
                                <div class="project-header">
                                    <h3>Desarrollo de App Móvil</h3>
                                    <span class="project-status in-progress">En progreso</span>
                                </div>
                                <p class="project-description">Aplicación de comercio electrónico para iOS y Android con
                                    React Native</p>
                                <div class="project-meta">
                                    <div class="project-budget">
                                        <i class="fas fa-wallet"></i>
                                        <span>$2,500 - $3,000</span>
                                    </div>
                                    <div class="project-deadline">
                                        <i class="fas fa-calendar-alt"></i>
                                        <span>Vence en 15 días</span>
                                    </div>
                                </div>
                                <div class="project-team">
                                    <div class="team-avatars">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Freelancer"
                                            title="Carlos M.">
                                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Freelancer"
                                            title="Ana L.">
                                        <span class="more-members">+2</span>
                                    </div>
                                    <a href="#" class="btn btn-outline btn-small">Ver detalles</a>
                                </div>
                            </div>

                            <div class="project-card">
                                <div class="project-header">
                                    <h3>Rediseño de Sitio Web</h3>
                                    <span class="project-status completed">Completado</span>
                                </div>
                                <p class="project-description">Rediseño completo del sitio web corporativo con WordPress
                                </p>
                                <div class="project-meta">
                                    <div class="project-budget">
                                        <i class="fas fa-wallet"></i>
                                        <span>$1,200</span>
                                    </div>
                                    <div class="project-rating">
                                        <i class="fas fa-star"></i>
                                        <span>4.8/5.0</span>
                                    </div>
                                </div>
                                <div class="project-team">
                                    <div class="team-avatars">
                                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Freelancer"
                                            title="María R.">
                                    </div>
                                    <button class="btn btn-primary btn-small">Contratar nuevamente</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Freelancers recomendados y actividad reciente -->
                <section class="recommendations-section">
                    <div class="recommended-freelancers">
                        <div class="section-header">
                            <h2>Freelancers recomendados</h2>
                            <a href="#" class="view-all">Ver todos</a>
                        </div>

                        <div class="freelancers-grid">
                            <div class="freelancer-card">
                                <div class="freelancer-header">
                                    <div class="freelancer-avatar">
                                        <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Freelancer">
                                        <span class="online-status"></span>
                                    </div>
                                    <div class="freelancer-info">
                                        <h3>David González</h3>
                                        <p>Desarrollador Fullstack</p>
                                    </div>
                                </div>
                                <div class="freelancer-skills">
                                    <span>React</span>
                                    <span>Node.js</span>
                                    <span>MongoDB</span>
                                </div>
                                <div class="freelancer-meta">
                                    <div class="freelancer-rating">
                                        <i class="fas fa-star"></i>
                                        <span>4.9</span>
                                        <span>(42 proyectos)</span>
                                    </div>
                                    <div class="freelancer-rate">
                                        <span>$50/h</span>
                                    </div>
                                </div>
                                <div class="freelancer-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-eye"></i> Ver perfil
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-paper-plane"></i> Contactar
                                    </button>
                                </div>
                            </div>

                            <div class="freelancer-card">
                                <div class="freelancer-header">
                                    <div class="freelancer-avatar">
                                        <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Freelancer">
                                    </div>
                                    <div class="freelancer-info">
                                        <h3>Laura Fernández</h3>
                                        <p>Diseñadora UI/UX</p>
                                    </div>
                                </div>
                                <div class="freelancer-skills">
                                    <span>Figma</span>
                                    <span>Adobe XD</span>
                                    <span>Prototipado</span>
                                </div>
                                <div class="freelancer-meta">
                                    <div class="freelancer-rating">
                                        <i class="fas fa-star"></i>
                                        <span>4.7</span>
                                        <span>(28 proyectos)</span>
                                    </div>
                                    <div class="freelancer-rate">
                                        <span>$45/h</span>
                                    </div>
                                </div>
                                <div class="freelancer-actions">
                                    <button class="btn btn-outline btn-small">
                                        <i class="fas fa-eye"></i> Ver perfil
                                    </button>
                                    <button class="btn btn-primary btn-small">
                                        <i class="fas fa-paper-plane"></i> Contactar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="recent-activity">
                        <div class="section-header">
                            <h2>Actividad reciente</h2>
                            <a href="#" class="view-all">Ver todo</a>
                        </div>

                        <div class="activity-list">
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Carlos Méndez</strong> entregó una actualización para <strong>App
                                            Móvil</strong></p>
                                    <span class="activity-time">Hace 2 horas</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="activity-content">
                                    <p>Completaste el pago a <strong>Ana López</strong> por <strong>Rediseño de Sitio
                                            Web</strong></p>
                                    <span class="activity-time">Ayer, 15:32</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-comment-dots"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>María Rodríguez</strong> envió un mensaje sobre <strong>API
                                            Desarrollo</strong></p>
                                    <span class="activity-time">Ayer, 11:45</span>
                                </div>
                            </div>

                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-user-plus"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>David González</strong> aplicó a tu proyecto <strong>Plataforma
                                            E-learning</strong></p>
                                    <span class="activity-time">20 Jun, 2023</span>
                                </div>
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
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Usuario">
                            </div>
                            <div>
                                <h3>María Rodríguez</h3>
                                <p>maria@example.com</p>
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
    <script src="../../assets/js/dashboard.js"></script>
</body>

</html>