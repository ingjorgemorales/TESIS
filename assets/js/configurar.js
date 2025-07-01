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
// Efectos de hover en las opciones de configuración
document.querySelectorAll('.config-option').forEach(option => {
    option.addEventListener('mouseenter', () => {
        option.style.transform = 'translateX(5px)';
    });

    option.addEventListener('mouseleave', () => {
        option.style.transform = 'translateX(0)';
    });
});

// Simular vista previa
setTimeout(() => {
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');

    previewImage.src = '../assets/imagen_radiologo.png';
    previewImage.style.display = 'block';
    previewContainer.style.background = 'transparent';
}, 2000);
// Simulación de cambio de foto
        document.querySelector('.change-photo-btn').addEventListener('click', function() {
            document.getElementById('fotoPerfil').click();
        });

        document.getElementById('fotoPerfil').addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.querySelector('.profile-picture img').src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

//Control de notificaciones
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
