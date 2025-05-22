<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$estado = 'Abierto';

function obtenerProyectosAbiertos($conn) {
    $sql = "SELECT p.*, e.nombre_empresa
        FROM Proyectos p
        INNER JOIN Empresas e ON p.id_empresa = e.id_empresa
        WHERE p.estado = 'Abierto'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado->fetch_all(MYSQLI_ASSOC);
}

function obtenerProyectosFreelancer($conn) {
    $id_freelancer = $_SESSION['id_freelancer']; // Obtener el ID del freelancer logueado

    $sql_freelancer = "SELECT DISTINCT pf.id_proyecto_freelancer, pr.*,
                            e.nombre_empresa, 
                            p.estado AS estado_postulacion
                        FROM Proyectos_Freelancer pf
                        INNER JOIN Proyectos pr ON pf.id_proyecto = pr.id_proyecto
                        INNER JOIN Postulaciones p ON pf.id_postulacion = p.id_postulacion
                        INNER JOIN Empresas e ON pr.id_empresa = e.id_empresa
                        WHERE p.estado = 'Aceptada' AND pf.id_freelancer = ? AND pr.estado = 'En progreso'";
    $stmt_freelancer = $conn->prepare($sql_freelancer);
    $stmt_freelancer->bind_param("i", $id_freelancer);
    $stmt_freelancer->execute();
    $resultado_freelancer = $stmt_freelancer->get_result();
    return $resultado_freelancer->fetch_all(MYSQLI_ASSOC);
}

$proyectosAbiertos = obtenerProyectosAbiertos($conn);
$proyectosFreelancer = obtenerProyectosFreelancer($conn);
?>