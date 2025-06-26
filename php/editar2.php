<?php
$ID_Radiografia = $_POST['id'];
include_once("Cservicios.php");
$objconsulta = new cCliente;
$resultado = $objconsulta->Usuario_logueado();
$result = $objconsulta->Consultar_empleado($resultado);
$result_radiografia = $objconsulta->Consultar_radiografia($ID_Radiografia);
$radiografia = mysqli_fetch_array($result_radiografia);
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
        <nav class="top-nav" style="display: flex; gap: 10px;">
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
            <li><a href="diagnostico.php"><i class="fas fa-stethoscope"></i> DIAGNÓSTICO</a></li>
            <li><a href="registrar_patologia.php"><i class="fas fa-notes-medical"></i> PATOLOGÍAS</a></li>
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
                        // Ruta del archivo que quieres enviar (puede venir de $_FILES si usas un formulario)
                        $imagePath = '../assets/upload/' . $radiografia['Archivo_radiografia'];

                        // Verifica que exista
                        if (!file_exists($imagePath)) {
                            die("No se encontró la imagen en: " . $imagePath);
                        }

                        // Preparar cURL
                        $ch = curl_init();

                        curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5000/predict");
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                        $cfile = new CURLFile($imagePath, mime_content_type($imagePath), basename($imagePath));
                        $postData = ['file' => $cfile];

                        curl_setopt($ch, CURLOPT_POST, true);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

                        // Ejecutar
                        $response = curl_exec($ch);

                        // Manejar errores
                        if (curl_errno($ch)) {
                            echo 'Error en cURL: ' . curl_error($ch);
                            curl_close($ch);
                            exit;
                        }

                        curl_close($ch);

                        $responseData = json_decode($response, true);

                        if (isset($responseData['imagen'])) {

                            echo "<h4>Imagen con detecciones:</h4>";
                            echo '<img src="data:image/jpeg;base64,' . $responseData['imagen'] . '" style="max-width: 400px;">';

                            $modelo = $responseData['resultado_modelo'];
                        } else {
                            echo "<p>Respuesta inesperada del servidor:</p>";
                            echo "<pre>" . htmlspecialchars($response) . "</pre>";
                        }
                        ?>


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
                                    <li><?php
                                        if (isset($responseData['imagen'])) {
                                            $numHallazgos = count($responseData['diagnostico']);
                                            echo "<p><strong>Número de hallazgos:</strong> " . $numHallazgos . "</p>";

                                            foreach ($responseData['diagnostico'] as $diag) {
                                                echo "<p><strong>Clase:</strong> " . htmlspecialchars($diag['clase']) .
                                                    " | <strong>Confianza:</strong> " . htmlspecialchars($diag['confianza']) . "</p>";
                                            }
                                        }
                                        ?></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Porcentaje confianza:</td>
                            <td>
                                <ul>
                                    <li><?php
                                        if (isset($responseData['imagen'])) {
                                            foreach ($responseData['diagnostico'] as $diag) {
                                                echo "<p>" . htmlspecialchars($diag['confianza'] * 100) . "%</p>";
                                            }
                                        } ?></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>

                        </tr>
                        <tr>
                            <td>Resolucion:</td>
                            <td>
                                <ul>
                                    <li><?php if (isset($responseData['imagen'])) {
                                            echo "<p>" . htmlspecialchars($modelo['deteccion']['imagen']) . "</p>";
                                        }
                                        ?></li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Tiempo de inferencia: </td>
                            <td>
                                <ul>
                                    <li><?php if (isset($responseData['imagen'])) {
                                            echo "<p>" . htmlspecialchars($modelo['velocidades']['inferencia']) . "</p>";
                                        }
                                        ?></li>
                                </ul>
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
                                    <li>None</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Diagnóstico diferencial:</td>
                            <td>
                                <ul>
                                    <li>None</li>
                                    <li>None</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>Recomendaciones:</td>
                            <td>
                                <ul>
                                    <li>None</li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script src="../assets/js/editar2.js"></script>
</body>

</html>