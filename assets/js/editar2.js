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

// Efecto de carga para la tarjeta de vista previa
document.addEventListener('DOMContentLoaded', function () {
    const previewCard = document.querySelector('.preview-card');

    // Simular animación de carga
    setTimeout(() => {
        previewCard.style.transform = 'translateY(0)';
        previewCard.style.opacity = '1';
    }, 300);
});

// Funcionalidad para los botones de control de imagen
document.querySelectorAll('.control-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        this.style.backgroundColor = '#e0e0e0';
        setTimeout(() => {
            this.style.backgroundColor = '';
        }, 300);
    });
});