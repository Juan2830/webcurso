<?php
session_start();
include 'conexion.php';
include 'login.html';

// Verificar si ya está logueado
if (isset($_SESSION['usuario_id'])) {
    header('Location: index.html'); // Redirigir al sistema principal si ya está logueado
    exit;
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validar los campos
    if (empty($email) || empty($password)) {
        echo 'Por favor, complete todos los campos.';
    } else {
        // Sanitarizar y validar el correo electrónico
        $email = $conn->real_escape_string(trim($email));

        // Verificar si el email está registrado en la base de datos
        $query = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // El usuario existe, verificar la contraseña
            $user = $result->fetch_assoc();

            // Verificar si la contraseña ingresada es correcta
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario_nombre'] = $user['nombre']; // Puedes almacenar otros datos si lo deseas
                header('Location: index.php'); // Redirigir al sistema principal
                exit;
            } else {
                echo 'Contraseña incorrecta.';
            }
        } else {
            echo 'Correo electrónico no registrado.';
        }
    }
}
?>
