// Obtener elementos del DOM
const hamburgerBtn = document.querySelector('.hamburger-btn');
const sidebarNav = document.querySelector('.sidebar-nav');

// Función para cerrar el menú
function closeMenu() {
    sidebarNav.classList.remove('active');
    hamburgerBtn.classList.remove('active');
}
// Menú hamburguesa
document.querySelector('.hamburger-btn').addEventListener('click', function () {
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
window.addEventListener('resize', function () {
    if (window.innerWidth > 900) {
        closeMenu();
    }
});

// Verificar estado inicial
if (window.innerWidth > 900) {
    closeMenu();
}

// Mostrar notificación
setTimeout(() => {
    document.getElementById('notification').classList.add('show');

    // Ocultar después de 3 segundos
    setTimeout(() => {
        document.getElementById('notification').classList.remove('show');
    }, 3000);
}, 100);