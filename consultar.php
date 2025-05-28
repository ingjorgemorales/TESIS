<?php 
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado= $objconsulta->consultar_todo_diagnosticos();
//include_once('notificacion2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC</title>
</head>
<style>
body {
    height: 100vh;
    background: linear-gradient(to bottom right, #474FA0, #1A1D3A);
    margin: 0;
    font-family: 'Inter', sans-serif;
}

table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            background-color: white;
            border: 2px solid #474FA0;

        }
        th {
            background-color: #474FA0;
            color:white;
        }




        .contenedor {
}


.contenedor::-webkit-scrollbar {
    width: 8px; 
}


.contenedor::-webkit-scrollbar-track {
    background: white;
    border-radius: 10px; 
}


.contenedor::-webkit-scrollbar-thumb {
    background: #474FA0 ;
    border-radius: 10px; 
}


.contenedor::-webkit-scrollbar-thumb:hover {
    background: #474FA0 ;
}



/* From Uiverse.io by LightAndy1 */ 
.group {
  display: flex;
  line-height: 28px;
  align-items: center;
  position: relative;
  max-width: 190px;
  top: -169px;
  left: 788px;
}

.input {
  font-family: "Montserrat", sans-serif;
  width: 100%;
  height: 45px;
  padding-left: 2.5rem;
  box-shadow: 0 0 0 1.5px #2b2c37, 0 0 25px -17px #000;
  border: 0;
  border-radius: 12px;
  background-color:rgb(204, 211, 255);
  outline: none;
  color:rgb(0, 0, 0);
  transition: all 0.25s cubic-bezier(0.19, 1, 0.22, 1);
  cursor: text;
  z-index: 0;
}

.input::placeholder {
  color: #bdbecb;
}

.input:hover {
  box-shadow: 0 0 0 2.5px #2f303d, 0px 0px 25px -15px #000;
}

.input:active {
  transform: scale(0.95);
}

.input:focus {
  box-shadow: 0 0 0 2.5px #2f303d;
}

.search-icon {
  position: absolute;
  left: 1rem;
  fill:rgb(0, 17, 255);
  width: 1rem;
  height: 1rem;
  pointer-events: none;
  z-index: 1;
}

    </style>
<body>

    <div style="width: 100%;  height: 14%; border-bottom: 2px solid white; position: absolute; top: -2px"  id="encabezado">
    
        <img style="height: 69px;"
        src="public/external/logoaplib11031-8m9m-200h.png"
        alt="logoapliB11031"
        class="medicalassured-logoapli-b11"
      />


      <div style="width: 77px; height: 73px; position: relative; top: -70px; left: 170px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.8); border-radius:44px;">
        <img style="width: 102%; height: auto; " src="./assets/1949154.png" alt="">
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



        <div class="contenedor" style="position:absolute; top:110px; overflow-y:scroll; left:80px; width:90%; max-height: 70%;">
            <table>
    <tr>
        <th>ID DEL DIAGNOSTICO</th>
        <th>IDENTIFICACION</th>
        <th>NOMBRES</th>
        <th>APELLIDOS</th>
        <th>EDAD</th>
        <th>SEXO</th>
        <th>OBSERVACIONES</th>
        <th>ARCHIVO</th>
        <th>FECHA</th>
        <th>Empezar</th>




    </tr>
    <?php while ($row = mysqli_fetch_array($resultado)) { ?>
<tr>
<td><?php echo $row['id']; ?></td>
    <td><?php echo $row['id_paciente']; ?></td>
    <td><?php echo $row['nombres']; ?></td>
    <td><?php echo $row['apellidos']; ?></td>
    <td><?php echo $row['edad']; ?></td>
    <td><?php echo $row['sexo']; ?></td>
    <td><?php echo $row['observaciones']; ?></td>
    <td>
        <?php 
            if (empty($row['radiografia'])) {
                echo "NULL"; // Muestra el mensaje si no hay radiografía
            } else {
                echo '<img style="width:30px; height:30px;" src="./assets/pluginIcon 4.png" alt="Radiografía">';
            }
        ?>
    </td>
    <td><?php echo $row['fecha']; ?></td>
    <td>
        <form method="POST" action="editar3.php">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button type="submit" style="border: 0px; padding: 7px; border-radius: 5px; background-color:#2DC071;">Comenzar análisis</button>
        </form>
    </td>
</tr>
<?php } ?>

            </table>

            </div>


           

            <div style="display: flex; ">
       <a href="examen.html"> <button style="background-color:  #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px;margin: 10px;  width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="./assets/examen 1.png" alt=""> 
        EXAMEN</button></a>
       <a href="consultar.php"><button style="background-color: #2DC071; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
        <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 196px;" src="./assets/buscador 2 (1).png" alt=""> 
        CONSULTAR</button></a>
        <a href="configurar.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="./assets/ajustes 1.png" alt=""> 
            AJUSTES</button></a>
        <a href="editar.php"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
            <img style="width: 45px; height: 40px; position: absolute; top:4px; right: 184px;" src="./assets/EDITAR 2.png" alt=""> 
            EDITAR</button></a>
    <a href="index.html"><button style="background-color: #474FA0; border: 0px; color:white; font-size:20px; top:530px; position: relative; padding: 12px; left:10px; margin: 10px; width: 250px;">
           <img style="width: 90px; height: 70px; position: absolute; top:-17px; right: 150px;" src="./assets/logout-sign-out-icon-in-circle-button-vector-removebg-preview 1.png" alt=""> 
           SALIR</button></a>

    </div><script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("query").addEventListener("input", function() {
        let filtro = this.value.trim().toLowerCase(); // Obtiene el valor del input
        let filas = document.querySelectorAll("table tr"); // Obtiene todas las filas de la tabla

        filas.forEach((fila, index) => {
            if (index === 0) return; // Salta la cabecera de la tabla

            let idPaciente = fila.cells[1].textContent.trim().toLowerCase(); // Obtiene el ID del paciente
            if (idPaciente.includes(filtro)) {
                fila.style.display = ""; // Muestra la fila si coincide
            } else {
                fila.style.display = "none"; // Oculta la fila si no coincide
            }
        });
    });
});
</script>

    </body>
<script>
    document.getElementById('fileUpload').addEventListener('change', function() {
        let file = this.files[0];
        if (file) {
            document.getElementById('fileName').textContent = file.name;
        } else {
            document.getElementById('fileName').textContent = "No se seleccionó ninguna imagen";
        }
    });



    document.getElementById('fileUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const fileNameSpan = document.getElementById('fileName');
    const previewImage = document.getElementById('previewImage');

    if (file) {
        fileNameSpan.textContent = file.name;

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        fileNameSpan.textContent = '';
        previewImage.style.display = 'none';
    }
});


</script>

    
</html>