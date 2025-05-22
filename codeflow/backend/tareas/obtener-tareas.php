<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function obtenerTareas($conn) {
    $id_freelancer = $_SESSION['id_freelancer']; // Obtener el ID del freelancer logueado

    $sql = "SELECT DISTINCT t.*, c.*, 
                p.titulo AS titulo_proyecto,
                p.estado,
                e.nombre_empresa
        FROM Tareas t
        INNER JOIN Proyectos_Freelancer pf ON t.id_proyecto_freelancer = pf.id_proyecto_freelancer
        INNER JOIN Comentarios c ON t.id_comentario = c.id_comentario
        INNER JOIN Proyectos p ON pf.id_proyecto = p.id_proyecto
        INNER JOIN Empresas e ON p.id_empresa = e.id_empresa
        WHERE pf.id_freelancer = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_freelancer);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}
$tareas = obtenerTareas($conn);
?>