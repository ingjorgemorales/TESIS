
<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado= $objconsulta->Usuario_logueado();
$result= $objconsulta->Consultar_empleado($resultado);
//echo "✅✅✅". $resultado;
if(empty($resultado)){
    header("Location: ../login.html");
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/Style/configurar.css" />
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

   <span style="position: relative; top: 10px; left: 10px;"> <?php while ($row = mysqli_fetch_array($result)){
    echo $row['Nombre'] . " " . $row['Apellido'];    
}
    ?>  </span>
    </div>

<!-- From Uiverse.io by LightAndy1 --> 
<div  class="group">
  <svg viewBox="0 0 24 24" aria-hidden="true" class="search-icon">
    <g>
      <path
        d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"
      ></path>
    </g>
  </svg>

  <input
    id="query"
    class="input"
    type="search"
    placeholder="Search..."
    name="searchbar"
  />
</div>



        </div>
        <div style="width: 99%; height: 400px;  border: 2px; position: absolute; top: 100px" >
    <div style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6); position: relative; width:443px ; height:248px; background-color: white;  top:-433px; left:790px; z-index: -1;">
        <img style="width: 25%; height: auto; position: relative; top: 20%; left: 38%;" src="./assets/pluginIcon 4.png" alt="">
        <div id="previewContainer" style="width: 100%; height: auto; position: absolute; left: 25%; top: 0px;">
            <img id="previewImage" src="" alt="Vista previa" style=" width: 100%; height: auto; display: none; max-width: 245px; max-height: 400px; border: 0px solid #ddd; padding: 1px;">
        </div>
    </div>
            </div>
<div class="contenedor" style="position: absolute; border: 3px; width: 1360px; height: 360px; top:100px; overflow-y: scroll;">
<div style="position: absolute; background-color: #8AC0FF;padding: 10PX; font-weight: bold; border-radius: 10px; top: 0px; left: 380px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    PANEL DE CONTROL
</div> 
<div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 90px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    &nbsp; &nbsp; &nbsp;  PREFERENCIAS DE USUARIOS
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 140px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Idioma &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 180px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Tema de la interfaz &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 220px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
   Unidades de medida &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
</button> 

<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 260px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Notificaciones &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 </button> 



 <div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 90px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    &nbsp; &nbsp; &nbsp;  PREFERENCIAS DE USUARIOS
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 140px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Calibración de escala&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 180px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Ajustes de visualización &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 220px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Formato de imágenes &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; 
</button> 








<div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 90px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    &nbsp; &nbsp; &nbsp;  SEGURIDAD Y PRIVACIDAD
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 140px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
   Contraseña y autenticacion&nbsp; &nbsp; 
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 180px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Permisos de usuario &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 220px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Cumplimiento normativo &nbsp; &nbsp; &nbsp;&nbsp; 
</button> 







<div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 350px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    &nbsp; &nbsp; &nbsp;  CONFIGURACIÓN DE ANÁLISIS
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 400px;; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Precisión de la IA &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 440px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Hallazgos automáticos &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 480px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Diagnósticos diferenciales &nbsp; &nbsp; &nbsp;&nbsp;
</button> 

<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 520px; left: 30px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Exportación de informes &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 




<div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 350px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
      INTEGRACIONES Y CONECTIVIDAD
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 400px;; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Conexión con PACS &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 440px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Sincronización en la nube &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 480px; left: 360px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Dispositivos externos &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
</button> 





<div style="width: 248px;position: absolute; background-color: #8AC0FF;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 350px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    &nbsp; &nbsp;&nbsp; &nbsp;  ACTUALIZACON Y SOPORTE
</div> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 400px;; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
  Conexión con PACS &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 440px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Registro de errores &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</button> 
<button style="border: 0px; width: 263px; position: absolute; background-color: #D9D9D9;padding: 8PX; font-weight: bold; font-size: 14px; border-radius: 2px; top: 480px; left: 690px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6);">
    Soporte técnico &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
</button> 





<div style="background-color:#474FA0; position: absolute; width: 280px; height: 800px; left: 1050px; top: 50px; border-radius: 10px;">
    <img style="position: absolute; top:10%; left: 20%; "src="../assets/imagen_radiologo.png" alt="">
    <a style="position: absolute;  top: 255px; left:40%; color: #8AC0FF;">Editar</a>
    <label style="font-size:14px; color: white; left: 10%; top: 35% ;position: absolute;" >Dr.Jorge Andrés Morales de la ossa</label></br>
    <label style="font-size:14px; color: white; left: 10%; top: 37% ;position: absolute;" >Esp. Radiologia</label></br>
    <label style="font-size:14px; color: white; left: 10%; top: 39% ;position: absolute;" >mjorge801@yahoo.com</label></br>
    <img style="position: absolute; top:85%; left: 15%; "src="../assets/Logo_traumas_y_fracturas.png" alt="">
    <label style="font-size:14px; color: rgba(199, 199, 199, 0.623); left: 20%; top: 95% ;position: absolute;" >Power by Digitaldreams.com </label></br>


</div>

</div>

<button style="color:#474FA0; background-color: #D9D9D9; width: 140px; font-size: 16px; padding: 10px; border-radius: 5px; position: absolute; top:480px; left: 30px; border: 0px;">
    <img style="width: 25px; height: 20px; position: absolute; top:8px; left: 13px; " src="../assets/icono_guardar.png" alt=""> 
    
        &nbsp; &nbsp;  &nbsp; Guardar</button>    
        
 <button style="color:#474FA0; background-color: #D9D9D9; width: 290px; font-size: 16px; padding: 10px; border-radius: 5px; position: absolute; top:480px; left: 200px; border: 0px;">
            <img style="width: 25px; height: 20px; position: absolute; top:8px; left: 13px; " src="../assets/icono_ajustes.png" alt=""> 
            
                &nbsp; &nbsp;  &nbsp; Restablecer valores de fabrica</button>   

            <div style="display: flex; ">
       <a href="examen.php"> <button style="background-color:  #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px;margin: 10px;  width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_examen.png" alt=""> 
        EXAMEN</button></a>
       <a href="consultar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_lupa.png" alt=""> 
        CONSULTAR</button></a>
        <a href="configurar.php"><button style="background-color: #2DC071; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_ajustes.png" alt=""> 
            AJUSTES</button></a>
        <a href="editar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_editar.png" alt=""> 
            EDITAR</button></a>
    <a href="cerrar_session.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
           <img style="width: 90px; height: 70px; position: absolute; top:-17px; right: 150px;" src="../assets/icono_salida.png" alt=""> 
           SALIR</button></a>

    </div>

    
</html>