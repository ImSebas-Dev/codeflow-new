<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$estados = [
    'Abierto' => '#0d6efd',
    'En progreso' => '#ffc107',
    'Finalizado' => '#198754',
];

$proyectosPorEstado = [];

function obtenerProyectosPorEstado($conn, $estado) {
    $id_empresa = $_SESSION['id_empresa'];
    $stmt = $conn->prepare("SELECT * FROM proyectos WHERE estado = ? AND id_empresa = ?");
    $stmt->bind_param("si", $estado, $id_empresa);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado ->fetch_all(MYSQLI_ASSOC);
}

function obtenerColorEstado($estado, $estados) {
    return $estados[$estado] ?? '#000000';
}

foreach (array_keys($estados) as $estado) {
    $proyectosPorEstado[$estado] = obtenerProyectosPorEstado($conn, $estado);
}
?>