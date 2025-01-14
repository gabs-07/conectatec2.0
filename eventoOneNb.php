<?php
session_start(); // Iniciar la sesión

// Incluir solo una vez la clase DB
require_once 'includes/DB.php';  // Usamos require_once para evitar múltiples inclusiones

try {
    // Conectar a la base de datos
    $db = new DB();
    $dbConnection = $db->connect();

    // Verificar si la conexión fue exitosa
    if (!$dbConnection) {
        throw new Exception("Error al conectar a la base de datos.");
    }

    // Manejo del comentario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comentario'])) {
        $comentario = htmlspecialchars($_POST['comentario']); // Sanitizar el comentario

        if (!empty($comentario)) {
            try {
                // Usar un nombre de usuario predeterminado, ya que no estamos manejando autenticación
                $usuario = "Anónimo";  
                
                // Consulta para insertar el comentario con la fecha actual (NOW())
                $query = $dbConnection->prepare("INSERT INTO comentariosNB (usuario, comentario, fecha) VALUES (:usuario, :comentario, NOW())");
                $query->execute([
                    'usuario' => $usuario,
                    'comentario' => $comentario
                ]);
                echo "Comentario agregado exitosamente.<br>";
            } catch (PDOException $e) {
                throw new Exception("Error al agregar comentario: " . $e->getMessage());
            }
        } else {
            echo "El comentario no puede estar vacío.<br>";
        }
    }

    // Recuperar y mostrar los comentarios
    try {
        $query = $dbConnection->prepare("SELECT * FROM comentariosNB ORDER BY fecha DESC");
        $query->execute();
        $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        throw new Exception("Error al obtener los comentarios: " . $e->getMessage());
    }
} catch (Exception $e) {
    // Mostrar el error en caso de excepciones generales
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/index.css">
    <link rel="stylesheet" href="public/css/vEventoOneIA.css">
    <title>Estrategias para la Migración a la Nube - NB</title>
</head>
<body>

    <?php include('layout/login/nav.php'); ?>
    
    <section>
        <h2>Estrategias para la migración a la nube</h2>

        <div>
            <div class="descripcion">
                <h2>Descripción del Evento:</h2>
                <p>
                En este evento, se compartió las mejores prácticas para realizar migraciones exitosas a la nube.
                Se abordaron temas como la evaluación de plataformas cloud, la optimización de costos y la seguridad 
                en entornos híbridos. Los asistentes aprendieron a diseñar estrategias personalizadas para sus 
                organizaciones, asegurando una transición fluida. Se incluyeron estudios de caso de empresas que 
                lograron reducir costos operativos y mejorar la escalabilidad mediante soluciones en la nube.
                </p>
            </div>

            <div class="imagen">
                <img class="ilustracion" src="src/image/noticiaNBone.jpg" alt="Estrategias para la migración a la nube">
            </div>
        </div>
    </section>

    <div class="event-details">
        <div class="event-info">
            <h3>Detalles del Evento</h3>
            <ul>
                <li><strong>Categoría:</strong> La nube</li>
                <li><strong>Modalidad:</strong> Presencial</li>
                <li><strong>Fecha y Hora:</strong> 7 de marzo de 2024, de 10:00 a 15:00 (GMT-5)</li>
                <li><strong>Entidad Responsable:</strong> CloudWorks</li>
                <li><strong>Costo:</strong> $20 por persona </li>
                <li><strong>Capacidad Máxima:</strong> 100 participantes</li>
                <li><strong>Estado del Evento:</strong> Terminado </li>
            </ul>
        </div>

        <div class="map">
            <h2>Ubicación de ESCOM</h2>
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3762.5153126030557!2d-99.14889788552042!3d19.5046492868124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f94c06d75fd7%3A0x3fe1567da2190ac9!2sESCOM%20-%20Escuela%20Superior%20de%20C%C3%B3mputo%20-%20IPN!5e0!3m2!1ses-419!2smx!4v1699812345678!5m2!1ses-419!2smx"  
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

    <div>
        <h3>Deja tu comentario</h3>
        <form action="eventoOneNb.php" method="post">
            <textarea name="comentario" rows="4" cols="50" placeholder="Escribe tu comentario aquí..." required></textarea><br><br>
            <button type="submit">Enviar Comentario</button>
        </form>
    </div>

    <div>
        <h3>Comentarios</h3>
        <?php if (!empty($comentarios)): ?>
            <ul>
                <?php foreach ($comentarios as $comentario): ?>
                    <li><strong><?php echo htmlspecialchars($comentario['usuario']); ?>:</strong> <?php echo htmlspecialchars($comentario['comentario']); ?> <em>(<?php echo htmlspecialchars($comentario['fecha']); ?>)</em></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay comentarios aún.</p>
        <?php endif; ?>
    </div>
</body>
</html>