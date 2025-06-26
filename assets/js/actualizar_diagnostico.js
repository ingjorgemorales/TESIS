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

// Control de confianza IA
const confidenceSlider = document.getElementById('porcentaje_confianza');
const confidenceFill = document.getElementById('confidenceFill');
const confidenceValue = document.getElementById('confidenceValue');

// Configurar color inicial
// Asegúrate de que este valor se inyecta correctamente desde PHP en el HTML, por ejemplo:
// <script>const initialConfidence = <?php echo (int)$diagnostico['confianza']; ?>;</script>
// Y luego usa esa variable aquí:
if (typeof initialConfidence !== 'undefined') {
    updateConfidenceColor(initialConfidence);
    confidenceSlider.value = initialConfidence;
    confidenceFill.style.width = initialConfidence + '%';
    confidenceValue.textContent = initialConfidence + '%';
}

confidenceSlider.addEventListener('input', function () {
    const value = this.value;
    confidenceFill.style.width = value + '%';
    confidenceValue.textContent = value + '%';
    updateConfidenceColor(value);
});

function updateConfidenceColor(value) {
    // Cambiar color según el porcentaje
    if (value < 50) {
        confidenceFill.style.background = '#ff6b6b';
    } else if (value < 80) {
        confidenceFill.style.background = '#ffd166';
    } else {
        confidenceFill.style.background = '#06d6a0';
    }
}

// Manejo del formulario
document.getElementById('updateDiagnosisForm').addEventListener('submit', function (e) {
    e.preventDefault();

    // Simulación de actualización exitosa
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
                <div class="notification-content">
                    <i class="fas fa-check-circle"></i>
                    <span>Diagnóstico actualizado exitosamente</span>
                </div>
            `;

    document.body.appendChild(notification);

    // Mostrar notificación
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);

    // Ocultar notificación después de 3 segundos
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.remove();
            // Redirigir después de actualizar
            window.location.href = 'diagnostico.php';
        }, 300);
    }, 3000);
});

// Botón de cancelar
document.getElementById('cancelBtn').addEventListener('click', function () {
    if (confirm('¿Está seguro que desea cancelar? Los cambios no guardados se perderán.')) {
        window.location.href = 'diagnostico.php';
    }
});