<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../conexion/conexion.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroTarjeta = $_POST['numero-tarjeta'];
    $nombrePropietario = $_POST['nombre-propietario'];
    $correoPropietario = $_POST['correo-propietario'];
    $cvc = $_POST['cvc'];
    $fechaExpiracion = $_POST['fecha-expiracion'];
    $tipo = $_POST['tipo'];
    $monto = $_POST['valor'];

    // obtner el rol del usuario
    $query_rol = "SELECT id_rol FROM Usuarios WHERE id_usuario =?";
    $stmt_rol = $conn->prepare($query_rol);
    $stmt_rol->bind_param("i", $id_usuario);
    $stmt_rol->execute();
    $stmt_rol->bind_result($rol);
    $stmt_rol->fetch();
    $stmt_rol->close();

    // Insertar datos en la tabla Pagos
    $query_insert_pago = "INSERT INTO Pagos (id_usuario, numero_tarjeta, propietario_tarjeta, correo_tarjeta, monto, cvc, fecha_expiracion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_pago = $conn->prepare($query_insert_pago);
    $stmt_pago->bind_param("issssss", $id_usuario, $numeroTarjeta, $nombrePropietario, $correoPropietario, $monto, $cvc, $fechaExpiracion);

    if ($stmt_pago->execute()) {
        // Obtener el ID de pago recién insertado
        $id_pago = $stmt_pago->insert_id;
        $stmt_pago->close();
        $_SESSION['id_rol'] = $rol;

        if ($rol == 1 || $rol == 2) {
            // Verificar si el usuario ya tiene una suscripción activa y si es asi, eliminar la suscripción anterior
            $query_verificar_suscripcion = "SELECT COUNT(*) FROM Suscripciones WHERE id_usuario =?";
            $stmt_verificar_suscripcion = $conn->prepare($query_verificar_suscripcion);
            $stmt_verificar_suscripcion->bind_param("i", $id_usuario);
            $stmt_verificar_suscripcion->execute();
            $stmt_verificar_suscripcion->bind_result($count);
            $stmt_verificar_suscripcion->fetch();
            $stmt_verificar_suscripcion->close();

            if ($count > 0) {
                // Eliminar la suscripción anterior
                $query_eliminar_suscripcion = "DELETE FROM Suscripciones WHERE id_usuario =?";
                $stmt_eliminar_suscripcion = $conn->prepare($query_eliminar_suscripcion);
                $stmt_eliminar_suscripcion->bind_param("i", $id_usuario);
                $stmt_eliminar_suscripcion->execute();
                $stmt_eliminar_suscripcion->close();
            }

            // Insertar datos en la tabla Suscripciones
            $query_insert = "INSERT INTO Suscripciones (id_usuario, id_pago, tipo_suscripcion, valor) VALUES (?,?,?,?)";
            $stmt = $conn->prepare($query_insert);
            $stmt->bind_param("iiss", $id_usuario, $id_pago, $tipo, $monto);

            if ($stmt->execute()) {
                $url = ($rol == 1)
                    ? "http://localhost/codeflow-new/codeflow/views/freelancers/suscripcion.php"
                    : "http://localhost/codeflow-new/codeflow/views/empresas/suscripcion.php";
                header("Location: $url");
                exit();
            } else {
                echo "Error al insertar datos en la tabla Suscripciones: ". $stmt->error;
            }
        } else {
            echo "Error al obtener el rol del usuario";
        }
    } else {
        echo "Error al insertar datos en la tabla Pagos: ". $stmt_pago->error;
        $stmt_pago->close();
    }
} else {
    echo "Método de solicitud no válido";
}
$conn->close();
?>