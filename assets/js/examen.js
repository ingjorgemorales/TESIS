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

// Preview de la imagen subida
document.getElementById('fileUpload').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const preview = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const removeBtn = document.getElementById('removeImageBtn');
    const dicomIcon = document.querySelector('.dicom-icon');

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            dicomIcon.style.display = 'none';
            fileName.textContent = file.name;
            removeBtn.style.display = 'inline-flex';
        }

        reader.readAsDataURL(file);
    }
});

// Eliminar imagen
document.getElementById('removeImageBtn').addEventListener('click', function () {
    const preview = document.getElementById('previewImage');
    const fileName = document.getElementById('fileName');
    const fileInput = document.getElementById('fileUpload');
    const dicomIcon = document.querySelector('.dicom-icon');
    const removeBtn = document.getElementById('removeImageBtn');

    preview.style.display = 'none';
    dicomIcon.style.display = 'block';
    fileName.textContent = '';
    fileInput.value = '';
    removeBtn.style.display = 'none';
});

// Efecto de carga para la tarjeta de vista previa
document.addEventListener('DOMContentLoaded', function () {
    const patientForm = document.querySelector('.patient-form');

    // Simular animación de carga
    setTimeout(() => {
        patientForm.style.transform = 'translateY(0)';
        patientForm.style.opacity = '1';
    }, 300);
});