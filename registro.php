<?php
// Iniciar la sesión
session_start();

// Incluir la conexión a la base de datos
include 'conexion.php';
include 'registro.html';

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores de los campos del formulario
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string(trim($_POST['nombre'])) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string(trim($_POST['email'])) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirmar_password = isset($_POST['confirmar_password']) ? $_POST['confirmar_password'] : '';

    // Validación de campos
    if (empty($nombre) || empty($email) || empty($password) || empty($confirmar_password)) {
        $_SESSION['error'] = 'Error: Todos los campos son obligatorios.';
        header('Location: registro.php');
        exit;
    }

    // Validar formato de email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Error: Correo electrónico inválido.';
        header('Location: registro.php');
        exit;
    }

    // Validar que las contraseñas coinciden
    if ($password !== $confirmar_password) {
        $_SESSION['error'] = 'Error: Las contraseñas no coinciden.';
        header('Location: registro.php');
        exit;
    }

    // Verificar si el email ya está registrado
    $query_check = "SELECT * FROM usuarios WHERE email = '$email'";
    $result_check = $conn->query($query_check);

    if ($result_check->num_rows > 0) {
        $_SESSION['error'] = 'Error: Este correo electrónico ya está registrado.';
        header('Location: registro.php');
        exit;
    }

    // Cifrar la contraseña
    $password_cifrado = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario en la base de datos
    $query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password_cifrado')";

    if ($conn->query($query) === TRUE) {
        $_SESSION['success'] = '¡Registro exitoso! Puedes <a href="login.php">iniciar sesión</a> ahora.';
        header('Location: registro.php');
        exit;
    } else {
        $_SESSION['error'] = 'Error: No se pudo completar el registro. Intenta nuevamente.';
        header('Location: registro.php');
        exit;
    }
}

$conn->close();
?>
