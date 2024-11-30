<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir al inicio de sesión
    header('Location: login.php');
    exit;
}

// Incluir la conexión a la base de datos
include 'conexion.php';
include 'index.html';
?>
