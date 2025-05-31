        // Verificar si hay un parámetro "error" en la URL
        const params = new URLSearchParams(window.location.search);
        if (params.has('error')) {
            // Mostrar la notificación de error
            document.getElementById('notification').style.display = 'block';
        }

        // Función para cerrar la notificación
        function closeNotification() {
            document.getElementById('notification').style.display = 'none';
        }