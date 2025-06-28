 // Obtener elementos del DOM
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const sidebarNav = document.querySelector('.sidebar-nav');

        // Función para cerrar el menú
        function closeMenu() {
            sidebarNav.classList.remove('active');
            hamburgerBtn.classList.remove('active');
        }
        // Menú hamburguesa
        document.querySelector('.hamburger-btn').addEventListener('click', function() {
            document.querySelector('.sidebar-nav').classList.toggle('active');
            this.classList.toggle('active');
        });

        // Cerrar menú al hacer clic en un enlace (para móviles)
        document.querySelectorAll('.sidebar-nav a').forEach(item => {
            item.addEventListener('click', () => {
                document.querySelector('.sidebar-nav').classList.remove('active');
                document.querySelector('.hamburger-btn').classList.remove('active');
            });
        });

        // Cerrar el menú cuando la pantalla se hace más grande
        window.addEventListener('resize', function() {
            if (window.innerWidth > 900) {
                closeMenu();
            }
        });

        // Verificar estado inicial
        if (window.innerWidth > 900) {
            closeMenu();
        }
                    
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
