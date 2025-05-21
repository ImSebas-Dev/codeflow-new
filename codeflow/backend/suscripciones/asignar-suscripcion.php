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
    $monto = $_POST['valor-suscripcion'];
    $cvc = $_POST['cvc'];
    $fechaExpiracion = $_POST['fecha_expiracion'];
    $tipo = $_POST['tipo-suscripcion'];

    // Insertar datos en la tabla Pagos
    $query_insert = "INSERT INTO Pagos (id_usuario, numero_tarjeta, propietario_tarjeta, propietario_tarjeta, monto, cvc, fecha_expiracion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query_insert);
    $stmt->bind_param("issssss", $id_usuario, $numeroTarjeta, $nombrePropietario, $correoPropietario, $monto, $cvc, $fechaExpiracion);

    if ($stmt->execute()) {
        // Obtener el ID del usuario recién insertado
        $id_usuario = $stmt->insert_id;
        $montoSuscripcion = $monto;

        // Insertar datos en la tabla Suscripciones
        $query_insert_empresa = "INSERT INTO Suscripciones (id_usuario, tipo_suscripcion, valor) VALUES (?,?,?)";
        $stmt_empresa = $conn->prepare($query_insert_empresa);
        $stmt_empresa->bind_param("iss", $id_usuario, $tipo, $montoSuscripcion);

        if ($stmt_empresa->execute()) {
            header("Location: http://localhost/codeflow-new/codeflow/views/public/suscripcion.html");
            exit();
        } else {
            echo "Error al insertar datos en la tabla Suscripciones: " . $stmt_empresa->error;
        }
    } else {
        echo "Error al insertar datos en la tabla Pagos: ". $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}

?>