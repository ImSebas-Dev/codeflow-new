<?php
include '../conexion/conexion.php';
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo-suscripcion'];
    $valor = $_POST['valor-suscripcion'];

    // Insertar suscripción en la base de datos
    $sql = "INSERT INTO Suscripciones (id_usuario, tipo_suscripcion, valor) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt == false) {
        echo "Error al preparar la consulta." . $conn->error;
    }

    $stmt->bind_param("isd", $id_usuario, $tipo, $valor);

    if ($stmt->execute()) {
        header("Location: http://localhost/codeflow-new/codeflow/views/public/suscripcion.html");
        exit();
    } else {
        echo "Error al insertar los datos: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido";
}

?>