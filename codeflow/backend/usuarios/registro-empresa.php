<?php
include "../conexion/conexion.php";
session_start();

// Verificar que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener datos del formulario empresa
    $nombre_empresa = $_POST["nombre-empresa"];
    $correo_corporativo = $_POST["correo-empresa"];
    $contra_empresa = password_hash($_POST["password-empresa"], PASSWORD_BCRYPT);
    $phone_empresa = $_POST["phone-empresa"];
    $industria = $_POST["industria"];

    // Verificar si el correo ya está registrado
    $sql_verificar = "SELECT id_usuario FROM Usuarios WHERE correo = ?";
    $stmt = $conn->prepare($sql_verificar);
    $stmt->bind_param("s", $correo_corporativo);
    $stmt->execute();
    $stmt->store_result();

    if($stmt->num_rows > 0){
        echo "El correo ya está registrado";
    } else {
        // Obtener el rol de empresa
        $query_rol = "SELECT id_rol FROM Roles WHERE nombre = 'empresa'";
        $result_rol = mysqli_query($conn, $query_rol);
        $rol = mysqli_fetch_assoc($result_rol);

        if (!$rol) {
            echo "Error al obtener el rol de empresa";
            exit(); // Salir del script si no se encuentra el rol de empres
        }

        $id_rol = $rol['id_rol'];

        // Insertar datos en la tabla Usuarios
        $query_insert = "INSERT INTO Usuarios (correo, contra, id_rol) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query_insert);
        $stmt->bind_param("ssi", $correo_corporativo, $contra_empresa, $id_rol);

        if ($stmt->execute()) {
            // Obtener el ID del usuario recién insertado
            $id_usuario = $stmt->insert_id;

            // Insertar datos en la tabla Empresas
            $query_insert_empresa = "INSERT INTO Empresas (id_usuario, nombre_empresa, correo_corporativo, telefono,  industria) VALUES (?,?,?,?,?)";
            $stmt_empresa = $conn->prepare($query_insert_empresa);
            $stmt_empresa->bind_param("issss", $id_usuario, $nombre_empresa, $correo_corporativo, $phone_empresa, $industria);

            if ($stmt_empresa->execute()) {
                header("Location: http://localhost/pruebas/views/public/login.html");
                exit();
            } else {
                echo "Error al insertar datos en la tabla Empresas: " . $stmt_empresa->error;
            }
        } else {
            echo "Error al insertar datos en la tabla Usuarios: ". $stmt->error;
        }
    }

} else {
    die("Método no permitido");
}

$stmt->close();
$conn->close();
?>