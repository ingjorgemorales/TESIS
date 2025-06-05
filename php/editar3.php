<?php
$ID_Radiografia = $_POST['id'];
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);
$result_radiografia = $objconsulta->Consultar_radiografia($ID_Radiografia);
$radiografia = mysqli_fetch_array($result_radiografia);
if (empty($radiografia)) {
    header("Location: editar.php?ms=Radiografía no encontrada&type=error");
    exit();
}

if(empty($resultado)){
    header("Location: ../login.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Editar Diagnóstico</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/editar3.css">

</head>
<body>
    <!-- Barra de navegación superior -->
    <header class="main-header">
        <div class="logo-container" style="max-width: 100px;">
            <a href="examen.php">
            <img src="../assets/img/logo_x_ray.png" alt="X-RAY DIAGNOSTIC" class="logo" style="max-width: 100%; height: auto;">
            </a>
        </div>
        
        <div class="user-info">
            <div class="user-avatar">
                <img src="../assets/img/icono_doctor.png" alt="Doctor">
            </div>
            <div class="user-name">
                <span>
                    <?php 
                    $nombre_empleado = '';
                    while ($row = mysqli_fetch_array($result)) {
                        $nombre_empleado = $row['Nombre'] . " " . $row['Apellido'];    
                    }
                    echo $nombre_empleado;
                    ?>
                </span>
                <div class="status-indicator"></div>
            </div>
        </div>
        
        <button class="hamburger-btn" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <!-- Menú lateral (aparece en móvil) -->
    <nav class="sidebar-nav">
        <ul>
            <li><a href="examen.php"><i class="fas fa-file-medical"></i> EXAMEN</a></li>
            <li><a href="consultar.php"><i class="fas fa-search"></i> CONSULTAR</a></li>
            <li><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li class="active"><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="section-header">
            <h1>Editar Diagnóstico</h1>
            <p>Detalles del diagnóstico seleccionado</p>
        </div>
        
        <div class="diagnostic-container">
            <!-- Sección de imagen y controles -->
            <div class="image-section">
                <h2>Imagen Radiológica</h2>
                <div class="image-container">
                <?php 
                if (!empty($radiografia['Archivo_radiografia'])) { 
                    echo '<img class="zoom-img" src="../assets/upload/' . $radiografia['Archivo_radiografia'] . '">';
                } else { 
                    echo '<div style="text-align: center; color: #6c757d;">
                            <i class="fas fa-image" style="font-size: 5rem; margin-bottom: 15px;"></i>
                            <p>No hay imagen disponible</p>
                        </div>'; 
                } 
                ?>

                </div>
                
                <div class="image-controls">
                    <button class="control-btn">
                        <i class="fas fa-trash-alt"></i>
                        <span>Eliminar</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-search-plus"></i>
                        <span>Zoom</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-expand-alt"></i>
                        <span>Expandir</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-adjust"></i>
                        <span>Contraste</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-undo-alt"></i>
                        <span>Girar Izq.</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-redo-alt"></i>
                        <span>Girar Der.</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-edit"></i>
                        <span>Anotar</span>
                    </button>
                    <button class="control-btn">
                        <i class="fas fa-download"></i>
                        <span>Descargar</span>
                    </button>
                </div>
            </div>
            
            <!-- Sección de información del paciente -->
            <div class="info-section">
                <h2>Información del Paciente</h2>
                
                <div class="patient-info">
                    <div class="info-item">
                        <span class="info-label">Número de análisis:</span>
                        <span class="info-value"><?php echo $radiografia['ID']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">ID del paciente:</span>
                        <span class="info-value"><?php echo $radiografia['Cedula paciente']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha:</span>
                        <span class="info-value"><?php echo $radiografia['Fecha y hora']; ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Edad:</span>
                        <span class="info-value">                                    <?php
                                    $fechaNacimiento = new DateTime($radiografia['Fecha_nacimiento']);
                                    $hoy = new DateTime();
                                    $edad = $hoy->diff($fechaNacimiento)->y;
                                    echo $edad;
                                    ?></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Sexo:</span>
                        <span class="info-value">                                    <?php 
                                    if($radiografia['Genero'] == 'M') {
                                        echo "Masculino";
                                    } elseif($radiografia['Genero'] == 'F') {
                                        echo "Femenino";
                                    } else {
                                        echo "Otro";
                                    }
                                    ?></span>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <form method="POST" action="editar2.php">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit" class="action-btn">
                            <i class="fas fa-file-medical-alt"></i>
                            Generar Informe
                        </button>
                    </form>
                    
                    <button class="action-btn" style="background: linear-gradient(to right, #6c757d, #5a6268);">
                        <i class="fas fa-print"></i>
                        Imprimir Diagnóstico
                    </button>
                    
                    <button class="action-btn" style="background: linear-gradient(to right, #ffc107, #e0a800);">
                        <i class="fas fa-sync-alt"></i>
                        Actualizar Datos
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Barra de navegación inferior (solo en desktop) -->
    <nav class="bottom-nav">
        <a href="examen.php" class="nav-item">
            <i class="fas fa-file-medical"></i>
            <span>EXAMEN</span>
        </a>
        <a href="consultar.php" class="nav-item">
            <i class="fas fa-search"></i>
            <span>CONSULTAR</span>
        </a>
        <a href="configurar.php" class="nav-item">
            <i class="fas fa-cog"></i>
            <span>AJUSTES</span>
        </a>
        <a href="editar.php" class="nav-item active">
            <i class="fas fa-edit"></i>
            <span>EDITAR</span>
        </a>
        <a href="cerrar_session.php" class="nav-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>SALIR</span>
        </a>
    </nav>
    
    <script src="../assets/js/editar3.js"></script>

</body>
</html>