// Función para cerrar el menú
function closeMenu() {
    document.querySelector('.sidebar-nav').classList.remove('active');
    document.querySelector('.hamburger-btn').classList.remove('active');
}

// Menú hamburguesa
document.querySelector('.hamburger-btn').addEventListener('click', function() {
    document.querySelector('.sidebar-nav').classList.toggle('active');
    this.classList.toggle('active');
});

// Cerrar menú al hacer clic en enlaces (móviles)
document.querySelectorAll('.sidebar-nav a').forEach(item => {
    item.addEventListener('click', closeMenu);
});

// Cerrar menú automáticamente al redimensionar
window.addEventListener('resize', function() {
    const isMenuOpen = document.querySelector('.hamburger-btn').classList.contains('active');
    if (window.innerWidth > 900 && isMenuOpen) {
        closeMenu();
    }
});

// Verificar estado inicial al cargar
if (window.innerWidth > 900) {
    closeMenu();
}

document.addEventListener('DOMContentLoaded', function () {
    // Elementos del DOM
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

    // Centrar imagen al cargar
    if (imagePreview.complete) {
        centerImage();
    } else {
        imagePreview.onload = centerImage;
    }

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

        // Posición central inicial relativa al contenedor
        const containerRect = imageContainer.getBoundingClientRect();
        const scrollLeft = imageContainer.scrollLeft;
        const scrollTop = imageContainer.scrollTop;
        
        const centerX = (containerRect.width / 2) - (textElement.offsetWidth / 2) + scrollLeft;
        const centerY = (containerRect.height / 2) - (textElement.offsetHeight / 2) + scrollTop;

        textElement.style.position = 'absolute';
        textElement.style.left = `${centerX}px`;
        textElement.style.top = `${centerY}px`;

        // Hacer el texto arrastrable
        makeDraggable(textElement);
        imageContainer.appendChild(textElement);
        textElements.push(textElement);

        // Seleccionar el nuevo texto
        selectTextElement(textElement);
    });

    // Eliminar todo el texto
    clearTextBtn.addEventListener('click', function () {
        if (textElements.length === 0) return;
        if (confirm('¿Eliminar todo el texto agregado?')) {
            textElements.forEach(element => element.parentNode?.removeChild(element));
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
        scale *= 1.3;
        applyTransformations();
        centerImage();
    });

    zoomOutBtn.addEventListener('click', function () {
        if (scale > 0.2) {
            scale /= 1.3;
            applyTransformations();
            centerImage();
        }
    });

    zoomResetBtn.addEventListener('click', function () {
        scale = 1;
        currentRotation = 0;
        isFlippedHorizontal = false;
        isFlippedVertical = false;
        applyTransformations();
        centerImage();
        resetImageSettings();
    });

    // Reiniciar ajustes
    resetBtn.addEventListener('click', resetImageSettings);

    // Descargar imagen
    downloadBtn.addEventListener('click', downloadImage);

    // Funciones auxiliares
    function resetImageSettings() {
        contrastRange.value = 100;
        brightnessRange.value = 100;
        saturationRange.value = 100;

        contrastValue.textContent = '100';
        brightnessValue.textContent = '100';
        saturationValue.textContent = '100';

        applyImageFilters();
    }

    function applyTransformations() {
        let transform = `scale(${scale})`;

        if (isFlippedHorizontal) transform += ' scaleX(-1)';
        if (isFlippedVertical) transform += ' scaleY(-1)';
        if (currentRotation !== 0) transform += ` rotate(${currentRotation}deg)`;

        imagePreview.style.transform = transform;
        
        // Ajustar el contenedor para scroll cuando la imagen es grande
        if (scale > 1) {
            imageContainer.style.overflow = 'auto';
        } else {
            imageContainer.style.overflow = 'hidden';
        }
    }

    function applyImageFilters() {
        imagePreview.style.filter = `
            contrast(${contrastRange.value}%)
            brightness(${brightnessRange.value}%)
            saturate(${saturationRange.value}%)
        `;
    }

    function centerImage() {
        setTimeout(() => {
            if (scale > 1) {
                const centerX = (imagePreview.offsetWidth * scale - imageContainer.clientWidth) / 2;
                const centerY = (imagePreview.offsetHeight * scale - imageContainer.clientHeight) / 2;
                
                imageContainer.scrollTo({
                    left: centerX,
                    top: centerY,
                    behavior: 'smooth'
                });
            } else {
                imageContainer.scrollTo({
                    left: 0,
                    top: 0,
                    behavior: 'smooth'
                });
            }
        }, 10);
    }

    function makeDraggable(element) {
        let isDragging = false;
        let offsetX, offsetY;

        element.addEventListener('mousedown', startDrag);

        function startDrag(e) {
            e.preventDefault();
            isDragging = true;
            
            const rect = element.getBoundingClientRect();
            offsetX = e.clientX - rect.left;
            offsetY = e.clientY - rect.top;
            
            selectTextElement(element);
            document.addEventListener('mousemove', drag);
            document.addEventListener('mouseup', stopDrag);
        }

        function drag(e) {
            if (!isDragging) return;
            
            const containerRect = imageContainer.getBoundingClientRect();
            const scrollLeft = imageContainer.scrollLeft;
            const scrollTop = imageContainer.scrollTop;
            
            let newX = e.clientX - containerRect.left - offsetX + scrollLeft;
            let newY = e.clientY - containerRect.top - offsetY + scrollTop;
            
            // Limitar al área del contenedor
            newX = Math.max(0, Math.min(newX, containerRect.width - element.offsetWidth));
            newY = Math.max(0, Math.min(newY, containerRect.height - element.offsetHeight));
            
            element.style.left = `${newX}px`;
            element.style.top = `${newY}px`;
        }

        function stopDrag() {
            isDragging = false;
            document.removeEventListener('mousemove', drag);
            document.removeEventListener('mouseup', stopDrag);
        }
    }

    function selectTextElement(element) {
        if (activeTextElement) {
            activeTextElement.classList.remove('selected-text');
        }
        
        activeTextElement = element;
        activeTextElement.classList.add('selected-text');
        updateActiveTextControls();
    }

    function updateActiveTextControls() {
        if (!activeTextElement) return;

        textInput.value = activeTextElement.textContent;
        textColor.value = rgbToHex(activeTextElement.style.color);
        textSize.value = parseInt(activeTextElement.style.fontSize) || 24;

        if (activeTextElement.style.fontFamily) {
            const font = activeTextElement.style.fontFamily.replace(/['"]/g, '');
            textFont.value = font;
        }
    }

    function rgbToHex(rgb) {
        if (!rgb) return '#ffffff';
        if (rgb.startsWith('#')) return rgb;

        const rgbValues = rgb.match(/\d+/g);
        if (!rgbValues || rgbValues.length < 3) return '#ffffff';

        return '#' + rgbValues.slice(0, 3)
            .map(x => parseInt(x).toString(16).padStart(2, '0'))
            .join('');
    }

    function downloadImage() {
        if (!imagePreview.src) {
            alert('No hay imagen para descargar');
            return;
        }

        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        const img = new Image();
        
        img.crossOrigin = 'Anonymous';
        img.src = imagePreview.src;

        img.onload = function() {
            canvas.width = img.width;
            canvas.height = img.height;
            
            ctx.save();
            ctx.translate(canvas.width / 2, canvas.height / 2);
            
            // Aplicar transformaciones
            if (isFlippedHorizontal) ctx.scale(-1, 1);
            if (isFlippedVertical) ctx.scale(1, -1);
            if (currentRotation !== 0) ctx.rotate(currentRotation * Math.PI / 180);
            
            // Aplicar filtros
            ctx.filter = `
                contrast(${contrastRange.value}%)
                brightness(${brightnessRange.value}%)
                saturate(${saturationRange.value}%)
            `;
            
            // Dibujar imagen
            ctx.drawImage(
                img,
                -img.width / 2 * scale,
                -img.height / 2 * scale,
                img.width * scale,
                img.height * scale
            );
            
            ctx.restore();
            
            // Dibujar texto
            textElements.forEach(textElement => {
                const style = window.getComputedStyle(textElement);
                const left = parseInt(style.left);
                const top = parseInt(style.top);
                const fontSize = parseInt(style.fontSize);
                const color = style.color;
                const bgColor = style.backgroundColor;
                const fontFamily = style.fontFamily;
                const text = textElement.textContent;
                
                // Calcular posición relativa
                const imgRect = imagePreview.getBoundingClientRect();
                const scaleX = img.width / imgRect.width;
                const scaleY = img.height / imgRect.height;
                
                const x = left * scaleX;
                const y = top * scaleY;
                
                // Configurar texto
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
                
                // Dibujar texto
                ctx.fillStyle = color;
                ctx.fillText(text, x, y);
            });
            
            // Descargar
            const link = document.createElement('a');
            link.download = `radiografia-${new Date().toISOString().slice(0, 10)}.png`;
            link.href = canvas.toDataURL('image/png');
            link.click();
        };
        
        img.onerror = function() {
            alert('Error al cargar la imagen para descarga');
        };
    }

    // Manejo de teclado
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Delete' && activeTextElement) {
            if (confirm('¿Eliminar este texto?')) {
                const index = textElements.indexOf(activeTextElement);
                if (index > -1) textElements.splice(index, 1);
                activeTextElement.parentNode?.removeChild(activeTextElement);
                activeTextElement = null;
            }
        }
    });

    // Deseleccionar texto al hacer clic fuera
    imageContainer.addEventListener('click', function(e) {
        if (e.target === imageContainer || e.target === imagePreview) {
            if (activeTextElement) {
                activeTextElement.classList.remove('selected-text');
                activeTextElement = null;
            }
        }
    });
});