<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once '../../backend/conexion/conexion.php';
include_once '../../backend/usuarios/obtener-usuario.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción Premium - CodeFlow</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
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
                        <span>4.8</span>
                        <span>(85 proyectos)</span>
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
                    <li>
                        <a href="mis-proyectos.php">
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
                    <li class="active">
                        <a href="suscripcion.php">
                            <i class="fas fa-coins"></i>
                            <span>Suscripciones</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

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
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuario">
                        </div>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </header>

            <div class="dashboard-content">
                <section class="subscription-section">
                    <div class="subscription-header">
                        <h1><i class="fas fa-crown"></i> Actualizar Suscripción</h1>
                        <p>Elige el plan que mejor se adapte a tus necesidades como freelancer o empresa</p>
                    </div>

                    <div class="plans-container">
                        <div class="plan-card recommended">
                            <div class="recommended-badge">Recomendado</div>
                            <div class="plan-header">
                                <h3>Profesional</h3>
                                <div class="plan-price">
                                    <span class="price">$29</span>
                                    <span class="period">/mes</span>
                                </div>
                            </div>
                            <ul class="plan-features">
                                <li><i class="fas fa-check"></i> Proyectos ilimitados</li>
                                <li><i class="fas fa-check"></i> 15 propuestas/mes</li>
                                <li><i class="fas fa-check"></i> Estadísticas avanzadas</li>
                                <li><i class="fas fa-check"></i> Soporte prioritario</li>
                            </ul>
                            <button class="btn btn-primary plan-select" data-info="1">
                                Seleccionar
                            </button>
                        </div>

                        <div class="plan-card">
                            <div class="plan-header">
                                <h3>Empresa</h3>
                                <div class="plan-price">
                                    <span class="price">$99</span>
                                    <span class="period">/mes</span>
                                </div>
                            </div>
                            <ul class="plan-features">
                                <li><i class="fas fa-check"></i> Todo en Profesional</li>
                                <li><i class="fas fa-check"></i> Gestión de equipo</li>
                                <li><i class="fas fa-check"></i> Facturación anual</li>
                                <li><i class="fas fa-check"></i> Asesor personal</li>
                            </ul>
                            <button class="btn btn-outline plan-select" data-info="2">
                                Seleccionar
                            </button>
                        </div>
                    </div>
                </section>
            </div>
        </main>

        <!-- Modal información de suscripción -->
        <div class="payment-form-container" id="paymentForm" style="display: none;">
            <h2><i class="fas fa-credit-card"></i> Información de Pago</h2>

            <form id="subscriptionForm" method="POST" action="../../backend/suscripciones/asignar-suscripcion.php">
                <div class="form-group">
                    <label for="card-number">Número de Tarjeta*</label>
                    <div class="input-with-icon card-input">
                        <i class="far fa-credit-card"></i>
                        <input type="text" id="cardNumber" name="numero-tarjeta" placeholder="1234 5678 9012 3456" required>
                        <div class="card-icons">
                            <i class="fab fa-cc-visa"></i>
                            <i class="fab fa-cc-mastercard"></i>
                            <i class="fab fa-cc-amex"></i>
                        </div>
                    </div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="card-expiry">Fecha de Expiración*</label>
                        <div class="input-text">
                            <input type="text" id="cardExpiry" name="fecha-expiracion" placeholder="MM/AA" required
                            pattern="(0[1-9]|1[0-2])\/\d{2}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="cardCvc">Código CVC*</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="text" id="cardCvc" name="cvc" placeholder="123" required pattern="\d{3,4}"
                                maxlength="4">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="cardName">Nombre en la Tarjeta*</label>
                    <div class="input-text">
                        <input type="text" id="cardName" name="nombre-propietario" placeholder="Como aparece en la tarjeta" 
                                value="<?php echo htmlspecialchars($nombre_usuario) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="billingEmail">Correo para facturación*</label>
                    <div class="input-text">
                        <input type="email" id="billingEmail" name="correo-propietario" placeholder="tucorreo@example.com" 
                                value="<?php echo htmlspecialchars($datos['correo']) ?>" required>
                    </div>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="saveCard" checked>
                    <label for="saveCard">Guardar información de pago para futuras suscripciones</label>
                </div>

                <div class="form-group checkbox-group">
                    <input type="checkbox" id="termsAgreement" required>
                    <label for="termsAgreement">Acepto los <a href="#">Términos de Servicio</a> y la <a
                            href="#">Política de Privacidad</a></label>
                </div>

                <div class="payment-summary">
                    <div class="summary-item">
                        <span>Plan seleccionado:</span>
                        <span id="planSummary"></span>
                        <input type="hidden" id="planInput" name="tipo">
                    </div>
                    <div class="summary-item">
                        <span>Impuestos:</span>
                        <span id="taxSummary"></span>
                    </div>
                    <div class="summary-item total">
                        <span>Total a pagar:</span>
                        <span id="totalSummary"></span>
                        <input type="hidden" id="precioInput" name="valor">
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary buy-now">
                        <i class="fas fa-lock"></i> Pagar ahora
                    </button>
                </div>
            </form>
        </div>

        <!-- Modal de confirmacion -->
        <div class="confirmation-container" id="confirmation" style="display: none;">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>¡Pago completado con éxito!</h2>
            <p id="confirmationMessage">Tu suscripción al plan Profesional ha sido activada. Recibirás un
                correo con los detalles.</p>

            <div class="confirmation-details">
                <div class="detail-item">
                    <span>ID de transacción:</span>
                    <span>CF-789456123</span>
                </div>
                <div class="detail-item">
                    <span>Fecha de pago:</span>
                    <span id="paymentDate"></span>
                </div>
                <div class="detail-item">
                    <span>Próximo cobro:</span>
                    <span id="nextPayment"></span>
                </div>
            </div>

            <button class="btn btn-primary" id="goToDashboard">
                <i class="fas fa-tachometer-alt"></i> Volver
            </button>
        </div>

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

    <script src="../../assets/js/suscripcion.js" defer></script>
</body>

</html>