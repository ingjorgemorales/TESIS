console.log("holaaa mundo");

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
