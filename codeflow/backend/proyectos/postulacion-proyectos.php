<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_freelancer = $_SESSION['id_freelancer'];
    $id_proyecto = $_POST['id-proyecto'];
    $id_proyecto = (int) $id_proyecto;

    // Verificar si el freelancer ya ha postulado al proyecto
    $sql = "SELECT * FROM Postulaciones WHERE id_freelancer = $id_freelancer AND id_proyecto = $id_proyecto";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo 'Ya has postulado a este proyecto.';
    } else {
        // Insertar la postulación en la base de datos
        $sql = "INSERT INTO Postulaciones (id_freelancer, id_proyecto) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id_freelancer, $id_proyecto);
        if ($stmt->execute()) {
            header('Location: http://localhost/codeflow-new/codeflow/views/freelancers/proyectos.php');
            exit();
        } else {
            echo 'Error al postular al proyecto: ' . $stmt->error;
        }
    }
}

$stmt->close();
$conn->close();
?>