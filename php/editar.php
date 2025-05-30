<?php 
include_once("Cservicios.php");
$objconsulta = new cCliente;
//$resultado= $objconsulta->consultar_todo_diagnosticos();
//include_once('notificacion2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/Style/editar.css" />
    <title>X-RAY DIAGNOSTIC</title>
</head>

<body>

    <div style="width: 100%;  height: 14%; border-bottom: 2px solid white; position: absolute; top: -2px"  id="encabezado">
    
        <img style="height: 69px;"
         src="../assets/logo_x_ray.png"
        alt="logoapliB11031"
        class="medicalassured-logoapli-b11"
      />


      <div style="width: 77px; height: 73px; position: relative; top: -70px; left: 170px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8); border-radius:44px;">
        <img style="width: 102%; height: auto; " src="../assets/icono_doctor.png" alt="">
    </div>

       <div style="font-size: 16px; width: 292px; height: 40px; position: relative; top: -130px; left: 270px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8); background-color: white; border-radius: 2px;">
    <div style="position: absolute; top:10px; background-color: #2DC071; width: 20px ; height: 20px; border-radius: 20px; left: 250px;"></div>

   <span style="position: relative; top: 10px; left: 10px;"> DR. JORGE MORALES </span>
    </div>

<!-- From Uiverse.io by LightAndy1 --> 




        </div>
        <div style="width: 99%; height: 400px;  border: 2px; position: absolute; top: 100px" >
    <div style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6); position: relative; width:443px ; height:248px; background-color: white;  top:-433px; left:790px; z-index: -1;">
        <img style="width: 25%; height: auto; position: relative; top: 20%; left: 38%;" src="./assets/pluginIcon 4.png" alt="">
        <div id="previewContainer" style="width: 100%; height: auto; position: absolute; left: 25%; top: 0px;">
            <img id="previewImage" src="" alt="Vista previa" style=" width: 100%; height: auto; display: none; max-width: 245px; max-height: 400px; border: 0px solid #ddd; padding: 1px;">
        </div>
    </div>
            </div>



            <div class="form-container">
        <h2 style="color: white;">Ingrese El Id del Diagnostico Para Empezar El Analísis</h2>
        <form action="editar3.php" method="POST">
            <input type="text" name="id" placeholder="Cédula del paciente" required>
            <button type="submit">Enviar</button>
        </form>
    </div>

           

            <div style="display: flex; ">
       <a href="../examen.html"> <button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px;margin: 10px;  width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_examen.png" alt=""> 
        EXAMEN</button></a>
       <a href="consultar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_lupa.png" alt=""> 
        CONSULTAR</button></a>
        <a href="../configurar.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_ajustes.png" alt=""> 
            AJUSTES</button></a>
        <a href="editar.php"><button style="background-color:  #2DC071;  border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_editar.png" alt=""> 
            EDITAR</button></a>
            <a href="../index.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
           <img style="width: 90px; height: 70px; position: absolute; top:-17px; right: 150px;" src="../assets/icono_salida.png" alt=""> 
           SALIR</button></a>

    </div>
    </body>


    
</html>