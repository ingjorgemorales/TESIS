<?php
session_start();

// Procesar eliminación
if (isset($_GET['eliminar'])) {
    $id_eliminar = $_GET['eliminar'];
    foreach ($_SESSION['patologias'] as $key => $patologia) {
        if ($patologia['id'] == $id_eliminar) {
            unset($_SESSION['patologias'][$key]);
            break;
        }
    }
    // Reindexar el array
    $_SESSION['patologias'] = array_values($_SESSION['patologias']);
    $mensaje = "Patología eliminada exitosamente!";
}

// Simular datos de usuario
$empleado = [
    'Nombre' => 'Carlos',
    'Apellido' => 'Mendoza'
];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Patologías | X-RAY DIAGNOSTIC</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/mostrar_patologias.css">
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
            <a href="diagnostico.php" class="nav-item">
                <i class="fas fa-stethoscope"></i>
                <span>DIAGNÓSTICO</span>
            </a>
            <a href="mostrar_patologias.php" class="nav-item active">
                <i class="fas fa-disease"></i>
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
            <li><a href="diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li class="active"><a href="mostrar_patologias.php"><i class="fas fa-disease"></i> PATOLOGÍAS</a></li>
            <li><a href="cerrar_session.php"><i class="fas fa-sign-out-alt"></i> SALIR</a></li>
        </ul>
    </nav>

    <main class="main-content">
        <div class="section-header">
            <h1>Patologías Registradas</h1>
            <p>Lista de todas las patologías registradas en el sistema</p>
        </div>

        <div class="diagnosis-form-container">
            <h2 class="form-section-title">
                <i class="fas fa-list"></i> Listado de Patologías
            </h2>
            
            <?php if(isset($_SESSION['patologias']) && count($_SESSION['patologias']) > 0): ?>
            <table class="patologias-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['patologias'] as $patologia): ?>
                    <tr>
                        <td><?php echo $patologia['id']; ?></td>
                        <td><?php echo htmlspecialchars($patologia['nombre']); ?></td>
                        <td><?php echo htmlspecialchars($patologia['tipo']); ?></td>
                        <td><?php echo htmlspecialchars($patologia['descripcion']); ?></td>
                        <td class="action-cell">
                            <button class="delete-btn" onclick="if(confirm('¿Está seguro de eliminar esta patología?')) { window.location.href='mostrar_patologias.php?eliminar=<?php echo $patologia['id']; ?>'; }">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php else: ?>
            <div class="no-patologias">
                <i class="fas fa-info-circle" style="font-size: 3rem; margin-bottom: 15px; color: #ccc;"></i>
                <h3>No hay patologías registradas</h3>
                <p>Comienza registrando tu primera patología</p>
            </div>
            <?php endif; ?>
            
            <div class="form-buttons">
                <a href="registrar_patologia.php" class="save-btn">
                    <i class="fas fa-plus"></i> Registrar Nueva Patología
                </a>
            </div>
        </div>
    </main>

    <?php if(isset($mensaje)): ?>
    <div class="notification success" id="notification">
        <i class="fas fa-check-circle"></i>
        <div><?php echo $mensaje; ?></div>
    </div>
    <?php endif; ?>
    <script src="../assets/js/mostrar_patologias.js"></script>
</body>
</html>