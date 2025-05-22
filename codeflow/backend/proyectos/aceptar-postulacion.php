<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_postulacion = $_POST['id-postulacion'];
    $estado = $_POST['accion'];

    $sql = "UPDATE Postulaciones SET estado = ? WHERE id_postulacion = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $estado, $id_postulacion);
    $stmt->execute();
    $stmt->close();

    if ($estado === 'Aceptada') {
        // Obtenemos los ids relacionados desde la postulación
        $stmt = $conn->prepare("SELECT id_proyecto, id_freelancer FROM Postulaciones WHERE id_postulacion = ?");
        $stmt->bind_param("i", $id_postulacion);
        $stmt->execute();
        $stmt->bind_result($id_proyecto, $id_freelancer);
        $stmt->fetch();
        $stmt->close();

        // Insertamos en Proyectos_Freelancer
        $stmt = $conn->prepare("INSERT INTO Proyectos_Freelancer (id_proyecto, id_freelancer, id_postulacion) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $id_proyecto, $id_freelancer, $id_postulacion);
        $stmt->execute();
        $stmt->close();

        // Actualizamos el estado del proyecto a 'En progreso'
        $stmt = $conn->prepare("UPDATE Proyectos SET estado = 'En progreso' WHERE id_proyecto = ?");
        $stmt->bind_param("i", $id_proyecto);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: http://localhost/codeflow-new/codeflow/views/empresas/postulaciones.php');
    exit();
    
} else {
    echo 'Error al postular al proyecto: '. $stmt->error;
}

$stmt->close();
$conn->close();
?>