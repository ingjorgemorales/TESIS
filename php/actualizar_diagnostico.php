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

// Obtener todos los diagnósticos (simulados para este ejemplo)
$diagnosticos = [
    [
        'id_diagnostico' => 'DX-20230627143015',
        'fecha_hora' => '2023-06-27T14:30',
        'id_radiografia' => 2,
        'id_patologia' => 3,
        'descripcion' => 'Fractura completa del radio con desplazamiento de aproximadamente 5 mm. Evidente fragmentación ósea en el tercio distal. Ligera angulación de 15 grados. Se observa afectación de la articulación radiocubital distal.',
        'nivel_gravedad' => 'grave',
        'tipo_fractura' => 'Fractura conminuta',
        'porcentajeconfianza_IA' => 92,
        'paciente_nombre' => 'María García - RX Pierna',
        'patologia_nombre' => 'Fractura de Monteggia'
    ],
    [
        'id_diagnostico' => 'DX-20230715113045',
        'fecha_hora' => '2023-07-15T11:30',
        'id_radiografia' => 1,
        'id_patologia' => 1,
        'descripcion' => 'Fractura transversal no desplazada en la epífisis distal del radio. Ligera línea de fractura visible sin desplazamiento significativo. Sin compromiso articular aparente.',
        'nivel_gravedad' => 'leve',
        'tipo_fractura' => 'Fractura transversal',
        'porcentajeconfianza_IA' => 88,
        'paciente_nombre' => 'Juan Pérez - RX Brazo',
        'patologia_nombre' => 'Fractura de Colles'
    ],
    [
        'id_diagnostico' => 'DX-20230805164522',
        'fecha_hora' => '2023-08-05T16:45',
        'id_radiografia' => 3,
        'id_patologia' => 5,
        'descripcion' => 'Fractura intraarticular conminuta del primer metacarpiano derecho. Significativa fragmentación ósea con depresión articular. Evidente desplazamiento de fragmentos.',
        'nivel_gravedad' => 'muy_grave',
        'tipo_fractura' => 'Fractura conminuta intraarticular',
        'porcentajeconfianza_IA' => 95,
        'paciente_nombre' => 'Carlos López - RX Tórax',
        'patologia_nombre' => 'Fractura de Bennett'
    ],
    [
        'id_diagnostico' => 'DX-20230820111033',
        'fecha_hora' => '2023-08-20T11:10',
        'id_radiografia' => 4,
        'id_patologia' => 4,
        'descripcion' => 'Fractura diafisaria del cúbito con luxación de la cabeza radial. Obvia deformidad en el antebrazo derecho. Signos de inestabilidad radiocubital distal.',
        'nivel_gravedad' => 'grave',
        'tipo_fractura' => 'Fractura-luxación',
        'porcentajeconfianza_IA' => 90,
        'paciente_nombre' => 'Ana Rodríguez - RX Antebrazo',
        'patologia_nombre' => 'Fractura de Galeazzi'
    ],
    [
        'id_diagnostico' => 'DX-20230901092018',
        'fecha_hora' => '2023-09-01T09:20',
        'id_radiografia' => 5,
        'id_patologia' => 2,
        'descripcion' => 'Fractura del tercio distal del radio con desplazamiento palmar. Ligera angulación de 10 grados. Sin compromiso articular significativo.',
        'nivel_gravedad' => 'moderado',
        'tipo_fractura' => 'Fractura desplazada',
        'porcentajeconfianza_IA' => 85,
        'paciente_nombre' => 'Luis Martínez - RX Muñeca',
        'patologia_nombre' => 'Fractura de Smith'
    ]
];

// Obtener datos para los select (simulado)
$radiografias = [
    ['id' => 1, 'paciente' => 'Juan Pérez - RX Brazo'],
    ['id' => 2, 'paciente' => 'María García - RX Pierna'],
    ['id' => 3, 'paciente' => 'Carlos López - RX Tórax'],
    ['id' => 4, 'paciente' => 'Ana Rodríguez - RX Antebrazo'],
    ['id' => 5, 'paciente' => 'Luis Martínez - RX Muñeca']
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
    <title>X-RAY DIAGNOSTIC - Listado de Diagnósticos</title>
    <link rel="shortcut icon" href="../assets/img/logo_icono_x_ray.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/Style/actualizar_diagnostico.css">
    <style>
        /* Estilos adicionales para la tabla y el filtro */
        .diagnosticos-container {
            background-color: var(--card-bg);
            border-radius: 20px;
            padding: 30px;
            box-shadow: var(--shadow);
            transition: var(--transition);
            max-width: 1200px;
            margin: 0 auto;
        }

        .diagnosticos-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }

        .search-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary);
            font-size: 18px;
        }

        .search-input {
            width: 100%;
            padding: 12px 20px 12px 45px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .search-input:focus {
            border-color: var(--primary);
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 2px rgba(71, 79, 160, 0.2);
        }

        .new-btn {
            background: var(--accent);
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: background 0.3s;
            box-shadow: 0 4px 15px rgba(45, 192, 113, 0.3);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .new-btn:hover {
            background: var(--accent-dark);
            transform: translateY(-2px);
        }

        .diagnosis-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .diagnosis-table th {
            background-color: var(--primary);
            color: white;
            text-align: left;
            padding: 15px;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        .diagnosis-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .diagnosis-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .diagnosis-table tr:hover {
            background-color: #f0f8ff;
        }

        .action-cell {
            display: flex;
            gap: 10px;
        }

        .action-btn {
            padding: 10px 15px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            border: none;
            min-width: 100px;
        }

        .edit-btn {
            background-color: #4a6cf7;
            color: white;
        }

        .delete-btn {
            background-color: #ff4d4f;
            color: white;
        }

        .action-btn i {
            margin-right: 8px;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .edit-btn:hover {
            background-color: #3a57e0;
        }

        .delete-btn:hover {
            background-color: #e04345;
        }

        .description-cell {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .severity-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .severity-leve {
            background-color: #d9f7be;
            color: #389e0d;
        }

        .severity-moderado {
            background-color: #fff1b8;
            color: #d48806;
        }

        .severity-grave {
            background-color: #ffccc7;
            color: #cf1322;
        }

        .severity-muy_grave {
            background-color: #ff7875;
            color: #a8071a;
        }

        .confidence-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .confidence-bar {
            flex: 1;
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            overflow: hidden;
        }

        .confidence-fill {
            height: 100%;
            border-radius: 5px;
            transition: width 0.5s ease;
        }

        .confidence-value {
            font-weight: 600;
            min-width: 40px;
            text-align: right;
        }

        .no-results {
            text-align: center;
            padding: 30px;
            color: var(--text-light);
            font-style: italic;
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 25px;
            gap: 8px;
        }

        .page-btn {
            padding: 8px 15px;
            background: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .page-btn.active {
            background: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .page-btn:hover:not(.active) {
            background: #f0f0f0;
        }

        .table-container {
            max-height: 600px;
            overflow-y: auto;
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid #eee;
            
        }

        @media (max-width: 900px) {
            .diagnosis-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 768px) {
            .action-cell {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-btn {
                width: 100%;
            }
        }
    </style>
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
            <h1>Listado de Diagnósticos</h1>
            <p>Gestión completa de los diagnósticos realizados en el sistema</p>
        </div>

        <div class="diagnosticos-container">
            <div class="search-container">
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Buscar diagnóstico...">
                </div>
                <button class="new-btn" onclick="window.location.href='examen.php';">
                    <i class="fas fa-plus"></i> Nuevo Diagnóstico
                </button>
            </div>

            <div class="table-container">
                <table class="diagnosis-table" id="diagnosisTable">
                    <thead>
                        <tr>
                            <th>ID Diagnóstico</th>
                            <th>Descripción</th>
                            <th>Nivel Gravedad</th>
                            <th>Confianza IA</th>
                            <th>Tipo Fractura</th>
                            <th>Fecha y Hora</th>
                            <th>Radiografía</th>
                            <th>Patología</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($diagnosticos as $diag): ?>
                        <tr>
                            <td><?php echo $diag['id_diagnostico']; ?></td>
                            <td class="description-cell"><?php echo $diag['descripcion']; ?></td>
                            <td>
                                <?php 
                                    $severityClass = 'severity-' . $diag['nivel_gravedad'];
                                    $severityText = '';
                                    switch ($diag['nivel_gravedad']) {
                                        case 'leve':
                                            $severityText = 'LEVE';
                                            break;
                                        case 'moderado':
                                            $severityText = 'MODERADO';
                                            break;
                                        case 'grave':
                                            $severityText = 'GRAVE';
                                            break;
                                        case 'muy_grave':
                                            $severityText = 'MUY GRAVE';
                                            break;
                                    }
                                    echo '<span class="severity-badge ' . $severityClass . '">' . $severityText . '</span>';
                                ?>
                            </td>
                            <td class="confidence-cell">
                                <div class="confidence-bar">
                                    <div class="confidence-fill" 
                                        style="width: <?php echo $diag['porcentajeconfianza_IA']; ?>%;
                                                background: <?php 
                                                    $conf = $diag['porcentajeconfianza_IA'];
                                                    if ($conf < 50) echo '#ff6b6b';
                                                    elseif ($conf < 80) echo '#ffd166';
                                                    else echo '#06d6a0';
                                                ?>;">
                                    </div>
                                </div>
                                <div class="confidence-value"><?php echo $diag['porcentajeconfianza_IA']; ?>%</div>
                            </td>
                            <td><?php echo $diag['tipo_fractura']; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($diag['fecha_hora'])); ?></td>
                            <td><?php echo $diag['paciente_nombre']; ?></td>
                            <td><?php echo $diag['patologia_nombre']; ?></td>
                            <td class="action-cell">
                                <button class="action-btn edit-btn" onclick="editDiagnostic('<?php echo $diag['id_diagnostico']; ?>')">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button class="action-btn delete-btn" onclick="confirmDelete('<?php echo $diag['id_diagnostico']; ?>')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="no-results" id="noResults" style="display: none;">
                No se encontraron diagnósticos que coincidan con su búsqueda
            </div>
            
            <div class="pagination" id="pagination">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
            </div>
        </div>
    </main>
    
    <div class="notification" id="notification" style="display: none;">
        <div class="notification-content">
            <i class="fas fa-check-circle"></i>
            <span id="notificationMessage">Operación realizada con éxito</span>
        </div>
    </div>
    <script src="../assets/js/actualizar_diagnostico.js"></script>

</body>
</html>