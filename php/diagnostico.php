<?php
date_default_timezone_set('America/Mexico_City'); // Ajusta la zona horaria según tu ubicación
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();

$id =  $_POST['id'] ?? null;
$hallazgos = $_POST['hallazgos'] ?? null;
$promedio_confianza = $_POST['promedio_confianza'] ?? null;
$result_radiografia = $objconsulta->Consultar_radiografia($id);
$result_patologia = $objconsulta->Mostrar_todo_patologia();
$patologias = mysqli_fetch_array($result_patologia);
$radiografia = mysqli_fetch_array($result_radiografia);
// Verificar si el usuario está logueado
if (empty($resultado)) {
    header("Location: ../login.html");
    exit();
}

// Obtener datos del empleado
$result = $objconsulta->Consultar_empleado($resultado);
$empleado = mysqli_fetch_assoc($result);



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Ingresar Diagnóstico</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/diagnostico.css">
</head>
<style>

</style>
<body>
    <header class="main-header">
        <div class="logo-container">
            <a href="examen.php">
                <img src="../assets/img/logo_x_ray.png" alt="X-RAY DIAGNOSTIC" class="logo">
            </a>
        </div>
        <nav class="top-nav">
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
            <a href="editar.php" class="nav-item">
                <i class="fas fa-edit"></i>
                <span>EDITAR</span>
            </a>
            <a href="actualizar_diagnostico.php" class="nav-item active">
                <i class="fas fa-stethoscope"></i>
                <span>DIAGNÓSTICO</span>
            </a>
            <a href="registrar_patologia.php" class="nav-item">
                <i class="fas fa-notes-medical"></i>
                <span>PATOLOGÍAS</span>
            </a>
            <a href="cerrar_session.php" class="nav-item">
                <i class="fas fa-sign-out-alt"></i>
                <span>SALIR</span>
            </a>
        </nav>

        <div class="user-info">
            <div class="user-avatar">
                 <a href="configurar.php">
                           <?php if (empty($empleado['Foto'])): ?>
                <img src="../assets/img/icono_doctor.png" alt="Doctor">
            <?php else: ?>
                <img src="../assets/upload/<?php echo htmlspecialchars($empleado['Foto']); ?>" alt="Foto de perfil">
            <?php endif; ?>
            </a>
            </div>
            <div class="user-name">
                <span><?php echo $empleado['Nombre'] . " " . $empleado['Apellido']; ?></span>
                <div class="status-indicator"></div>
            </div>
        </div>

        <button class="hamburger-btn" aria-label="Menú">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    <nav class="sidebar-nav">
        <ul>
            <li><a href="examen.php"><i class="fas fa-file-medical"></i> EXAMEN</a></li>
            <li><a href="consultar.php"><i class="fas fa-search"></i> CONSULTAR</a></li>
            <li><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li class="active"><a href="actualizar_diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li><a href="registrar_patologia.php"><i class="fas fa-notes-medical"></i> PATOLOGÍAS</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="section-header">
            <h1>Registro de Diagnóstico</h1>
            <p>Complete la información del diagnóstico médico basado en los resultados de la radiografía</p>
        </div>

        <div class="diagnosis-form-container">
            <form id="diagnosisForm" action="registrar_diagnostico.php" method="POST">
                <h2 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Información Básica
                </h2>

                <div class="form-row">
   

                    <div class="form-group">
                        <label for="fecha_hora"><i class="fas fa-calendar-alt"></i> Fecha y Hora</label>
                        <input type="datetime-local" id="fecha_hora" name= "fecha_hora" class="form-input" value="<?php echo date('Y-m-d\TH:i', time() + 3600); ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_radiografia"><i class="fas fa-x-ray"></i> Radiografía Asociada</label>
                        <input type="text" id="id_radiografia"  class="form-input" value="<?php echo 'Nombre: ' . ($radiografia['Nombre completo'] ?? '') . ' - Zona: ' . ($radiografia['Zona'] ?? ''); ?>" required disabled/>
                        <input type="hidden" name="id_r" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'UTF-8'); ?>" />
                    </div>
                    <div class="form-group">
                        <label for="id_patologia"><i class="fas fa-disease"></i> Patología</label>
                         <input id="nombre" name="id_patologia" class="form-input" list="pacieenteList" required>
                    <datalist id="pacieenteList">
                        <?php while ($patologias = mysqli_fetch_assoc($result_patologia)) : ?>
                            <option value="<?php echo htmlspecialchars($patologias['Id_patologia'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($patologias['Nombre_patologia'], ENT_QUOTES, 'UTF-8'); ?>
                            </option>
                        <?php endwhile; ?>

                    </datalist>
                    </div>
                </div>

                <h2 class="form-section-title">
                    <i class="fas fa-stethoscope"></i> Detalles del Diagnóstico
                </h2>

                <div class="form-group full-width">
                    <label for="descripcion"><i class="fas fa-file-medical"></i> Descripción</label>
                    <textarea id="descripcion" class="form-textarea" name = "descripcion" placeholder="Describa en detalle el diagnóstico..." required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nivel_gravedad"><i class="fas fa-exclamation-triangle"></i> Nivel de Gravedad</label>
                        <select id="nivel_gravedad" name= "nivel_gravedad" class="form-select" required>
                            <option value="">Seleccione nivel</option>
                            <option value="leve">Leve</option>
                            <option value="moderado">Moderado</option>
                            <option value="grave" selected>Grave</option>
                            <option value="muy_grave">Muy Grave</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_fractura"><i class="fas fa-bone"></i> Tipo de Fractura (IA)</label>
                        <input type="text" id="tipo_fractura" name="tipo_de_fractura" class="form-input" value="<?php echo $hallazgos ?>" readonly />
                        <input type="hidden" name="tipo_de_fractura" value="<?php echo htmlspecialchars($hallazgos, ENT_QUOTES, 'UTF-8'); ?>" />
                       
                    </div>
                </div>

                <div class="form-group">
                    <label for="porcentaje_confianza"><i class="fas fa-brain"></i> Confianza de la IA</label>
                    <div class="confidence-container">
                        <div class="confidence-bar">
                            <div class="confidence-fill" id="confidenceFill" style="width: <?php echo $promedio_confianza ?>%"></div>
                        </div>
                        <div class="confidence-value" id="confidenceValue"><?php echo $promedio_confianza ?>%</div>
                    </div>
                     <input type="hidden" name="porcentaje" value="<?php echo htmlspecialchars($promedio_confianza, ENT_QUOTES, 'UTF-8'); ?>" />
                 <!--   <input type="range" id="porcentaje_confianza" class="form-input" min="0" max="100" value="<?php echo $promedio_confianza ?>" step="1" style="width: 100%; margin-top: 10px;"> -->
                </div>

                <!-- Botones de acción -->
                <div class="form-buttons">
                    <button type="submit" class="save-btn">
                        <i class="fas fa-save"></i> Guardar Diagnóstico
                    </button>
                    <button type="button" class="update-btn" id="updateDiagnosticBtn">
                        <i class="fas fa-sync-alt"></i> Actualizar Diagnóstico
                    </button>
                </div>
            </form>
        </div>
            <div class="notification" id="notification" style="display: none;">
        <span id="notification-message"></span>
        <span class="close" onclick="closeNotification()">&times;</span>
    </div>
    </main>
    <script src="../assets/js/diagnostico.js"></script>


</body>

</html>