<?php
include "../conexion/conexion.php";
session_start();

if (!isset($_SESSION['id_empresa'])) {
    header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
    exit();
}

$id_empresa = $_SESSION['id_empresa'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['title-project'];
    $descripcion = $_POST['description-project'];
    $presupuesto = $_POST['budget-project'];
    $fecha_limite = $_POST['limit-date'];

    // Validaciones estrictas
    if (empty($titulo) || empty($descripcion) || empty($presupuesto) || empty($fecha_limite)) {
        echo "Por favor, complete todos los campos.";
        exit();
    }

    if (!is_numeric($presupuesto) || $presupuesto <= 0) {
        echo "El presupuesto debe ser un número positivo.";
        exit();
    }

    // Insertar el proyecto en la base de datos
    $sql = "INSERT INTO Proyectos (id_empresa, titulo, descripcion, monto, fecha_finalizacion) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt == false) {
        echo "Error al preparar la consulta." . $conn->error;
        exit();
    }

    $stmt->bind_param("issss", $id_empresa, $titulo, $descripcion, $presupuesto, $fecha_limite);

    if ($stmt->execute()) {
        header("Location: http://localhost/codeflow-new/codeflow/views/empresas/proyectos.php");
        exit();
    } else {
        echo "Error al insertar el proyecto: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
} else {
    echo "Método de solicitud no válido.";
}
?>