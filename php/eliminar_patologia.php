<?php
$id_patologia= $_POST['id'] ?? null;
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Eliminar_patologia($id_patologia);
header("Location: mostrar_patologias.php");

?>