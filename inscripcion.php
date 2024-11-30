<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) {
    // Si no hay sesión activa, redirigir al inicio de sesión
    header('Location: login.php');
    exit;
}

// Conectar a la base de datos
include 'conexion.php';

// Variables para mostrar mensajes
$mensaje = "";
$nombre_curso = "";

// Verificar si se ha enviado una búsqueda
$search = "";
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $query = "SELECT * FROM cursos WHERE nombre LIKE '%$search%'";
} else {
    // Si no hay búsqueda, mostrar todos los cursos
    $query = "SELECT * FROM cursos";
}

// Verificar si se está inscribiendo a un curso
if (isset($_POST['curso_id'])) {
    $curso_id = $_POST['curso_id'];
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar cuántos cursos está inscrito el usuario
    $inscripciones_query = "SELECT COUNT(*) AS total_inscripciones FROM inscripciones WHERE usuario_id = '$usuario_id'";
    $inscripciones_result = $conn->query($inscripciones_query);
    $inscripciones = $inscripciones_result->fetch_assoc();

    // Si el usuario está inscrito en menos de 6 cursos, se puede inscribir
    if ($inscripciones['total_inscripciones'] < 6) {
        // Verificar si el usuario ya está inscrito en el curso
        $check_query = "SELECT * FROM inscripciones WHERE usuario_id = '$usuario_id' AND curso_id = '$curso_id'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows == 0) {
            // Obtener el nombre del curso
            $curso_query = "SELECT nombre FROM cursos WHERE id = '$curso_id'";
            $curso_result = $conn->query($curso_query);
            if ($curso_result->num_rows > 0) {
                $curso = $curso_result->fetch_assoc();
                $nombre_curso = $curso['nombre'];
            }

            // Insertar inscripción en la base de datos
            $inscribir_query = "INSERT INTO inscripciones (usuario_id, curso_id) VALUES ('$usuario_id', '$curso_id')";
            if ($conn->query($inscribir_query) === TRUE) {
                // Mensaje de éxito
                $mensaje = "Inscripción exitosa ✅. Ahora estás inscrito en el curso de '$nombre_curso'.";
            } else {
                // Mensaje de error
                $mensaje = "Hubo un problema al intentar inscribirte en el curso.";
            }
        } else {
            $mensaje = "Ya estás inscrito en este curso.";
        }
    } else {
        $mensaje = "Ya estás inscrito en el máximo de 6 cursos.";
    }
}

$result = $conn->query($query);

// Pasar el mensaje y resultados a la vista
include 'inscripcion_view.php';
?>
