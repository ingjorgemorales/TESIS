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

// Efecto de zoom en imágenes
document.querySelectorAll('.zoom-img').forEach(img => {
    img.addEventListener('click', function () {
        this.classList.toggle('zoomed');
    });
});


console.log("Página cargada");

document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
    const imageUpload = document.getElementById('imageUpload');
    const imagePreview = document.getElementById('imagePreview');
    const textInput = document.getElementById('textInput');
    const textColor = document.getElementById('textColor');
    const textBgColor = document.getElementById('textBgColor');
    const textSize = document.getElementById('textSize');
    const textFont = document.getElementById('textFont');
    const addTextBtn = document.getElementById('addTextBtn');
    const clearTextBtn = document.getElementById('clearTextBtn');
    const rotateLeftBtn = document.getElementById('rotateLeftBtn');
    const rotateRightBtn = document.getElementById('rotateRightBtn');
    const flipHorizontalBtn = document.getElementById('flipHorizontalBtn');
    const flipVerticalBtn = document.getElementById('flipVerticalBtn');
    const contrastRange = document.getElementById('contrastRange');
    const brightnessRange = document.getElementById('brightnessRange');
    const saturationRange = document.getElementById('saturationRange');
    const contrastValue = document.getElementById('contrastValue');
    const brightnessValue = document.getElementById('brightnessValue');
    const saturationValue = document.getElementById('saturationValue');
    const resetBtn = document.getElementById('resetBtn');
    const downloadBtn = document.getElementById('downloadBtn');
    const zoomInBtn = document.getElementById('zoomIn');
    const zoomOutBtn = document.getElementById('zoomOut');
    const zoomResetBtn = document.getElementById('zoomReset');
    const imageContainer = document.querySelector('.image-container');

    // Variables de estado
    let currentRotation = 0;
    let scale = 1;
    let isFlippedHorizontal = false;
    let isFlippedVertical = false;
    let textElements = [];
    let activeTextElement = null;
    let dragStartX, dragStartY, elementStartX, elementStartY;


    // Agregar texto
    addTextBtn.addEventListener('click', function () {
        if (!imagePreview.src || !textInput.value.trim()) return;

        const textElement = document.createElement('div');
        textElement.className = 'text-overlay';
        textElement.textContent = textInput.value;
        textElement.style.color = textColor.value;

        // Configurar color de fondo si no es transparente
        const bgColor = textBgColor.value;
        if (bgColor !== '#00000000') {
            textElement.style.backgroundColor = bgColor;
            textElement.style.padding = '5px';
            textElement.style.borderRadius = '3px';
        }

        textElement.style.fontSize = `${textSize.value}px`;
        textElement.style.fontFamily = textFont.value;

        // Posición central inicial
        const containerRect = imageContainer.getBoundingClientRect();
        const imgRect = imagePreview.getBoundingClientRect();

        const centerX = (imgRect.width / 2) - (textElement.offsetWidth / 2);
        const centerY = (imgRect.height / 2) - (textElement.offsetHeight / 2);

        textElement.style.left = `${centerX}px`;
        textElement.style.top = `${centerY}px`;

        // Crear controles de texto
        const textControls = document.createElement('div');
        textControls.className = 'text-controls';

        const colorBtn = document.createElement('div');
        colorBtn.className = 'text-btn';
        colorBtn.innerHTML = '🎨';
        colorBtn.title = 'Cambiar color';
        colorBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const newColor = prompt('Ingresa un color (nombre, hex, rgb, etc.):', textElement.style.color);
            if (newColor) {
                textElement.style.color = newColor;
                updateActiveTextControls();
            }
        });

        const bgColorBtn = document.createElement('div');
        bgColorBtn.className = 'text-btn';
        bgColorBtn.innerHTML = '🖍️';
        bgColorBtn.title = 'Cambiar fondo';
        bgColorBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            const newBgColor = prompt('Ingresa un color de fondo (nombre, hex, rgb, etc.):', textElement.style.backgroundColor || 'transparent');
            if (newBgColor) {
                if (newBgColor.toLowerCase() === 'transparent') {
                    textElement.style.backgroundColor = '';
                    textElement.style.padding = '';
                    textElement.style.borderRadius = '';
                } else {
                    textElement.style.backgroundColor = newBgColor;
                    textElement.style.padding = '5px';
                    textElement.style.borderRadius = '3px';
                }
                updateActiveTextControls();
            }
        });

        const deleteBtn = document.createElement('div');
        deleteBtn.className = 'text-btn';
        deleteBtn.innerHTML = '🗑️';
        deleteBtn.title = 'Eliminar texto';
        deleteBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            if (confirm('¿Eliminar este texto?')) {
                const index = textElements.indexOf(textElement);
                if (index > -1) {
                    textElements.splice(index, 1);
                }
                imageContainer.removeChild(textElement);
                if (activeTextElement === textElement) {
                    activeTextElement = null;
                }
            }
        });

        textControls.appendChild(colorBtn);
        textControls.appendChild(bgColorBtn);
        textControls.appendChild(deleteBtn);
        textElement.appendChild(textControls);

        // Hacer el texto arrastrable
        makeDraggable(textElement);

        // Mostrar controles al pasar el mouse
        textElement.addEventListener('mouseenter', function () {
            textControls.style.display = 'flex';
        });

        textElement.addEventListener('mouseleave', function () {
            if (activeTextElement !== textElement) {
                textControls.style.display = 'none';
            }
        });

        imageContainer.appendChild(textElement);
        textElements.push(textElement);

        // Seleccionar el nuevo texto
        selectTextElement(textElement);
    });

    // Eliminar todo el texto
    clearTextBtn.addEventListener('click', function () {
        if (textElements.length === 0) return;
        if (confirm('¿Eliminar todo el texto agregado?')) {
            textElements.forEach(element => {
                if (element.parentNode) {
                    element.parentNode.removeChild(element);
                }
            });
            textElements = [];
            activeTextElement = null;
        }
    });

    // Rotar imagen
    rotateLeftBtn.addEventListener('click', function () {
        currentRotation -= 90;
        applyTransformations();
    });

    rotateRightBtn.addEventListener('click', function () {
        currentRotation += 90;
        applyTransformations();
    });

    // Voltear imagen
    flipHorizontalBtn.addEventListener('click', function () {
        isFlippedHorizontal = !isFlippedHorizontal;
        applyTransformations();
    });

    flipVerticalBtn.addEventListener('click', function () {
        isFlippedVertical = !isFlippedVertical;
        applyTransformations();
    });

    // Ajustes de imagen
    contrastRange.addEventListener('input', function () {
        contrastValue.textContent = contrastRange.value;
        applyImageFilters();
    });

    brightnessRange.addEventListener('input', function () {
        brightnessValue.textContent = brightnessRange.value;
        applyImageFilters();
    });

    saturationRange.addEventListener('input', function () {
        saturationValue.textContent = saturationRange.value;
        applyImageFilters();
    });

    // Zoom
    zoomInBtn.addEventListener('click', function () {
        scale *= 1.2;
        applyTransformations();
    });

    zoomOutBtn.addEventListener('click', function () {
        scale /= 1.2;
        applyTransformations();
    });

    zoomResetBtn.addEventListener('click', function () {
        scale = 1;
        applyTransformations();
    });

    // Reiniciar ajustes
    resetBtn.addEventListener('click', resetImageSettings);

    // Descargar imagen
    downloadBtn.addEventListener('click', downloadImage);

    // Funciones auxiliares
    function resetImageSettings() {
        currentRotation = 0;
        scale = 1;
        isFlippedHorizontal = false;
        isFlippedVertical = false;

        contrastRange.value = 100;
        brightnessRange.value = 100;
        saturationRange.value = 100;

        contrastValue.textContent = '100';
        brightnessValue.textContent = '100';
        saturationValue.textContent = '100';

        applyTransformations();
        applyImageFilters();
    }

    function applyTransformations() {
        let transform = `scale(${scale}) `;

        if (isFlippedHorizontal) {
            transform += 'scaleX(-1) ';
        }

        if (isFlippedVertical) {
            transform += 'scaleY(-1) ';
        }

        transform += `rotate(${currentRotation}deg)`;

        imagePreview.style.transform = transform;
    }

    function applyImageFilters() {
        const contrast = contrastRange.value;
        const brightness = brightnessRange.value;
        const saturation = saturationRange.value;

        imagePreview.style.filter = `
                    contrast(${contrast}%)
                    brightness(${brightness}%)
                    saturate(${saturation}%)
                `;
    }

    function makeDraggable(element) {
        element.addEventListener('mousedown', startDrag);

        function startDrag(e) {
            // Ignorar si se hizo clic en los controles del texto
            if (e.target.classList.contains('text-btn') ||
                e.target.classList.contains('text-controls')) {
                return;
            }

            e.preventDefault();
            selectTextElement(element);

            // Obtener posición inicial
            dragStartX = e.clientX;
            dragStartY = e.clientY;

            const style = window.getComputedStyle(element);
            elementStartX = parseInt(style.left);
            elementStartY = parseInt(style.top);

            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', stopDrag);
        }

        function drag(e) {
            const dx = e.clientX - dragStartX;
            const dy = e.clientY - dragStartY;

            element.style.left = `${elementStartX + dx}px`;
            element.style.top = `${elementStartY + dy}px`;
        }

        function stopDrag() {
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('mouseup', stopDrag);
        }
    }

    function selectTextElement(element) {
        // Deseleccionar el elemento activo anterior
        if (activeTextElement) {
            activeTextElement.classList.remove('selected-text');
            const prevControls = activeTextElement.querySelector('.text-controls');
            if (prevControls) {
                prevControls.style.display = 'none';
            }
        }

        // Seleccionar el nuevo elemento
        activeTextElement = element;
        activeTextElement.classList.add('selected-text');

        // Mostrar controles del texto seleccionado
        const controls = activeTextElement.querySelector('.text-controls');
        if (controls) {
            controls.style.display = 'flex';
        }

        // Actualizar controles de texto
        updateActiveTextControls();
    }

    function updateActiveTextControls() {
        if (!activeTextElement) return;

        textInput.value = activeTextElement.textContent;
        textColor.value = rgbToHex(activeTextElement.style.color);
        textSize.value = parseInt(activeTextElement.style.fontSize) || 24;

        // Actualizar fuente si está definida
        if (activeTextElement.style.fontFamily) {
            const font = activeTextElement.style.fontFamily.replace(/['"]/g, '');
            textFont.value = font;
        }
    }

    function rgbToHex(rgb) {
        if (!rgb) return '#ffffff';

        // Si ya es un valor hexadecimal
        if (rgb.startsWith('#')) {
            return rgb;
        }

        // Extraer los valores RGB
        const rgbValues = rgb.match(/\d+/g);
        if (!rgbValues || rgbValues.length < 3) return '#ffffff';

        const r = parseInt(rgbValues[0]);
        const g = parseInt(rgbValues[1]);
        const b = parseInt(rgbValues[2]);

        return '#' + [r, g, b].map(x => {
            const hex = x.toString(16);
            return hex.length === 1 ? '0' + hex : hex;
        }).join('');
    }

    function downloadImage() {
        if (!imagePreview.src) {
            alert('Primero sube una imagen');
            return;
        }

        // Crear un canvas para combinar imagen y texto
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');

        // Ajustar el tamaño del canvas a la imagen
        const img = new Image();
        img.crossOrigin = 'Anonymous';
        img.src = imagePreview.src;

        img.onload = function () {
            // Configurar el canvas con las dimensiones correctas
            canvas.width = img.width;
            canvas.height = img.height;

            // Aplicar transformaciones (rotación y volteo)
            ctx.save();

            // Mover al centro del canvas
            ctx.translate(canvas.width / 2, canvas.height / 2);

            // Aplicar rotación
            ctx.rotate(currentRotation * Math.PI / 180);

            // Aplicar volteo
            if (isFlippedHorizontal) {
                ctx.scale(-1, 1);
            }
            if (isFlippedVertical) {
                ctx.scale(1, -1);
            }

            // Dibujar la imagen con los filtros aplicados
            ctx.filter = `
                        contrast(${contrastRange.value}%)
                        brightness(${brightnessRange.value}%)
                        saturate(${saturationRange.value}%)
                    `;

            // Dibujar la imagen (teniendo en cuenta la escala y posición)
            ctx.drawImage(
                img,
                -img.width / 2 * scale,
                -img.height / 2 * scale,
                img.width * scale,
                img.height * scale
            );

            ctx.restore();

            // Dibujar el texto
            textElements.forEach(textElement => {
                const style = window.getComputedStyle(textElement);
                const left = parseInt(style.left);
                const top = parseInt(style.top);
                const fontSize = parseInt(style.fontSize);
                const color = style.color;
                const bgColor = style.backgroundColor;
                const fontFamily = style.fontFamily;
                const text = textElement.textContent;

                // Calcular posición relativa en el canvas
                const imgRect = imagePreview.getBoundingClientRect();
                const containerRect = imageContainer.getBoundingClientRect();

                const scaleX = img.width / imgRect.width;
                const scaleY = img.height / imgRect.height;

                const x = left * scaleX;
                const y = top * scaleY;

                // Configurar el texto
                ctx.font = `bold ${fontSize * scaleX}px ${fontFamily}`;
                ctx.textAlign = 'left';
                ctx.textBaseline = 'top';

                // Dibujar fondo si existe
                if (bgColor && bgColor !== 'rgba(0, 0, 0, 0)' && bgColor !== 'transparent') {
                    const textMetrics = ctx.measureText(text);
                    const padding = 5 * scaleX;

                    ctx.fillStyle = bgColor;
                    ctx.beginPath();
                    ctx.roundRect(
                        x - padding,
                        y - padding,
                        textMetrics.width + padding * 2,
                        fontSize * scaleX + padding * 2,
                        [3 * scaleX]
                    );
                    ctx.fill();
                }

                // Dibujar el texto
                ctx.fillStyle = color;
                ctx.fillText(text, x, y);
            });

            // Descargar la imagen
            const link = document.createElement('a');
            link.download = 'imagen-editada.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        };

        img.onerror = function () {
            alert('Error al cargar la imagen para descarga');
        };
    }

    // Permitir eliminar texto con la tecla Suprimir
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Delete' && activeTextElement) {
            if (confirm('¿Eliminar este texto?')) {
                const index = textElements.indexOf(activeTextElement);
                if (index > -1) {
                    textElements.splice(index, 1);
                }
                imageContainer.removeChild(activeTextElement);
                activeTextElement = null;
            }
        }
    });

    // Seleccionar texto al hacer clic
    imageContainer.addEventListener('click', function (e) {
        if (e.target === imageContainer || e.target === imagePreview) {
            if (activeTextElement) {
                activeTextElement.classList.remove('selected-text');
                const controls = activeTextElement.querySelector('.text-controls');
                if (controls) {
                    controls.style.display = 'none';
                }
                activeTextElement = null;
            }
        }
    });
});

console.log("hola");
