// Función para cerrar el menú
function closeMenu() {
    document.querySelector('.sidebar-nav').classList.remove('active');
    document.querySelector('.hamburger-btn').classList.remove('active');
}

// Menú hamburguesa
document.querySelector('.hamburger-btn').addEventListener('click', function() {
    document.querySelector('.sidebar-nav').classList.toggle('active');
    this.classList.toggle('active');
});

// Cerrar menú al hacer clic en enlaces (móviles)
document.querySelectorAll('.sidebar-nav a').forEach(item => {
    item.addEventListener('click', closeMenu);
});

// Cerrar menú automáticamente al redimensionar
window.addEventListener('resize', function() {
    // Cierra el menú solo si está abierto y el ancho supera 900px
    const isMenuOpen = document.querySelector('.hamburger-btn').classList.contains('active');
    if (window.innerWidth > 900 && isMenuOpen) {
        closeMenu();
    }
});

// Verificar estado inicial al cargar
if (window.innerWidth > 900) {
    closeMenu();
}

// Efecto de carga para la tarjeta de vista previa
document.addEventListener('DOMContentLoaded', function () {
    const previewCard = document.querySelector('.preview-card');

    // Simular animación de carga

});


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

