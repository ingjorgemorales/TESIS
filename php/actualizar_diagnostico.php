<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();

// Verificar si el usuario está logueado
if (empty($resultado)) {
    header("Location: ../login.html");
    exit();
}

// Obtener datos del empleado
$result = $objconsulta->Consultar_empleado($resultado);
$empleado = mysqli_fetch_assoc($result);

// Datos simulados del diagnóstico existente
$diagnostico = [
    'id' => 'DX-20230627143015',
    'fecha_hora' => '2023-06-27T14:30',
    'id_radiografia' => 2,
    'id_patologia' => 3,
    'descripcion' => 'Fractura completa del radio con desplazamiento de aproximadamente 5 mm. Evidente fragmentación ósea en el tercio distal. Ligera angulación de 15 grados. Se observa afectación de la articulación radiocubital distal.',
    'nivel_gravedad' => 'grave',
    'tipo_fractura' => 'Fractura conminuta',
    'confianza' => 92
];

// Obtener datos para los select (simulado)
$radiografias = [
    ['id' => 1, 'paciente' => 'Juan Pérez - RX Brazo'],
    ['id' => 2, 'paciente' => 'María García - RX Pierna'],
    ['id' => 3, 'paciente' => 'Carlos López - RX Tórax']
];

$patologias = [
    ['id' => 1, 'nombre' => 'Fractura de Colles'],
    ['id' => 2, 'nombre' => 'Fractura de Smith'],
    ['id' => 3, 'nombre' => 'Fractura de Monteggia'],
    ['id' => 4, 'nombre' => 'Fractura de Galeazzi'],
    ['id' => 5, 'nombre' => 'Fractura de Bennett']
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Actualizar Diagnóstico</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/actualizar_diagnostico.css">
</head>

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
            <a href="diagnostico.php" class="nav-item active">
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
                <img src="../assets/img/icono_doctor.png" alt="Doctor">
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
            <li class="active"><a href="diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li><a href="registrar_patologia.php"><i class="fas fa-notes-medical"></i> PATOLOGÍAS</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="section-header">
            <h1>Actualizar Diagnóstico</h1>
            <p>Modifique la información del diagnóstico médico según los nuevos hallazgos o correcciones necesarias</p>
        </div>

        <div class="diagnosis-form-container">
            <form id="updateDiagnosisForm">
                <h2 class="form-section-title">
                    <i class="fas fa-info-circle"></i> Información del Diagnóstico
                </h2>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_diagnostico"><i class="fas fa-id-card"></i> ID Diagnóstico</label>
                        <input type="text" id="id_diagnostico" class="form-input readonly" value="<?php echo $diagnostico['id']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="fecha_hora"><i class="fas fa-calendar-alt"></i> Fecha y Hora de Actualización</label>
                        <input type="datetime-local" id="fecha_hora" class="form-input" value="<?php echo date('Y-m-d\TH:i'); ?>">
                    </div>
                </div>

                <h2 class="form-section-title">
                    <i class="fas fa-stethoscope"></i> Datos del Diagnóstico
                </h2>

                <div class="form-row">
                    <div class="form-group">
                        <label for="id_radiografia"><i class="fas fa-x-ray"></i> Radiografía Asociada</label>
                        <select id="id_radiografia" class="form-select" required>
                            <?php foreach ($radiografias as $radiografia): ?>
                                <option value="<?php echo $radiografia['id']; ?>" 
                                    <?php if($radiografia['id'] == $diagnostico['id_radiografia']) echo 'selected'; ?>>
                                    <?php echo $radiografia['paciente']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_patologia"><i class="fas fa-disease"></i> Patología</label>
                        <select id="id_patologia" class="form-select" required>
                            <?php foreach ($patologias as $patologia): ?>
                                <option value="<?php echo $patologia['id']; ?>" 
                                    <?php if($patologia['id'] == $diagnostico['id_patologia']) echo 'selected'; ?>>
                                    <?php echo $patologia['nombre']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="descripcion"><i class="fas fa-file-medical"></i> Descripción</label>
                    <textarea id="descripcion" class="form-textarea" required><?php echo $diagnostico['descripcion']; ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="nivel_gravedad"><i class="fas fa-exclamation-triangle"></i> Nivel de Gravedad</label>
                        <select id="nivel_gravedad" class="form-select" required>
                            <option value="leve" <?php if($diagnostico['nivel_gravedad'] == 'leve') echo 'selected'; ?>>Leve</option>
                            <option value="moderado" <?php if($diagnostico['nivel_gravedad'] == 'moderado') echo 'selected'; ?>>Moderado</option>
                            <option value="grave" <?php if($diagnostico['nivel_gravedad'] == 'grave') echo 'selected'; ?>>Grave</option>
                            <option value="muy_grave" <?php if($diagnostico['nivel_gravedad'] == 'muy_grave') echo 'selected'; ?>>Muy Grave</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="tipo_fractura"><i class="fas fa-bone"></i> Tipo de Fractura (IA)</label>
                        <input type="text" id="tipo_fractura" class="form-input" value="<?php echo $diagnostico['tipo_fractura']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="porcentaje_confianza"><i class="fas fa-brain"></i> Confianza de la IA</label>
                    <div class="confidence-container">
                        <div class="confidence-bar">
                            <div class="confidence-fill" id="confidenceFill" style="width: <?php echo $diagnostico['confianza']; ?>%"></div>
                        </div>
                        <div class="confidence-value" id="confidenceValue"><?php echo $diagnostico['confianza']; ?>%</div>
                    </div>
                    <input type="range" id="porcentaje_confianza" class="form-input" min="0" max="100" value="<?php echo $diagnostico['confianza']; ?>" step="1" style="width: 100%; margin-top: 10px;">
                </div>

                <div class="action-buttons">
                    <button type="button" class="cancel-btn" id="cancelBtn" onclick="window.location.href='diagnostico.php';">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="update-btn">
                        <i class="fas fa-sync-alt"></i> Actualizar Diagnóstico
                    </button>
                </div>
            </form>
        </div>
    </main>
    <script src="../assets/js/actualizar_diagnostico.js"></script>

</body>

</html>