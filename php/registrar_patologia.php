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
$result_categoria = $objconsulta->Mostrar_todo_categoria();
$result_zona = $objconsulta->Mostrar_todo_zona();


$empleado = mysqli_fetch_array($result); 

$result_paciente = $objconsulta->Consultar_todo_paciente();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Patologías | X-RAY DIAGNOSTIC</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/registrar_patologia.css">
</head>

<body>
    
    <header class="main-header">
        <div class="logo-container">
            <a href="examen.php">
                <img src="../assets/img/logo_x_ray.png" alt="X-RAY DIAGNOSTIC" class="logo">
            </a>
        </div>
                    <div class="notification" id="notification" style="display: none;">
                <span id="notification-message"></span>
                <span class="close" onclick="closeNotification()">&times;</span>
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
            <a href="actualizar_diagnostico.php" class="nav-item">
                <i class="fas fa-stethoscope"></i>
                <span>DIAGNÓSTICO</span>
            </a>
            <a href="registrar_patologia.php" class="nav-item active">
                <i class="fas fa-disease"></i>
                <span>PATOLOGÍAS</span>
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
            <li><a href="actualizar_diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li class="active"><a href="registrar_patologia.php"><i class="fas fa-disease"></i> PATOLOGÍAS</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="section-header">
            <h1>Registro de Patologías</h1>
            <p>Complete el formulario para registrar una nueva patología médica</p>
        </div>

        <div class="diagnosis-form-container">
            <form method="POST" action="registrar_patologia2.php">
                <h2 class="form-section-title">
                    <i class="fas fa-plus-circle"></i> Información de la Patología
                </h2>

                <div class="form-group">
                    <label for="nombre_patologia"><i class="fas fa-disease"></i> Nombre de la Patología</label>
                    <input type="text" id="nombre_patologia" name="nombre_patologia" class="form-input" required placeholder="Ej: Fractura de Colles">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="tipo_patologia"><i class="fas fa-tag"></i> Tipo de Patología</label>
                        <select id="tipo_patologia" name="tipo_patologia" class="form-select" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Fractura">Fractura</option>
                            <option value="Infección">Infección</option>
                            <option value="Tumor">Tumor</option>
                            <option value="Degenerativa">Degenerativa</option>
                            <option value="Congénita">Congénita</option>
                            <option value="Traumática">Traumática</option>
                        </select>
                    </div>
                    
  
                </div>
                
                <div class="form-group">
                    <label for="descripcion_patologia"><i class="fas fa-file-medical"></i> Descripción</label>
                    <textarea id="descripcion_patologia" name="descripcion_patologia" class="form-textarea" required placeholder="Describa la patología en detalle..."></textarea>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" name="guardar" class="save-btn">
                        <i class="fas fa-save"></i> Guardar Patología
                    </button>
                    
                    <a href="mostrar_patologias.php" class="update-btn">
                        <i class="fas fa-list"></i> Mostrar Patologías
                    </a>
                </div>
            </form>

        </div>

    </main>

    <?php if(isset($mensaje)): ?>
    <div class="notification success" id="notification">
        <i class="fas fa-check-circle"></i>
        <div><?php echo $mensaje; ?></div>
    </div>
    <?php endif; ?>
    <script src="../assets/js/registrar_patologia.js"></script>
</body>
</html>