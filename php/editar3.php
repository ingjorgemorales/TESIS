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
     <link rel="stylesheet" href="../css/Style/editar3.css" />
    <title>X-RAY DIAGNOSTIC</title>
</head>

<body>

    <div style="width: 100%;  height: 14%; border-bottom: 2px solid white; position: absolute; top: -2px"  id="encabezado">
    
        <img style="height: 69px;"
        src="../public/external/logoaplib11031-8m9m-200h.png"
        alt="logoapliB11031"
        class="medicalassured-logoapli-b11"
      />


      <div style="width: 77px; height: 73px; position: relative; top: -70px; left: 170px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8); border-radius:44px;">
        <img style="width: 102%; height: auto; " src="../assets/1949154.png" alt="">
    </div>

       <div style="font-size: 16px; width: 292px; height: 40px; position: relative; top: -130px; left: 270px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8); background-color: white; border-radius: 2px;">
    <div style="position: absolute; top:10px; background-color: #2DC071; width: 20px ; height: 20px; border-radius: 20px; left: 250px;"></div>

   <span style="position: relative; top: 10px; left: 10px;"> DR. JORGE MORALES </span>
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

            <button style="position: absolute;  border: 0px; top:122px; left:30px; width: 70px;"> 
        <img style="width: 60%; height: auto;" src="../assets/BOTE_BASURA 2.PNG" alt="">
        </button>
            <button style="position: absolute;  border: 0px; top:175px; left:30px; width: 70px;"> 
        <img style="width: 60%; height: auto;" src="../assets/buscador 2.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:228px; left:30px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/expandir 2.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:279px; left:30px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/contraste_logo 2.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:334px; left:30px; width: 70px;"> 
            <img style="width: 60%; height: auto;" src="../assets/girar izquierda 2.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:390px; left:30px; width: 70px; height: 38px;"> 
            <img style="width: 50%; height: auto;" src="../assets/girar_derecha 2.png" alt="">
        </button>
        <button style="position: absolute;  border: 0px; top:443px; left:30px; width: 70px; height: 38px;"> 
            <img style="width: 50%; height: auto;" src="../assets/EDITAR 2.png" alt="">
        </button>

         <div class="contenedor" style="position: absolute; background-color: black; width: 100px; height: 100px; border-radius: 3px; left: 170px; top: 15%; width: 80%; height: 75%; overflow-y:scroll;">  
         <div style="color: white;">
         <div style="color: white; margin-top: 5px;">Numero de analisis: 
    <?php echo $row['id']; ?>
</div>
    <?php echo $row['nombres'] . " " . $row['apellidos']; ?>
</div>
<div style="color: white; margin-top: 5px;">ID:
    <?php echo $row['id_paciente']; ?>
</div>
<div style="color: white; margin-top: 5px;">Fecha: 
    <?php echo $row['fecha']; ?>
</div>
<div style="color: white; margin-top: 5px;">Edad: 
    <?php echo $row['edad']; ?>
</div>
<div style="color: white; margin-top: 5px;">Sexo: 
    <?php echo $row['sexo']; ?>
</div>


<div style="width: 500px; border: 2px solid white; position: absolute; left: 300px; top:-0px;  ">
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
<form method="POST" action="editar2.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" style="background-color: #2DC071; color: white; border: 0px; position: absolute; font-size: 18px; border-radius: 4px; padding: 10px; top: 480px; left: 180px; width:200px;">
        <img style="width: 45px; height: 40px; position: absolute; top:0px; left: 5px; " src="../assets/ojo_visualizador 1.png" alt=""> 
            
        &nbsp; &nbsp; &nbsp; &nbsp;    INFORME</button>
        </form>      



           

            <div style="display: flex; ">
       <a href="../examen.html"> <button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px;margin: 10px;  width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/examen 1.png" alt=""> 
        EXAMEN</button></a>
       <a href="consultar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="../assets/buscador 2 (1).png" alt=""> 
        CONSULTAR</button></a>
        <a href="../configurar.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/ajustes 1.png" alt=""> 
            AJUSTES</button></a>
        <a href="editar.php"><button style="background-color:  #2DC071;  border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="../assets/EDITAR 2.png" alt=""> 
            EDITAR</button></a>
            <a href="../index.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
           <img style="width: 90px; height: 70px; position: absolute; top:-17px; right: 150px;" src="../assets/logout-sign-out-icon-in-circle-button-vector-removebg-preview 1.png" alt=""> 
           SALIR</button></a>

    </div>
    </body>


    
</html>
