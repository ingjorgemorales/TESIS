<?php

class cCliente{


function registrar_diagnostico($id,$nombres,$apellidos,$edad,$sexo,$observaciones,$radiografia,$categoria,$zona){
  $conexion = new mysqli("127.0.0.1", "root", "","x-ray");
  if ($conexion->connect_error) {
      die("conexion fallida" . $conexion->connect_error);
}
$fecha = date('d/m/y');

$sql = "INSERT INTO diagnostico (id_paciente, nombres, apellidos, edad, sexo, observaciones, radiografia, categoria, zona, fecha) 
            VALUES ('$id', '$nombres', '$apellidos', '$edad', '$sexo', '$observaciones', '$radiografia', '$categoria', '$zona', '$fecha');";
$rec = mysqli_query($conexion, $sql);
 return $rec;
}


function consultar_todo_diagnosticos(){
  $conexion = new mysqli("127.0.0.1", "root", "","x-ray");
  if ($conexion->connect_error) {
      die("conexion fallida" . $conexion->connect_error);
}

$sql = "SElECT * From diagnostico";
$rec = mysqli_query($conexion, $sql);
 return $rec;
}

function consultar_diagnosticos($id_paciente){

  $conexion = new mysqli("127.0.0.1", "root", "","x-ray");
  if ($conexion->connect_error) {
      die("conexion fallida" . $conexion->connect_error);
}

$sql = "SElECT * From diagnostico where id = '$id_paciente'";
$rec = mysqli_query($conexion, $sql);
 return $rec;

}
}





?>
