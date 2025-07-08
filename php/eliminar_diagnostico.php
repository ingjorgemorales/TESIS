<?php
include_once("Cservicios.php");
$id_diagnostico = $_POST['id'];
$objconsulta = new cCliente;
$resultado = $objconsulta->Eliminar_Diagnostico($id_diagnostico);
if ($resultado) {
    echo 'ok';
} else {
    echo 'error';
}
?>
