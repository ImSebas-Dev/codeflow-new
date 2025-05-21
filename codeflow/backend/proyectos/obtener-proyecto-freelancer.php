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

$proyectosAbiertos = obtenerProyectosAbiertos($conn);
?>