<?php
// Conectar a la base de datos
$conexion = new mysqli("127.0.0.1", "root", "", "x-ray");

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si se recibió un ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Convertir a entero para mayor seguridad

    // Preparar la consulta
    $query = "SELECT radiografia FROM diagnostico WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($imagen);
    $stmt->fetch();

    if ($imagen) {
        // Convertir la imagen a base64
        $imagen_base64 = base64_encode($imagen);
        echo "<img src='data:image/jpeg;base64," . $imagen_base64 . "' style='width: 100px; height: 100px;'/>";
    } else {
        echo "<p>No hay imagen disponible.</p>";
    }

    // Cerrar la conexión
    $stmt->close();
    $conexion->close();
} else {
    echo "<p>ID de paciente no proporcionado.</p>";
}
?>
