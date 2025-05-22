<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../conexion/conexion.php'; // Aquí conectas a tu BD

// Asegúrate de que el freelancer esté logueado
if (!isset($_SESSION['id_freelancer'])) {
    die("Acceso denegado.");
}

$id_freelancer = $_SESSION['id_freelancer'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id_proyecto = $_POST['id-proyecto'];
    $titulo = $_POST['task-title'];
    $descripcion = $_POST['task-description'];
    $reposirotio = $_POST['task-repository'];
    $fecha_limite = $_POST['limit-date'];

    // Validaciones estrictas
    if (empty($titulo) || empty($descripcion) || empty($reposirotio) || empty($fecha_limite)) {
        die("Por favor, complete todos los campos.");
    }

    // Preparar la consulta SQL para insertar la tarea
    $sql = "INSERT INTO Tareas (id_freelancer, id_proyecto, titulo, descripcion, repositorio, fecha_limite) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $id_freelancer, $id_proyecto, $titulo, $descripcion, $reposirotio, $fecha_limite);

    if ($stmt->execute()) {
        header("Location: ../views/freelancers/tareas.php");
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