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

    // Función de búsqueda
    document.getElementById('query').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const tableRows = document.querySelectorAll('.responsive-table tbody tr');
        
        tableRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            if (rowText.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Simular vista previa al pasar el ratón sobre un registro
    document.querySelectorAll('.responsive-table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', function() {
            const fileIcon = this.querySelector('.file-icon');
            if (fileIcon) {
                document.getElementById('previewImage').style.display = 'block';
                document.querySelector('.preview-placeholder').style.display = 'none';
                // En una implementación real, cargaríamos la imagen real aquí
                document.getElementById('previewImage').src = '../assets/sample_xray.jpg';
            }
        });
        
        row.addEventListener('mouseleave', function() {
            document.getElementById('previewImage').style.display = 'none';
            document.querySelector('.preview-placeholder').style.display = 'flex';
        });
    });

    // Efecto de carga para la tarjeta de vista previa
    document.addEventListener('DOMContentLoaded', function () {
        const previewCard = document.querySelector('.preview-card');
        const tableSection = document.querySelector('.table-section');

        // Simular animación de carga
        setTimeout(() => {
            previewCard.style.transform = 'translateY(0)';
            previewCard.style.opacity = '1';
            tableSection.style.transform = 'translateY(0)';
            tableSection.style.opacity = '1';
        }, 300);
    });