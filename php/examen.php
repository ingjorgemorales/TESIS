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
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../css/Style/examen.css" />
     
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
   <span style="position: relative; top: 10px; left: 10px;"> <?php while ($row = mysqli_fetch_array($result)){
    echo $row['Nombre'] . " " . $row['Apellido'];    
}
    ?> </span>
    <div style="position: absolute; top:10px; background-color: #2DC071; width: 20px ; height: 20px; border-radius: 20px; left: 250px;"></div>
    </div>
    <a href="./editar.php">
    <button style="background-color:#2DC071; color: white; border: 0px; width: 230px; height:55px; font-size: 16px; border-radius:20px; position: relative; top:-170px; left: 900px; 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); " type="submit">
            <img style="width: 40px; height: 35px; position: absolute; top:10px; right: 181px;" src="../assets/icono_cerebro.png" alt=""> 
            &nbsp; &nbsp; &nbsp; &nbsp;   ANALIZAR  IMAGEN</button>
</a>



        </div>
        <div style="width: 99%; height: 400px;  border: 2px; position: absolute; top: 100px" >
            <form action="recibe_datos.php" method="post" >
            </br>
            <span style="color: white; font-size:18px; position: relative; left: 70px;">IDENTIFICACION</span>
            <input style="position: relative; left: 140px; width: 272px; height: 18px;  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px;" name="id" type="number"></br></br>
            <span style="color: white; font-size:18px;  position: relative; left: 70px;">NOMBRES      </span>
            <input style="position: relative; left: 193px; width: 272px; height: 18px;  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px;"  name="nombres" type="text"></br></br> 
            <span style="color: white; font-size:18px;  position: relative; left: 70px;">APELLIDOS    </span>
            <input  style="position: relative; left: 185px; width: 272px; height: 18px;  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px;" name="apellidos" type="text"></br></br>  
            <span style="color: white; font-size:18px;  position: relative; left: 70px; ">EDAD         </span>
            <input  style="position: relative; left: 235px; width: 272px; height: 18px;  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px;" name="edad" type="number"></br></br>  
            <span style="color: white; font-size:18px;  position: relative; left: 70px;">SEXO         </span>
            
            <select style="position: relative; left: 235px; width: 272px; height: 18px;  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px;" name="sexo" type="text">
                <option  name="sexo" value="Hombre">Hombre</option>
                <option  name="sexo"value="Mujer">Mujer</option>
                <option  name="sexo" value="39 tipos de gay">39 tipos de gay</option>
            </select></br></br>     
            
            <span style="color: white; font-size:18px;  position: relative; left: 70px;">OBSERVACIONES</span>
            <input name="observaciones" style="position: relative; left: 131px; width: 272px; height: 50px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.5); border: 0px; " type="text"></br></br>

            <label for="fileUpload" style="position: relative; left: 940px; top: -110px; cursor: pointer; background: #8AC0FF; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block;">
                Seleccionar archivo
            </label>
            <input name="radiografia" type="file" id="fileUpload" accept="image/png, image/jpeg, image/jpg, image/gif" style="display: none;">
            <span id="fileName" style="    position: relative;  left: 806px; top: -70px;color: #152140;"></span>


            <span style="width: 140px; position: absolute; left:790px; top:295px; color:white;font-size: 18px;">Categoria</span><br>
            <select name="categoria" style="width: 140px; position: relative; left:790px;"  id="">
                <option value="rayos-x">Rayos X</option>

            </select>
            <span style="width: 140px; position: relative; left:805px; color:white;font-size: 18px; top:-29px">Zona</span><br>
            <select name="zona" style="width: 140px; position: relative; left: 950px; top: -38px;"  id="">
                <option name="zona" value="no">no</option>
            </select>


            <button style="background-color:#2DC071; color: white; border: 0px; width: 175px; height:55px; font-size: 18px; border-radius:20px; left: -40px; position: relative; top: -50px;" type="submit">
        <img style="width: 35px; height: 30px; position: absolute; top:10px; right: 123px;" src="../assets/icono_guardar.png" alt=""> 
                
        &nbsp;   &nbsp; &nbsp; &nbsp;  GUARDAR</button>
        </form>
        <a href="./index.html">
        <button style="background-color:#2DC071; color: white; border: 0px; width: 185px; height:55px; font-size: 18px; border-radius:20px; left: 80px; position: relative; top:-105px; left: 350px;" type="submit">
        <img style="width: 35px; height: 30px; position: absolute; top:10px; right: 134px;" src="../assets/icono_regresar.png" alt=""> 
            
        &nbsp; &nbsp; &nbsp; &nbsp;   REGRESAR</button>
    </a>
    <div style=" box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.6); position: relative; width:443px ; height:248px; background-color: white;  top:-433px; left:790px; z-index: -1;">
        <img style="width: 25%; height: auto; position: relative; top: 20%; left: 38%;" src="../assets/icono_archivo_DICOM.png" alt="">
        <div id="previewContainer" style="width: 100%; height: auto; position: absolute; left: 25%; top: 0px;">
            <img id="previewImage" src="" alt="Vista previa" style=" width: 100%; height: auto; display: none; max-width: 245px; max-height: 400px; border: 0px solid #ddd; padding: 1px;">
        </div>
    </div>
            </div>


        

       <a href="./consultar.php"><button style="position: absolute;  border: 0px; top:122px; left:1250px; width: 70px;"> 
        <img style="width: 60%; height: auto;" src="../assets/icono_lupa_blanco.png" alt="">
        </button></a>
       <a href="./editar.php"><button style="position: absolute;  border: 0px; top:175px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_expandir.png" alt="">
        </button></a>
        <button style="position: absolute;  border: 0px; top:228px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_contraste.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:279px; left:1250px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/icono_girar_izquierda.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:332px; left:1250px; width: 70px; height: 38px;"> 
            <img style="width: 50%; height: auto;" src="../assets/icono_girar_derecha.png" alt="">
        </button>

<div style="display: flex; ">
       <a href="examen.php"> <button style="background-color: #2DC071; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px;margin: 10px;  width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_examen.png" alt=""> 
        EXAMEN</button></a>
       <a href="consultar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/icono_lupa.png" alt=""> 
        CONSULTAR</button></a>
       <a href="configurar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_ajustes.png" alt=""> 
            AJUSTES</button></a>
        <a href="editar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/icono_editar.png" alt=""> 
            EDITAR</button></a>
            <a href="cerrar_session.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
           <img style="width: 90px; height: 70px; position: absolute; top:-17px; right: 150px;" src="../assets/icono_salida.png" alt=""> 
           SALIR</button></a>

    </div>


    <span style="width: 140px; position: absolute; left:1110px; color:white;font-size: 18px; top:398px">Estudio</span><br>
    <select name="zona" style="width: 140px; position: absolute; left: 1110px; top: 425px;"  id="">
        <option name="zona" value="no">Analitico</option>
    </select>
<script src="JavaScript/examen.js"></script>

    </body>


    
</html>