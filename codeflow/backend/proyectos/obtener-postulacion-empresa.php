<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$sql = "SELECT p.*,
            pr.titulo AS nombre_proyecto,
            f.nombre AS nombre_freelancer,
            f.titulo AS titulo_freelancer,
            f.descripcion_freelancer
        FROM Postulaciones p
        INNER JOIN Proyectos pr ON p.id_proyecto = pr.id_proyecto
        INNER JOIN Freelancers f ON p.id_freelancer = f.id_freelancer
        WHERE pr.id_empresa = ? AND p.estado = 'Pendiente'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION["id_empresa"]);
$stmt->execute();
$resultado = $stmt->get_result();
$datos_postulacion = $resultado->fetch_all(MYSQLI_ASSOC);
?>