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

expandBtn.addEventListener('click', function () {
    // Implementar la lógica de pantalla completa
    if (!isFullScreen) {
        if (image.requestFullscreen) {
            image.requestFullscreen();
        } else if (image.mozRequestFullScreen) { /* Firefox */
            image.mozRequestFullScreen();
        } else if (image.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
            image.webkitRequestFullscreen();
        } else if (image.msRequestFullscreen) { /* IE/Edge */
            image.msRequestFullscreen();
        }
        isFullScreen = true;
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.mozCancelFullScreen) { /* Firefox */
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) { /* Chrome, Safari & Opera */
            document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) { /* IE/Edge */
            document.msExitFullscreen();
        }
        isFullScreen = false;
    }
});

contrastBtn.addEventListener('click', function () {
    // Implementar la lógica de contraste
    currentContrast += 10;
    if (currentContrast > 200) currentContrast = 50; // Reinicia el contraste
    image.style.filter = `contrast(${currentContrast}%)`;
});

rotateBtn.addEventListener('click', function () {
    // Implementar la lógica de rotación
    currentRotation += 90;
    image.style.transform += ` rotate(${currentRotation}deg)`;
});
