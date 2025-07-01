<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);

if (empty($resultado)) {
    header("Location: ../login.html");
    exit();
}

// Obtener datos del empleado
$empleado = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Mi Perfil</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/configurar.css">
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
            <a href="configurar.php" class="nav-item active">
                <i class="fas fa-cog"></i>
                <span>AJUSTES</span>
            </a>
            <a href="editar.php" class="nav-item">
                <i class="fas fa-edit"></i>
                <span>EDITAR</span>
            </a>
            <a href="diagnostico.php" class="nav-item">
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
            <?php if (empty($empleado['Foto'])): ?>
                <img src="../assets/img/icono_doctor.png" alt="Doctor">
            <?php else: ?>
                <img src="../assets/upload/<?php echo htmlspecialchars($empleado['Foto']); ?>" alt="Foto de perfil">
            <?php endif; ?>
            <div class="status-indicator"></div>
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
            <li class="active"><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li><a href="diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li><a href="registrar_patologia.php"><i class="fas fa-notes-medical"></i> PATOLOGÍAS</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="section-header">
            <h1>Configuración de Perfil</h1>
            <p>Actualiza tu información personal y tu foto de perfil</p>
        </div>

        <div class="profile-container">
            <!-- Tarjeta de perfil -->
            <div class="profile-card">
                <div class="profile-picture">
                               <?php if (empty($empleado['Foto'])): ?>
                <img src="../assets/img/icono_doctor.png" alt="Doctor">
            <?php else: ?>
                <img src="../assets/upload/<?php echo htmlspecialchars($empleado['Foto']); ?>" alt="Foto de perfil">
            <?php endif; ?>
                    <button class="change-photo-btn">
                        <i class="fas fa-camera"></i>
                    </button>
                </div>
                <h2 class="profile-name"><?php echo $empleado['Nombre'] . " " . $empleado['Apellido']; ?></h2>
                <p class="profile-role"><?php echo $empleado['Especialidad']; ?></p>

                <div class="profile-stats">
                    <div class="stat-item">
                        <div class="stat-value">24</div>
                        <div class="stat-label">Pacientes</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">98%</div>
                        <div class="stat-label">Precisión</div>
                    </div>
                </div>
            </div>

            <!-- Formulario de perfil -->
            <div class="profile-form">
                <h3 class="form-section-title">Información Personal</h3>

                <form id="profileForm" action="actualizar_empleado.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-half">
                            <div class="form-group">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" id="cedula" class="form-input readonly" value="<?php echo $empleado['Cedula']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-half">
                            <div class="form-group">
                                <label for="especialidad" class="form-label">Especialidad</label>
                                <input type="text" id="especialidad" name= "especialidad" class="form-input readonly" value="<?php echo $empleado['Especialidad']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-half">
                            <div class="form-group">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" id="nombres" name= "nombre" class="form-input" value="<?php echo $empleado['Nombre']; ?>">
                            </div>
                        </div>
                        <div class="form-half">
                            <div class="form-group">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" id="apellidos" name= "apellido" class="form-input" value="<?php echo $empleado['Apellido']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-half">
                            <div class="form-group">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name= "email" class="form-input" value="<?php echo $empleado['Email']; ?>">
                            </div>
                        </div>
                        <div class="form-half">
                            <div class="form-group">
                                <label for="celular" class="form-label">Celular</label>
                                <input type="tel" id="celular" name = "celular" class="form-input" value="<?php echo $empleado['Celular']; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" id="direccion" name= "direccion" class="form-input" value="<?php echo $empleado['Direccion']; ?>">
                    </div>

                    <h3 class="form-section-title" style="margin-top: 30px;">Cambiar Foto de Perfil</h3>
                    <input type="hidden" name="pass" value="<?php echo $empleado['Password']; ?>">
                    <input type="hidden" name="validarFoto" value="<?php echo $empleado['Foto']; ?>">

                    <div class="form-group">
                        <label for="fotoPerfil" class="form-label">Seleccionar nueva foto</label>
                        <input type="file" id= "fotoPerfil"  name="fotoPerfil" class="form-input"  accept="image/png, image/jpeg, image/jpg, image/gif">
                    </div>

                    <button type="submit" class="save-btn">
                        <i class="fas fa-save"></i> GUARDAR CAMBIOS
                    </button>
                </form>
            </div>
                        <div class="notification" id="notification" style="display: none;">
        <span id="notification-message"></span>
        <span class="close" onclick="closeNotification()">&times;</span>
        </div>
    </main>

    <script src="../assets/js/configurar.js"></script>
</body>

</html>