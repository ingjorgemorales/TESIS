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

// Función para mostrar notificación
function showNotification(message, isSuccess = true) {
    const notification = document.getElementById('notification');
    const notificationMessage = document.getElementById('notificationMessage');

    notificationMessage.textContent = message;

    // Cambiar el icono según el tipo de notificación
    const icon = notification.querySelector('i');
    if (isSuccess) {
        icon.className = 'fas fa-check-circle';
        notification.style.backgroundColor = '#2DC071';
    } else {
        icon.className = 'fas fa-exclamation-circle';
        notification.style.backgroundColor = '#FF4D4F';
    }

    notification.style.display = 'block';
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);

    // Ocultar notificación después de 3 segundos
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            notification.style.display = 'none';
        }, 300);
    }, 3000);
}

// Función para filtrar la tabla
document.getElementById('searchInput').addEventListener('input', function () {
    const searchText = this.value.toLowerCase();
    const table = document.getElementById('diagnosisTable');
    const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    const noResults = document.getElementById('noResults');

    let found = false;

    for (let i = 0; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName('td');
        let rowContainsText = false;

        // Verificar cada celda (excepto la última de acciones)
        for (let j = 0; j < cells.length - 1; j++) {
            const cellText = cells[j].textContent || cells[j].innerText;
            if (cellText.toLowerCase().indexOf(searchText) > -1) {
                rowContainsText = true;
                break;
            }
        }

        if (rowContainsText) {
            rows[i].style.display = '';
            found = true;
        } else {
            rows[i].style.display = 'none';
        }
    }

    // Mostrar mensaje si no se encontraron resultados
    if (found || searchText === '') {
        noResults.style.display = 'none';
    } else {
        noResults.style.display = 'block';
    }
});

// Función para editar diagnóstico
function editDiagnostic(id) {
    showNotification(`Redirigiendo para editar el diagnóstico: ${id}`);
    // Simulación de redirección
    setTimeout(() => {
        window.location.href = `actualizar_diagnostico.php?id=${id}`;
    }, 1500);
}

// Función para eliminar diagnóstico
function confirmDelete(id) {
    if (confirm(`¿Está seguro que desea eliminar el diagnóstico ${id}? Esta acción no se puede deshacer.`)) {
        // Simulación de eliminación
        showNotification(`Diagnóstico ${id} eliminado correctamente`);

        // En una implementación real, aquí se haría una petición AJAX o se redirigiría
        // a un script de eliminación
        setTimeout(() => {
            // Aquí iría la lógica para eliminar el registro de la tabla visualmente
            // y/o recargar la página después de eliminar de la base de datos
            // location.reload();
        }, 1500);
    }
}

// Manejo de paginación
document.querySelectorAll('.page-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        // Quitar clase active a todos los botones
        document.querySelectorAll('.page-btn').forEach(b => {
            b.classList.remove('active');
        });

        // Añadir clase active al botón clickeado
        this.classList.add('active');

        // Simulación de cambio de página
        showNotification(`Mostrando página ${this.textContent} de diagnósticos`);
    });
});