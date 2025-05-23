<?php
// Configuración de encabezados para AJAX
header('Content-Type: application/json');
include "../conexion/conexion.php";
session_start();

// Verificar que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener los datos del formulario
    $nombre = $_POST['nombre-freelancer'];
    $correo = $_POST['correo-freelancer'];
    $contra = password_hash($_POST['password-freelancer'], PASSWORD_BCRYPT);
    $titulo = $_POST['titulo-freelancer'];
    $descripcion = $_POST['bio-freelancer'];
    $telefono = $_POST['phone-freelancer'];
    $genero = $_POST['gender-freelancer'];

    // Verificar si el correo ya está registrado
    $sql_verificar = "SELECT id_usuario FROM Usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql_verificar);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "El correo ya está registrado";
    } else {
        // Obtener el rol de freelancer
        $query_rol = "SELECT id_rol FROM Roles WHERE nombre = 'freelancer'";
        $result_rol = mysqli_query($conn, $query_rol);
        $rol = mysqli_fetch_assoc($result_rol);

        if (!$rol) {
            echo "Error al obtener el rol de freelancer";
            exit(); // Salir del script si no se encuentra el rol de freelancer
        }

        $id_rol = $rol['id_rol'];

        // Insertar datos en la tabla Usuarios
        $query_insert = "INSERT INTO Usuarios (correo, contra, id_rol) VALUES (?,?,?)";
        $stmt = $conn->prepare($query_insert);
        $stmt->bind_param("ssi", $correo, $contra, $id_rol);

        if ($stmt->execute()) {
            // Obtener el ID del usuario recién insertado
            $id_usuario = $conn->insert_id;

            // Insertar datos en la tabla Freelancers
            $query_insert_freelancer = "INSERT INTO Freelancers (id_usuario, nombre, correo, telefono, titulo, descripcion_freelancer, genero) VALUES (?,?,?,?,?,?,?)";
            $stmt_freelancer = $conn->prepare($query_insert_freelancer);
            $stmt_freelancer->bind_param("issssss", $id_usuario, $nombre, $correo, $telefono, $titulo, $descripcion, $genero);

            // Insertar datos en la tabla Suscripciones
            $query_insert_suscripcion = "INSERT INTO Suscripciones (id_usuario, tipo_suscripcion, valor) VALUES (?,'Básico',0)";
            $stmt_suscripcion = $conn->prepare($query_insert_suscripcion);
            $stmt_suscripcion->bind_param("i", $id_usuario);

            if ($stmt_freelancer->execute() && $stmt_suscripcion->execute()) {
                header("Location: http://localhost/codeflow-new/codeflow/views/public/login.html");
                exit();
            } else {
                echo "Error al insertar datos en la tabla Freelancers: " . $stmt_freelancer->error;
            }
        } else {
            echo "Error al insertar datos en la tabla Usuarios: ". $stmt->error;
        }
    }

} else {
    die("Método no permitido");
}
?>