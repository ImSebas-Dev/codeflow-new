<?php
include "../conexion/conexion.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = filter_var($_POST["correo"], FILTER_SANITIZE_EMAIL);
    $contra = $_POST["password"];

    // Consulta para obtener el ID del usuario, la contraseña y el rol
    $stmt = $conn->prepare("SELECT id_usuario, contra, id_rol FROM Usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();

    // Verificar si el correo existe
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_usuario, $hashed_password, $rol);
        $stmt->fetch();

        // Verificar la contraseña
        if (password_verify($contra, $hashed_password)) {
            $_SESSION["id_usuario"] = $id_usuario;
            $_SESSION["id_rol"] = $rol;

            // Obtener el ID del freelancer o empresa según el rol
            if ($rol == 1) {
                $sql_freelancer = "SELECT id_freelancer FROM Freelancers WHERE id_usuario = ?";
                $stmt_freelancer = $conn->prepare($sql_freelancer);
                $stmt_freelancer->bind_param("i", $id_usuario);
                $stmt_freelancer->execute();
                $stmt_freelancer->bind_result($id_freelancer);
                if ($stmt_freelancer->fetch()) {
                    $_SESSION["id_freelancer"] = $id_freelancer; 
                }
                $stmt_freelancer->close();
            } elseif ($rol == 2) {
                $sql_empresa = "SELECT id_empresa FROM Empresas WHERE id_usuario =?";
                $stmt_empresa = $conn->prepare($sql_empresa);
                $stmt_empresa->bind_param("i", $id_usuario);
                $stmt_empresa->execute();
                $stmt_empresa->bind_result($id_empresa);
                if ($stmt_empresa->fetch()) {
                    $_SESSION["id_empresa"] = $id_empresa;
                }
                $stmt_empresa->close();
            }

            //Redirigir según el rol
            if ($rol == 1) {
                header("Location: http://localhost/codeflow-new/codeflow/views/freelancers/dashboard.php");
            } elseif ($rol == 2) {
                header("Location: http://localhost/codeflow-new/codeflow/views/empresas/dashboard.php");
            } else {
                echo "Rol no válido";
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Correo no registrado";
    }

    $stmt->close();
    $conn->close();
}