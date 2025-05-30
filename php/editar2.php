<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id'])) {
        $id_paciente = $_POST['id'];
       // echo "El ID del paciente recibido es: " . htmlspecialchars($id_paciente);
        // Aquí puedes hacer más procesos con la base de datos o redirigir a otra página
    } else {
        echo "No se recibió ningún ID de paciente.";
    }
} else {
    echo "Acceso no permitido.";
}

//echo $id_paciente;
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado= $objconsulta->consultar_diagnosticos($id_paciente);
//include_once('notificacion2.php');

$row = mysqli_fetch_array($resultado)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/Style/editar2.css" />
    <title>X-RAY DIAGNOSTIC</title>
</head>
<style>


    </style>
<body>

    <div style="width: 100%;  height: 14%; border-bottom: 2px; position: absolute; top: -2px"  id="encabezado">
    
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

<div style="color:#474FA0; background-color: #D9D9D9; width: 120px; font-size: 18px; padding: 10px; border-radius: 10px; position: absolute; top:100px; left: 5px;">
<img style="width: 30px; height: 25px; position: absolute; top:7px; left: 5px; " src="../assets/icono_cerebro.png" alt=""> 
&nbsp; &nbsp;  &nbsp; Analisis IA
</div>






<div style="color:#474FA0; background-color: #D9D9D9; width: 180px; font-size: 18px; padding: 10px; border-radius: 10px; position: absolute; top:100px; left: 430px;">
<img style="width: 30px; height: 25px; position: absolute; top:7px; left: 5px; " src="../assets/icono_diagnostico.png" alt=""> 
&nbsp; &nbsp;  &nbsp; DIAGNOSTICO IA
</div>





<button style="color:#474FA0; background-color: #D9D9D9; width: 140px; font-size: 16px; padding: 5px; border-radius: 5px; position: absolute; top:100px; left: 850px; border: 0px;">
<img style="width: 25px; height: 20px; position: absolute; top:4px; left: 13px; " src="../assets/icono_imprimir.png" alt=""> 

    &nbsp; &nbsp;  &nbsp;Imprimir</button>

    <button style="color:#474FA0; background-color: #D9D9D9; width: 140px; font-size: 16px; padding: 5px; border-radius: 5px; position: absolute; top:100px; left: 1000px; border: 0px;">
<img style="width: 25px; height: 20px; position: absolute; top:4px; left: 13px; " src="../assets/guardar 1.png" alt=""> 

    &nbsp; &nbsp;  &nbsp; Guardar</button>

    <button style="color:#474FA0; background-color: #D9D9D9; width: 140px; font-size: 16px; padding: 5px; border-radius: 5px; position: absolute; top:100px; left: 1150px; border: 0px;">
<img style="width: 25px; height: 20px; position: absolute; top:4px; left: 13px; " src="../assets/icono_regresar.png" alt=""> 

    &nbsp; &nbsp;  &nbsp; Regresar</button>


        </div>
        <div style="width: 99%; height: 400px;  border: 2px; position: absolute; top: 100px" >
    <div style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6); position: relative; width:443px ; height:248px; background-color: white;  top:-433px; left:790px; z-index: -1;">
        <img style="width: 25%; height: auto; position: relative; top: 20%; left: 38%;" src="../assets/pluginIcon 4.png" alt="">
        <div id="previewContainer" style="width: 100%; height: auto; position: absolute; left: 25%; top: 0px;">
            <img id="previewImage" src="" alt="Vista previa" style=" width: 100%; height: auto; display: none; max-width: 245px; max-height: 400px; border: 0px solid #ddd; padding: 1px;">
        </div>
    </div>
            </div>

            <button style="position: absolute;  border: 0px; top:152px; left:1250px; width: 70px;"> 
        <img style="width: 60%; height: auto;" src="../assets/icono_basura.png" alt="">
        </button>
            <button style="position: absolute;  border: 0px; top:205px; left:1250px; width: 70px;"> 
        <img style="width: 60%; height: auto;" src="../assets/icono_lupa_blanco.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:258px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_expandir.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:309px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_contraste.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:364px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_girar_izquierda.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:420px; left:1250px; width: 70px; height: 38px;"> 
            <img style="width: 50%; height: auto;" src="../assets/icono_guardar.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:473px; left:1250px; width: 70px; height: 38px;"> 
            <img style="width: 50%; height: auto;" src="../assets/icono_editar.png" alt="">
        </button>

         <div class="contenedor" style="position: absolute; background-color: black; width: 100px; height: 100px; border-radius: 3px; left: 850px; top: 24%; width: 28%; height: 62%; overflow-y:scroll;">  


<div style="width: 350px; border: 2px solid white; position: absolute; left: 10px; top:-0px;  ">
    <?php 
    if (!empty($row['radiografia'])) { 
        // Asegurarse de que la imagen no tenga espacios extra
        $imagenBase64 = base64_encode($row['radiografia']);
        $mime = 'image/jpeg'; // Cambia si necesitas otro formato como image/png

        echo '<img class="zoom-img" style="width: 100%; height: 100%; object-fit: cover;    cursor:pointer;" 
               src="data:' . $mime . ';base64,' . $imagenBase64 . '">';
    } else { 
        echo '<p>No hay imagen disponible.</p>'; 
    } 
    ?>
</div>






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




    <div class="contenedor" style="color:#474FA0; background-color: #D9D9D9; width: 380px; font-size: 18px; padding: 10px; border-radius: 2px; position: absolute; top:150px; left: 5px; height:350px; overflow-y: scroll; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);">
        <table style="width: 100%; height: 300px; border-collapse: collapse;" border="1">
            <tr>
                <td style="font-weight:bold;">Hallazgos:</td>
                <td>
                    <ul>
                        <li>Anomalía zona C107</li>
                        <li>Aumento de volumen x tejidos blandos adyacentes</li>
                        <li>Sin evidencia de neumotórax o hemotórax</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Porcentaje confianza:</td>
                <td>
                    <ul>
                        <li>86%</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Áreas marcadas:</td>
                <td>
                    <ul>
                        <li>(255,0,0) - (255,0,0) - (255,0,0) - (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0) </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Tipo de estudio:</td>
                <td>   <ul>
                        <li>proyeccion posteroanterior y lateral</li>
                    </ul></td>
            </tr>
        </table>
</div>
<div class= "contenedor" style="color:#474FA0; background-color: #D9D9D9; width: 380px; font-size: 18px; padding: 10px; border-radius: 2px; position: absolute; top:150px; left: 430px; height:350px; overflow-y: scroll; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8);">
<table style="width: 90%; height: 300px; border-collapse: collapse;" border="1">
            <tr>
                <td style="font-weight:bold;">Diagnostico principal:</td>
                <td>
                    <ul>
                        <li>Fractura no desplazada en la zona C107 del lado derecho.</li>
    
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Diagnostico diferencial:</td>
                <td>
                    <ul>
                        <li>Fractura desplazada (baja probabilidad,basado en la imagen).</li>
                        <li> Contusión costal sin fractura (descartada por la evidencia radiológica).</li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td style="font-weight:bold;">Recomendaciones:</td>
                <td>
                    <ul>
                        <li>Reposo y evitar actividades que puedan agravar la lesión 
                            (como levantar peso o realizar movimientos bruscos). </li>
                    </ul>
                </td>
            </tr>
        
        </table>
</div>
    </body>

    
</html>
