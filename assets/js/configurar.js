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