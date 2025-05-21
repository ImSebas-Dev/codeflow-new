<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id_usuario'])) {
    header('Location: http://localhost/codeflow-new/codeflow/views/public/login.html');
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

// Obtener el rol del usuario
$stmt_rol = $conn->prepare("SELECT id_rol FROM Usuarios WHERE id_usuario = ?");
$stmt_rol->bind_param("i", $id_usuario);
$stmt_rol->execute();
$stmt_rol->store_result();

// Verificar si el ID existe
if ($stmt_rol->num_rows > 0) {
    $stmt_rol->bind_result($id_rol);
    $stmt_rol->fetch();

    $_SESSION["id_rol"] = $id_rol;

    // Obtener el ID del freelancer o empresa según el rol
    switch ($id_rol) {
        case '1':
            $consulta = "SELECT * FROM Freelancers f 
                            INNER JOIN Suscripciones s ON f.id_usuario = s.id_usuario
                            WHERE f.id_usuario =?";
            break;
        case '2':
            $consulta = "SELECT * FROM Empresas e
                            INNER JOIN Suscripciones s ON e.id_usuario = s.id_usuario
                            WHERE e.id_usuario =?";
            break;
        default:
            echo "Rol desconocido";
            exit();
    }

    $stmt = $conn->prepare($consulta);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $datos = $resultado->fetch_assoc();

    $nombre_usuario = ($id_rol == 2) ? $datos['nombre_empresa'] : $datos['nombre'];
} else {
    echo "ID no encontrado";
}
?>