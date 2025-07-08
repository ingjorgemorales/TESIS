<?php
$id_patologia = $_POST['id_patologia'];
$descripcion= $_POST['descripcion'];
$nivel_gravedad = $_POST['nivel_gravedad'];
$id_r = $_POST['id_r'];

echo $id_r;
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Actualizar_diagnostico($id_r, $id_patologia, $descripcion, $nivel_gravedad);
if ($resultado['success']) {
    header("Location: actualizar_diagnostico.php?ms=✅Se ha actualizardo correctamente&type=ok");
} else {
    header("Location: actualizar_diagnostico.php?ms=Se produjo un error al actualizar&type=error");
}
?>