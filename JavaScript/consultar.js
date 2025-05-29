  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("query").addEventListener("input", function() {
        let filtro = this.value.trim().toLowerCase(); // Obtiene el valor del input
        let filas = document.querySelectorAll("table tr"); // Obtiene todas las filas de la tabla

        filas.forEach((fila, index) => {
            if (index === 0) return; // Salta la cabecera de la tabla

            let idPaciente = fila.cells[1].textContent.trim().toLowerCase(); // Obtiene el ID del paciente
            if (idPaciente.includes(filtro)) {
                fila.style.display = ""; // Muestra la fila si coincide
            } else {
                fila.style.display = "none"; // Oculta la fila si no coincide
            }
        });
    });
});
  document.getElementById('fileUpload').addEventListener('change', function() {
        let file = this.files[0];
        if (file) {
            document.getElementById('fileName').textContent = file.name;
        } else {
            document.getElementById('fileName').textContent = "No se seleccionó ninguna imagen";
        }
    });



    document.getElementById('fileUpload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const fileNameSpan = document.getElementById('fileName');
    const previewImage = document.getElementById('previewImage');

    if (file) {
        fileNameSpan.textContent = file.name;

        const reader = new FileReader();
        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        fileNameSpan.textContent = '';
        previewImage.style.display = 'none';
    }
});
