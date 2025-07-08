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

function confirmDelete(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este diagnóstico?")) {
        fetch('eliminar_diagnostico.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'id=' + encodeURIComponent(id)
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === 'ok') {
                removeRow(id);
                 window.location.href = `actualizar_diagnostico.php?ms=✅El diagnóstico se eliminó correctamente&type=ok`;
            } else {
                alert("Error al eliminar el diagnóstico.");
            }
        })
        .catch(error => {
            console.error("Error de red:", error);
            alert("No se pudo conectar con el servidor.");
        });
    }
}

function removeRow(id) {
    const row = document.getElementById("diag_" + id);
    if (row) {
        row.remove();

        const remainingRows = document.querySelectorAll("tr[id^='diag_']");
        const noDataMessage = document.getElementById("no-data-message");

        if (remainingRows.length === 0 && noDataMessage) {
            noDataMessage.style.display = "table-row";
        }
    } else {
        alert("No se encontró la fila.");
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
