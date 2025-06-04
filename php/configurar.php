<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);

if (empty($resultado)) {
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
    <title>X-RAY DIAGNOSTIC - Configuración</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/configurar.css">

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
            <li class="active"><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="section-header">
            <h1>Configuración</h1>
            <p>Panel de control para ajustar las preferencias del sistema</p>
        </div>

        <div class="configuration-container">
            <!-- Preferencias de usuario -->
            <div class="config-section">
                <div class="section-title">PREFERENCIAS DE USUARIO</div>
                <button class="config-option">Idioma</button>
                <button class="config-option">Tema de la interfaz</button>
                <button class="config-option">Unidades de medida</button>
                <button class="config-option">Notificaciones</button>
            </div>

            <!-- Preferencias de imagen -->
            <div class="config-section">
                <div class="section-title">PREFERENCIAS DE IMAGEN</div>
                <button class="config-option">Calibración de escala</button>
                <button class="config-option">Ajustes de visualización</button>
                <button class="config-option">Formato de imágenes</button>
            </div>

            <!-- Seguridad y privacidad -->
            <div class="config-section">
                <div class="section-title">SEGURIDAD Y PRIVACIDAD</div>
                <button class="config-option">Contraseña y autenticación</button>
                <button class="config-option">Permisos de usuario</button>
                <button class="config-option">Cumplimiento normativo</button>
            </div>

            <!-- Configuración de análisis -->
            <div class="config-section">
                <div class="section-title">CONFIGURACIÓN DE ANÁLISIS</div>
                <button class="config-option">Precisión de la IA</button>
                <button class="config-option">Hallazgos automáticos</button>
                <button class="config-option">Diagnósticos diferenciales</button>
                <button class="config-option">Exportación de informes</button>
            </div>

            <!-- Integraciones y conectividad -->
            <div class="config-section">
                <div class="section-title">INTEGRACIONES Y CONECTIVIDAD</div>
                <button class="config-option">Conexión con PACS</button>
                <button class="config-option">Sincronización en la nube</button>
                <button class="config-option">Dispositivos externos</button>
            </div>

            <!-- Actualización y soporte -->
            <div class="config-section">
                <div class="section-title">ACTUALIZACIÓN Y SOPORTE</div>
                <button class="config-option">Actualizaciones de software</button>
                <button class="config-option">Registro de errores</button>
                <button class="config-option">Soporte técnico</button>
            </div>

        </div>

        <!-- Botones de acción -->
        <div class="action-buttons">
            <button class="save-btn">
                <i class="fas fa-save"></i> Guardar
            </button>
            <button class="reset-btn">
                <i class="fas fa-undo"></i> Restablecer valores de fábrica
            </button>
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
        <a href="configurar.php" class="nav-item active">
            <i class="fas fa-cog"></i>
            <span>AJUSTES</span>
        </a>
        <a href="editar.php" class="nav-item">
            <i class="fas fa-edit"></i>
            <span>EDITAR</span>
        </a>
        <a href="cerrar_session.php" class="nav-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>SALIR</span>
        </a>
    </nav>
    <script src="../assets/js/configurar.js"></script>
</body>

</html>