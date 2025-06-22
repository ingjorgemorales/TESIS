document.addEventListener('DOMContentLoaded', function () {
    // Menú hamburguesa
    const hamburgerBtn = document.querySelector('.hamburger-btn');
    const sidebarNav = document.querySelector('.sidebar-nav');

    if (hamburgerBtn && sidebarNav) {
        hamburgerBtn.addEventListener('click', function () {
            sidebarNav.classList.toggle('active');
            this.classList.toggle('active');
        });
    }

    // Cerrar menú al hacer clic en un enlace (para móviles)
    document.querySelectorAll('.sidebar-nav a').forEach(item => {
        item.addEventListener('click', () => {
            if (sidebarNav && hamburgerBtn) {
                sidebarNav.classList.remove('active');
                hamburgerBtn.classList.remove('active');
            }
        });
    });

    // Efecto de carga para la tarjeta de vista previa
    const previewCard = document.querySelector('.preview-card');
    if (previewCard) {
        // Simular animación de carga
        setTimeout(() => {
            previewCard.style.transform = 'translateY(0)';
            previewCard.style.opacity = '1';
        }, 300);
    }

    // Funcionalidad para los botones de control de imagen
    document.querySelectorAll('.control-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            this.style.backgroundColor = '#e0e0e0';
            setTimeout(() => {
                this.style.backgroundColor = '';
            }, 300);
        });
    });

    // Variables para controles de imagen
    const expandBtn = document.getElementById('expandBtn');
    const contrastBtn = document.getElementById('contrastBtn');
    const rotateBtn = document.getElementById('rotateBtn');
    const image = document.getElementById('imageToControl');
    let isFullScreen = false;
    let currentContrast = 100;
    let currentRotation = 0;

    if (expandBtn && image) {
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
    }

    if (contrastBtn && image) {
        contrastBtn.addEventListener('click', function () {
            // Implementar la lógica de contraste
            currentContrast += 10;
            if (currentContrast > 200) currentContrast = 50; // Reinicia el contraste
            image.style.filter = `contrast(${currentContrast}%)`;
        });
    }

    if (rotateBtn && image) {
        rotateBtn.addEventListener('click', function () {
            // Implementar la lógica de rotación
            currentRotation += 90;
            image.style.transform = `rotate(${currentRotation}deg)`;
        });
    }
});
