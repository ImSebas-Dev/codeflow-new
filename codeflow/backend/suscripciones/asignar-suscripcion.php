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

    // Insertar datos en la tabla Pagos
    $query_insert_pago = "INSERT INTO Pagos (id_usuario, numero_tarjeta, propietario_tarjeta, correo_tarjeta, monto, cvc, fecha_expiracion) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_pago = $conn->prepare($query_insert_pago);
    $stmt_pago->bind_param("issssss", $id_usuario, $numeroTarjeta, $nombrePropietario, $correoPropietario, $monto, $cvc, $fechaExpiracion);

    if ($stmt_pago->execute()) {
        // Obtener el ID de pago recién insertado
        $id_pago = $stmt_pago->insert_id;

        // Insertar datos en la tabla Suscripciones
        $query_insert = "INSERT INTO Suscripciones (id_usuario, id_pago, tipo_suscripcion, valor) VALUES (?,?,?,?)";
        $stmt = $conn->prepare($query_insert);
        $stmt->bind_param("iiss", $id_usuario, $id_pago, $tipo, $monto);

        if (!$stmt->execute()) {
            echo "Error al insertar datos en la tabla Suscripciones: ". $stmt->error;
        } else {
            exit();
        }

    } else {
        echo "Error al insertar datos en la tabla Pagos: ". $stmt_pago->error;
    }
    $stmt_pago->close();
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}
?>