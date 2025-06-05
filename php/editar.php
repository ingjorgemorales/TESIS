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
    <link rel="stylesheet" href="../assets/css/Style/editar.css">
    

</head>
<style>
      .notification {
    display:none;
    position: fixed;
    top: -50px; /* Inicialmente fuera de la pantalla */
    left: 50%;
    transform: translateX(-50%);
    width: fit-content;
    background-color: rgb(196, 35, 35);
    color: white;
    text-align: center;
    padding: 10px;
    z-index: 1000;
    animation: slideDown 0.5s ease-in-out forwards, fadeOut 0.5s 2s ease-in-out forwards;
}

@keyframes slideDown {
    0% {
        top: -50px; 
    }
    100% {
        top: 0; 
    }
}

@keyframes fadeOut {
    0% {
        opacity: 1;
    }
    100% {
        opacity: 0;
        top: -100px;
        display: none; 
    }
}

.close {
    float: right;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
}

</style>
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
            <p>Ingrese el ID del paciente para acceder y modificar los diagnósticos existentes</p>
        </div>
        
        <div class="diagnostic-container">
            <div class="form-section">
                <h2>Ingrese el ID del Diagnóstico</h2>
                <form action="editar3.php" method="POST">
                    <div class="input-group">
                        <input type="text" name="id" placeholder="Cédula del paciente" required>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Buscar Diagnóstico
                        </button>
                    </div>
                </form>
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
    
</body>
<div class="notification" id="notification" style="display: none;">
    <span id="notification-message"></span>
    <span class="close" onclick="closeNotification()">&times;</span>
</div>

<script>
    const params = new URLSearchParams(window.location.search);
const message = params.get('ms');
const type = params.get('type');

if (message && type) {
    const notification = document.getElementById('notification');
    const messageSpan = document.getElementById('notification-message');

    // Set message
    messageSpan.textContent = message;

    // Set background color
    if (type === 'ok') {
        notification.style.backgroundColor = '#23c483'; // verde
    } else if (type === 'error') {
        notification.style.backgroundColor = '#e74c3c'; // rojo
    }

    // Mostrar
    notification.style.display = 'block';

    // Ocultar automáticamente luego de 4 segundos
    setTimeout(() => {
        notification.style.display = 'none';
    }, 4000);
}

function closeNotification() {
    document.getElementById('notification').style.display = 'none';
}
</script>
</html>