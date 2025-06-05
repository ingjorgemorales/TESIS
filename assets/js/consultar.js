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

    
// Filtrar registros por columna
    document.getElementById("query").addEventListener("input", function () {
        const filterText = this.value.trim().toLowerCase();
        const columnIndex = parseInt(document.getElementById("filterColumn").value);
        const tableRows = document.querySelectorAll(".responsive-table tbody tr");

        tableRows.forEach(function (row) {
            const cell = row.cells[columnIndex];
            if (cell) {
                const cellText = cell.textContent.toLowerCase();
                row.style.display = (cellText.includes(filterText)) ? "" : "none";
            }
        });
    });
    console.log("Filtro de registros activado.");


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

document.addEventListener("DOMContentLoaded", () => {
  const checkboxes = document.querySelectorAll(".fila-check");
  const previewImage = document.getElementById("previewImage");
  const previewPlaceholder = document.querySelector(".preview-placeholder");

  checkboxes.forEach(checkbox => {
    checkbox.addEventListener("change", () => {
      const fila = checkbox.closest("tr");
      const archivoCell = fila.querySelector(".archivo-radiografia");
      const archivo = archivoCell ? archivoCell.textContent : null;

      // Solo mostrar la imagen si el checkbox está marcado
      if (checkbox.checked && archivo) {
        // Desmarcar todas las filas
        checkboxes.forEach(cb => {
          cb.checked = false;
          cb.closest("tr").classList.remove("fila-seleccionada");
        });

        // Marcar la fila seleccionada y mostrar la imagen
        checkbox.checked = true;  // Asegurarse de que este checkbox esté marcado
        fila.classList.add("fila-seleccionada");
        previewImage.src = `../assets/upload/${archivo}`;
        previewImage.style.display = "block";
        previewPlaceholder.style.display = "none";
      } else {
        // Si el checkbox no está marcado, ocultar la imagen
        fila.classList.remove("fila-seleccionada");
        previewImage.style.display = "none";
        previewPlaceholder.style.display = "flex";
      }
    });
  });
});
