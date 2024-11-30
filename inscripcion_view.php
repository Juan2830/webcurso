<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción a Cursos</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Función para ocultar el mensaje después de unos segundos
        function ocultarMensaje() {
            setTimeout(function() {
                const mensajeDiv = document.getElementById('mensaje-exito');
                if (mensajeDiv) {
                    mensajeDiv.style.display = 'none';
                }
            }, 3000); // El mensaje desaparecerá después de 3 segundos
        }

        // Función para confirmar la inscripción
        function confirmarInscripcion(curso) {
            return confirm("¿Estás seguro de que deseas inscribirte en el curso de '" + curso + "'?");
        }
    </script>
</head>
<body>
    <header>
        <h1>Sistema de Inscripción a Cursos</h1>
        <!-- Botón para volver al inicio -->
        <a href="index.php" class="btn-volver">Volver al inicio</a>
        <!-- Botón de Cerrar sesión -->
        <a href="logout.php" class="btn-logout">Cerrar sesión</a>
    </header>

    <main>
        <h2>Cursos Disponibles</h2>

        <!-- Mostrar mensaje de inscripción exitosa si existe -->
        <?php if ($mensaje): ?>
            <div id="mensaje-exito" class="mensaje-exito">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
            <script>ocultarMensaje();</script> <!-- Llamada a la función para ocultar el mensaje -->
        <?php endif; ?>

        <!-- Barra de búsqueda -->
        <form action="inscripcion.php" method="POST">
            <input type="text" name="search" placeholder="Buscar por nombre del curso" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn">Buscar</button>
        </form>

        <?php
        // Verificar si hay cursos
        if ($result->num_rows > 0) {
            // Mostrar los cursos
            while ($curso = $result->fetch_assoc()) {
                echo '<div class="curso">';
                echo '<h3>' . htmlspecialchars($curso['nombre']) . '</h3>';
                echo '<p>' . htmlspecialchars($curso['descripcion']) . '</p>';
                echo '<p><strong>Fecha de inicio:</strong> ' . htmlspecialchars($curso['fecha_inicio']) . '</p>';
                echo '<p><strong>Fecha de fin:</strong> ' . htmlspecialchars($curso['fecha_fin']) . '</p>';

                // Verificar si el usuario ya está inscrito en el curso
                $check_query = "SELECT * FROM inscripciones WHERE usuario_id = '" . $_SESSION['usuario_id'] . "' AND curso_id = '" . $curso['id'] . "'";
                $check_result = $conn->query($check_query);

                if ($check_result->num_rows > 0) {
                    // Mostrar "Ya inscrito" si el usuario ya está inscrito
                    echo '<p>Ya inscrito</p>';
                } else {
                    // Botón para inscribirse con confirmación
                    echo '<form action="inscripcion.php" method="POST" onsubmit="return confirmarInscripcion(\'' . htmlspecialchars($curso['nombre']) . '\')">
                            <input type="hidden" name="curso_id" value="' . $curso['id'] . '">
                            <button type="submit" class="btn">Inscribirse</button>
                          </form>';
                }

                echo '</div>';
            }
        } else {
            echo '<p>No se encontraron cursos que coincidan con la búsqueda.</p>';
        }
        ?>

    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Inscripción</p>
    </footer>
</body>
</html>
