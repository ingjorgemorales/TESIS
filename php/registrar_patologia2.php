<?php
$nombre_patologia = $_POST['nombre_patologia'] ?? 'NULL';
$tipo_patologia = $_POST['tipo_patologia'] ?? 'NULL';
$descripcion_patologia = $_POST['descripcion_patologia'] ?? 'NULL';

include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Registrar_patologia($nombre_patologia, $tipo_patologia, $descripcion_patologia);
if ($resultado['success']) {
    header("Location: registrar_patologia.php?ms=✅Se ha registrado correctamente&type=ok");
} else {
    $msg = urlencode($resultado['error']); 
    header("Location: registrar_patologia.php?ms=$msg&type=error");
}
?>