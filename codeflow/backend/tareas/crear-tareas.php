<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../conexion/conexion.php'; // Aquí conectas a tu BD

// Asegúrate de que el freelancer esté logueado
if (!isset($_SESSION['id_freelancer'])) {
    die("Acceso denegado.");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_freelancer = $_SESSION['id_freelancer'];
    $id_proyecto_freelancer = $_POST['id-proyecto-freelancer'];
    $titulo = $_POST['task-title'];
    $descripcion = $_POST['task-description'];
    $reposirotio = $_POST['task-repository'];
    $fecha_limite = $_POST['limit-date'];

    // Validaciones estrictas
    if (empty($titulo) || empty($descripcion) || empty($reposirotio) || empty($fecha_limite)) {
        die("Por favor, complete todos los campos.");
    }

    // Preparar la consulta SQL para insertar la tarea
    $sql = "INSERT INTO Tareas (id_proyecto_freelancer, titulo, descripcion, repositorio, fecha_entrega) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $id_proyecto_freelancer, $titulo, $descripcion, $reposirotio, $fecha_limite);

    if ($stmt->execute()) {
        header("Location: http://localhost/codeflow-new/codeflow/views/freelancers/mis-proyectos.php");
        exit();
    } else {
        die("Error al insertar la tarea: " . $stmt->error);
    }
    $stmt->close();
    $conn->close();
} else {
    die("Método de solicitud no válido.");
}
?>