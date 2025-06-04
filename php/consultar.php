<?php
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);

if (empty($resultado)) {
    header("Location: ../login.html");
    exit();
}

// Obtener nombre del médico para mostrarlo una sola vez
$nombre_medico = "";
while ($row = mysqli_fetch_array($result)) {
    $nombre_medico = $row['Nombre'] . " " . $row['Apellido'];
}

// Obtener los resultados para la tabla (asegurando que se recorran solo una vez)
// $diagnosticos = [];
// $resultado_diagnosticos = $objconsulta->Consultar_diagnostico();
// while ($row = mysqli_fetch_array($resultado_diagnosticos)) {
//     $diagnosticos[] = $row;
// }
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>X-RAY DIAGNOSTIC | Consultas</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/consultar.css">
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
                <span><?php echo $nombre_medico; ?></span>
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
            <li class="active"><a href="consultar.php"><i class="fas fa-search"></i> CONSULTAR</a></li>
            <li><a href="configurar.php"><i class="fas fa-cog"></i> AJUSTES</a></li>
            <li><a href="editar.php"><i class="fas fa-edit"></i> EDITAR</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="section-header">
            <h1>Consultar Diagnósticos</h1>
            <p>Busque y visualice los diagnósticos existentes en el sistema</p>
        </div>

        <div class="diagnostic-container">
            <div class="preview-section">
                <div class="preview-card">
                    <div class="preview-icon">
                        <img src="../assets/img/icono_archivo_DICOM.png" alt="Preview Icon">
                    </div>
                    <p class="preview-text">Aquí se mostrará la imagen del diagnóstico al seleccionar un registro</p>
                    <div id="previewContainer">
                        <div class="preview-placeholder">
                            <i class="fas fa-image"></i>
                            <span>Seleccione un diagnóstico</span>
                        </div>
                        <img id="previewImage" src="" alt="Vista previa">
                    </div>
                </div>
            </div>

            <div class="table-section">
                <div class="search-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="query" class="search-input" placeholder="Buscar por ID, nombre o fecha...">
                </div>

                <div class="table-container">
                    <table class="responsive-table">
                        <thead>
                            <tr>
                                <th>ID Diagnóstico</th>
                                <th>ID Paciente</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Edad</th>
                                <th>Sexo</th>
                                <th>Observaciones</th>
                                <th>Archivo</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($diagnosticos as $row): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['id_paciente']; ?></td>
                                    <td><?php echo $row['nombres']; ?></td>
                                    <td><?php echo $row['apellidos']; ?></td>
                                    <td><?php echo $row['edad']; ?></td>
                                    <td><?php echo $row['sexo']; ?></td>
                                    <td><?php echo $row['observaciones']; ?></td>
                                    <td>
                                        <?php if (empty($row['radiografia'])): ?>
                                            <span class="no-file">N/A</span>
                                        <?php else: ?>
                                            <i class="fas fa-file-medical file-icon"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo $row['fecha']; ?></td>
                                    <td>
                                        <form method="POST" action="editar3.php">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" class="action-btn">
                                                <i class="fas fa-play"></i> Analizar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
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
        <a href="consultar.php" class="nav-item active">
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
</body>
<script src="../assets/js/consultar.js"></script>

</html>