<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);

if(empty($resultado)){
    header("Location: ../login.html");
    exit();
}

// Obtener nombre del empleado para mostrarlo
$nombre_empleado = '';
while ($row = mysqli_fetch_array($result)) {
    $nombre_empleado = $row['Nombre'] . " " . $row['Apellido'];    
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Editar Diagnóstico</title>
    <link rel="shortcut icon" href="./assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/editar2.css">
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
                <span><?php echo $nombre_empleado; ?></span>
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
            <p>Modifique la información del diagnóstico según sea necesario</p>
        </div>
        
        <div class="diagnostic-container">
            <!-- Sección de imagen original y controles -->
            <div class="form-section">
                <h2>Imagen Original</h2>
                
                <div class="action-buttons">
                    <button class="action-btn">
                        <i class="fas fa-brain"></i> Análisis IA
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-diagnoses"></i> Diagnóstico IA
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-print"></i> Imprimir
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </button>
                </div>
                
                <div class="image-container">
                    <div style="width: 100%; border: 1px solid #e0e0e0; border-radius: 12px; overflow: hidden;">
                        <?php 
                        if (!empty($row['radiografia'])) { 
                            $imagenBase64 = base64_encode($row['radiografia']);
                            $mime = 'image/jpeg';
                            echo '<img class="original-image zoom-img" 
                                   src="data:' . $mime . ';base64,' . $imagenBase64 . '">';
                        } else { 
                            echo '<div style="text-align: center; padding: 40px; background: #f0f0f0; color: #777;">
                                    <i class="fas fa-image" style="font-size: 3rem; margin-bottom: 15px;"></i>
                                    <p>No hay imagen disponible</p>
                                  </div>'; 
                        } 
                        ?>
                    </div>
                    
                    <div class="image-controls">
                        <button class="control-btn" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                        <button class="control-btn" title="Zoom">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button class="control-btn" title="Expandir">
                            <i class="fas fa-expand"></i>
                        </button>
                        <button class="control-btn" title="Contraste">
                            <i class="fas fa-adjust"></i>
                        </button>
                        <button class="control-btn" title="Rotar">
                            <i class="fas fa-undo"></i>
                        </button>
                        <button class="control-btn" title="Guardar">
                            <i class="fas fa-save"></i>
                        </button>
                        <button class="control-btn" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Sección de hallazgos y diagnóstico -->
            <div class="form-section">
                <h2>Información del Diagnóstico</h2>
                
                <div class="table-container">
                    <h3><i class="fas fa-clipboard-list"></i> Hallazgos</h3>
                    <table class="diagnostic-table">
                        <tr>
                            <td>Hallazgos:</td>
                            <td>
                                <ul>
                                    <li>Anomalía zona C107</li>
                                    <li>Aumento de volumen en tejidos blandos adyacentes</li>
                                    <li>Sin evidencia de neumotórax o hemotórax</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Porcentaje confianza:</td>
                            <td>
                                <ul>
                                    <li>86%</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Áreas marcadas:</td>
                            <td>
                                <ul>
                                    <li>(255,0,0) - (255,0,0) - (255,0,0) - (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)- (255,0,0)</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Tipo de estudio:</td>
                            <td>
                                <ul>
                                    <li>Proyección posteroanterior y lateral</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="table-container">
                    <h3><i class="fas fa-stethoscope"></i> Diagnóstico</h3>
                    <table class="diagnostic-table">
                        <tr>
                            <td>Diagnóstico principal:</td>
                            <td>
                                <ul>
                                    <li>Fractura no desplazada en la zona C107 del lado derecho.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnóstico diferencial:</td>
                            <td>
                                <ul>
                                    <li>Fractura desplazada (baja probabilidad, basado en la imagen).</li>
                                    <li>Contusión costal sin fractura (descartada por la evidencia radiológica).</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Recomendaciones:</td>
                            <td>
                                <ul>
                                    <li>Reposo y evitar actividades que puedan agravar la lesión (como levantar peso o realizar movimientos bruscos).</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
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
    <script src="../assets/js/editar2.js"></script>
</body>
</html>