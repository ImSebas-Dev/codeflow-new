<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Tareas - CodeFlow</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <div class="task-detail-container">
        <header class="task-detail-header">
            <a href="proyectos.php" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Volver a proyectos
            </a>
            <h1>Tareas: <span id="detailProjectTitle">Desarrollo App Móvil</span></h1>
            <div class="project-meta">
                <span class="project-status in-progress">En progreso</span>
                <span><i class="fas fa-calendar-alt"></i> Límite: 15 Ago 2023</span>
                <span><i class="fas fa-wallet"></i> Presupuesto: $2,800</span>
            </div>
        </header>

        <div class="task-detail-content">
            <aside class="task-sidebar">
                <div class="task-stats-card">
                    <h3>Progreso general</h3>
                    <div class="progress-circle large" data-progress="65">
                        <svg viewBox="0 0 36 36">
                            <path class="circle-bg"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                            <path class="circle-fill" stroke-dasharray="65, 100"
                                d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                        </svg>
                        <span class="progress-text">65%</span>
                    </div>
                    <div class="stats-grid">
                        <div class="stat">
                            <span class="stat-number">5</span>
                            <span class="stat-label">Completadas</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">8</span>
                            <span class="stat-label">Totales</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">3</span>
                            <span class="stat-label">Pendientes</span>
                        </div>
                    </div>
                </div>

                <div class="task-actions-card">
                    <button class="btn btn-primary btn-block">
                        <i class="fas fa-plus"></i> Nueva tarea
                    </button>
                    <div class="filters">
                        <h4>Filtrar</h4>
                        <select class="custom-select">
                            <option>Todas</option>
                            <option>Completadas</option>
                            <option>Pendientes</option>
                            <option>Prioritarias</option>
                        </select>
                        <select class="custom-select">
                            <option>Ordenar por defecto</option>
                            <option>Fecha ascendente</option>
                            <option>Fecha descendente</option>
                            <option>Prioridad</option>
                        </select>
                    </div>
                </div>
            </aside>

            <main class="task-main-content">
                <div class="task-list-container">
                    <!-- Tarea detallada ejemplo -->
                    <article class="task-card expanded">
                        <div class="task-card-header">
                            <label class="task-checkbox">
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>
                            <h3>Integrar API de pagos</h3>
                            <div class="task-priority high">
                                <i class="fas fa-exclamation-circle"></i> Prioridad alta
                            </div>
                            <button class="task-toggle">
                                <i class="fas fa-chevron-down"></i>
                            </button>
                        </div>

                        <div class="task-card-body">
                            <div class="task-description">
                                <p>Integrar Stripe API para procesamiento de pagos en la app. Incluir:</p>
                                <ul>
                                    <li>Configuración de webhooks</li>
                                    <li>Pantalla de checkout</li>
                                    <li>Manejo de errores</li>
                                </ul>
                            </div>

                            <div class="task-meta">
                                <div class="meta-item">
                                    <i class="fas fa-calendar-day"></i>
                                    <span><strong>Vence:</strong> 20 Jul 2023</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-user-tag"></i>
                                    <span><strong>Asignada a:</strong> Carlos Martínez</span>
                                </div>
                                <div class="meta-item">
                                    <i class="fas fa-tag"></i>
                                    <span class="task-tag backend">Backend</span>
                                    <span class="task-tag api">API</span>
                                </div>
                            </div>

                            <div class="task-attachments">
                                <h4><i class="fas fa-paperclip"></i> Repositorios adjuntos</h4>
                                <div class="attachments-grid">
                                    <div class="input-with-icon">
                                        <i class="fa-brands fa-github"></i>
                                        <input type="text" class="input-repository" name="repositorio">
                                    </div>
                                </div>
                                <button class="btn btn-outline btn-small">
                                    <i class="fas fa-plus"></i> Añadir repositorio
                                </button>
                            </div>

                            <div class="task-comments">
                                <h4><i class="fas fa-comments"></i> Comentarios</h4>
                                <div class="comment">
                                    <div class="comment-author">
                                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Carlos M.">
                                        <span>Carlos Martínez</span>
                                        <small>Hoy 14:30</small>
                                    </div>
                                    <p>He configurado las credenciales de desarrollo. Falta implementar el webhook de
                                        confirmación.</p>
                                </div>

                                <form class="comment-form">
                                    <textarea placeholder="Añadir comentario..."></textarea>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-paper-plane"></i> Enviar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="task-card-footer">
                            <button class="btn btn-outline">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-outline error">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </article>

                    <!-- Más tareas... -->
                </div>
            </main>
        </div>
    </div>

    <script src="../../assets/js/main.js"></script>
</body>

</html>