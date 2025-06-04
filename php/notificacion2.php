<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="shortcut icon" href="./assets/img/logo_icono_x_ray.png" type="image/png">
    <style>
        .notification {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: fit-content;
            background-color: #23c483; 
            color: white;
            text-align: center;
            padding: 10px;
            z-index: 1000;
            animation: slideDown 0.5s ease-in-out forwards, fadeOut 0.5s 2s ease-in-out forwards; /* Aplica las animaciones de desplazamiento hacia abajo y desvanecimiento */
        }

        @keyframes slideDown {
            0% {
                top: -50px; /* Empieza arriba de la pantalla */
            }
            100% {
                top: 0; /* Termina en la parte superior de la pantalla */
            }
        }

        @keyframes fadeOut {
            0% {
                
            }
            100% {
                top: -100px;
                display: none; /* Se oculta al final de la animación */
            }
        }

        .close {
            float: right;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="notification" id="notification">
       Paciente CONSULTADOS exitosamente
        <span class="close" onclick="closeNotification()">&times;</span>
    </div>

    <script>
        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }
    </script>
</body>
</html>
