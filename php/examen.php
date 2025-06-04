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
$empleado = mysqli_fetch_array($result); // Almacenar el resultado en una variable
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC - Examen Médico</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/examen.css">
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
                <span><?php echo htmlspecialchars($empleado['Nombre'] . " " . $empleado['Apellido']); ?></span>
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
            <li class="active"><a href="examen.php"><i class="fas fa-file-medical"></i> EXAMEN</a></li>
            <li><a href="consultar.php"><i class="fas fa-search"></i> CONSULTAR</a></li>
            <li><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="section-header">
            <h1>Registro de Examen Médico</h1>
            <p>Complete la información del paciente y suba la imagen para diagnóstico</p>
        </div>

        <form action="recibe_datos.php" method="post" class="patient-form" enctype="multipart/form-data">
            <h2 class="form-title">Información del Paciente</h2>

            <div class="form-grid">
                <div class="form-group">
                    <label for="id">Identificación</label>
                    <input id="id" name="id" type="number" required>
                </div>

                <div class="form-group">
                    <label for="nombres">Nombres</label>
                    <input id="nombres" name="nombres" type="text" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos</label>
                    <input id="apellidos" name="apellidos" type="text" required>
                </div>

                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input id="edad" name="edad" type="number" required>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo" required>
                        <option value="Hombre">Hombre</option>
                        <option value="Mujer">Mujer</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="form-group full-width">
                    <label for="observaciones">Observaciones</label>
                    <textarea id="observaciones" name="observaciones" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="categoria">Categoría</label>
                    <select id="categoria" name="categoria">
                        <option value="rayos-x">Rayos X</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="zona">Zona</label>
                    <select id="zona" name="zona">
                        <option value="no">No especificado</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="estudio">Estudio</label>
                    <select id="estudio" name="estudio">
                        <option value="Analitico">Analítico</option>
                    </select>
                </div>
            </div>

            <div class="image-upload-section">
                <div class="image-preview" id="imagePreview">
                    <img src="../assets/img/icono_archivo_DICOM.png" alt="Icono DICOM" class="dicom-icon">
                    <img id="previewImage" src="" alt="Vista previa" class="preview-image">
                </div>

                <div class="upload-controls">
                    <label for="fileUpload" class="file-upload-btn">
                        <i class="fas fa-cloud-upload-alt"></i> Seleccionar archivo
                    </label>
                    <input name="radiografia" type="file" id="fileUpload" accept="image/png, image/jpeg, image/jpg, image/gif">
                    <span id="fileName" class="file-name"></span>
                    <button type="button" id="removeImageBtn" class="remove-image-btn" style="display: none;">
                        <i class="fas fa-trash-alt"></i> Eliminar imagen
                    </button>
                </div>

                <a href="../editar.php" class="analyze-btn">
                    <i class="fas fa-brain"></i> ANALIZAR IMAGEN
                </a>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">
                    <i class="fas fa-save"></i> GUARDAR
                </button>
            </div>
        </form>
    </main>

    <!-- Barra de navegación inferior (solo en desktop) -->
    <nav class="bottom-nav">
        <a href="examen.php" class="nav-item active">
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
        <a href="cerrar_session.php" class="nav-item">
            <i class="fas fa-sign-out-alt"></i>
            <span>SALIR</span>
        </a>
    </nav>
    <script src="../assets/js/examen.js"></script>
</body>

</html>