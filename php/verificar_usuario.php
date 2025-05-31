<?php 
session_start();

$id_empleado = $_POST['id_empleado'];
$password = $_POST['password'];

include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->verificar_usuario($id_empleado, $password);
if ($resultado && $resultado->num_rows > 0) {
    $row = mysqli_fetch_array($resultado); 

    if ($row) {
        $_SESSION['k_id'] = $row['Cedula']; 
        $resultado = $objconsulta->verificar_usuario($id_empleado, $password);
           header("Location: examen.php");
    } else {
     header("Location: ../login.html?error=1");
exit;

    }
} else {
        header("Location: ../login.html?error=1");
exit;


}
?>
