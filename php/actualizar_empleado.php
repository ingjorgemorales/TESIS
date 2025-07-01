<?php
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$email = $_POST['email'];
$celular = $_POST['celular'];
$especialidad = $_POST['especialidad'];
$pass = $_POST['pass'];
$fotoPerfil = $_POST['fotoPerfil'] ?? '';
$nombreArchivo = ''; // Inicializar para evitar warning
$validarFoto = $_POST['validarFoto'] ?? '';
include_once("Cservicios.php");
$objconsulta = new cCliente;



if (isset($_FILES['fotoPerfil']) && $_FILES['fotoPerfil']['error'] === UPLOAD_ERR_OK) {
    $nombreTmp = $_FILES['fotoPerfil']['tmp_name'];
    $extension = pathinfo($_FILES['fotoPerfil']['name'], PATHINFO_EXTENSION);

    // Generar nombre aleatorio
    $nombreAleatorio = bin2hex(random_bytes(10)); // o usa uniqid()
    $nombreArchivo = $nombreAleatorio . '.' . $extension;

    $directorio = '../assets/upload/';
    $rutaDestino = $directorio . $nombreArchivo;
    
    // Crear carpeta si no existe
    if (!file_exists($directorio)) {
        mkdir($directorio, 0777, true);
    }

    if (move_uploaded_file($nombreTmp, $rutaDestino)) {
        $rutaImagen = $rutaDestino;
        echo "<script>console.log('Imagen subida con éxito: " . $rutaImagen . "');</script>";
    } else {
        echo "<script>console.error('Error al mover la imagen al destino');</script>";
    }
} else {
    $nombreArchivo = $validarFoto; 
    echo "<script>console.error('No se recibió una imagen válida');</script>";
}



$resultado= $objconsulta->Actualizar_empleado($nombre, $apellido, $direccion, $email, $celular, $especialidad, $pass, $nombreArchivo);



if ($resultado['success']) {
    header("Location: configurar.php?ms=✅ Los datos se ha Actualizado correctamente&type=ok");
} else {
    $msg = urlencode($resultado['error']); 
    header("Location: configurar.php?ms=Hubo un problema $msg&type=ok");
}


?>