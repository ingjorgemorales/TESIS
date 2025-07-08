<?php
$fecha_hora = isset($_POST['fecha_hora']) ? $_POST['fecha_hora'] : "NULL";
$id_r = isset($_POST['id_r']) ? $_POST['id_r'] : "NULL";
$id_patologia = isset($_POST['id_patologia']) ? $_POST['id_patologia'] : "NULL";
$descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : "NULL";
$nivel_gravedad = isset($_POST['nivel_gravedad']) ? $_POST['nivel_gravedad'] : "NULL";
$porcentaje = isset($_POST['porcentaje']) ? $_POST['porcentaje'] . "%" : "NULL";
$tipo_de_fractura = isset($_POST['tipo_de_fractura']) ? $_POST['tipo_de_fractura'] : "None";

include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Registrar_diagnostico($descripcion,$nivel_gravedad,$porcentaje, $tipo_de_fractura, $fecha_hora, $id_r, $id_patologia);

if ($resultado['success']) {
    header("Location: actualizar_diagnostico.php?ms=✅Se ha registrado correctamente&type=ok");
} else {
    $msg = urlencode($resultado['error']); 
    header("Location: actualizar_diagnostico.php?ms=$msg&type=error");
}

?>