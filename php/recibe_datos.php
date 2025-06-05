<?php
$id = $_POST['id'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$sexo = $_POST['sexo'];
$observaciones = $_POST['observaciones'];
$radiografia = $_POST['radiografia'];
$categoria = $_POST['categoria'];
$zona = $_POST['zona'];

include_once("php/Cservicios.php");
$objconsulta = new cCliente;
$resultado= $objconsulta->registrar_diagnostico($id,$nombres,$apellidos,$edad,$sexo,$observaciones,$radiografia,$categoria,$zona);
include_once('examen.html');
include_once('php/notificacion1.php');

?>