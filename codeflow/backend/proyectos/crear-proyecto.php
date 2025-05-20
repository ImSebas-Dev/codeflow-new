<?php
include "../conexion/conexion.php";
session_start();

if (!isset($_SESSION['id_empresa'])) {
    header("Location: http://localhost/pruebas/views/public/login.html");
    exit();
}

$id_empresa = $_SESSION['id_empresa'];

$id_freelancer = null; // Si aún no se ha seleccionado un freelancer, se establece como null

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
    $sql = "INSERT INTO Proyectos (id_empresa, id_freelancer, titulo, descripcion, monto, fecha_finalizacion) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt == false) {
        echo "Error al preparar la consulta." . $conn->error;
        exit();
    }

    $stmt->bind_param("iissss", $id_empresa, $id_freelancer, $titulo, $descripcion, $presupuesto, $fecha_limite);

    if ($stmt->execute()) {
        header("Location: http://localhost/pruebas/views/empresas/proyectos.php");
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