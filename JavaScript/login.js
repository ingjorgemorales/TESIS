document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    
    // Credenciales válidas (simuladas)
    const validCredentials = {
        'radiologo@xrai.com': 'diagnostico123',
        'medico@xrai.com': 'imagenes456',
        'admin@xrai.com': 'admin789'
    };
    
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const username = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        
        // Mostrar estado de carga
        const submitBtn = loginForm.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Verificando...';
        submitBtn.disabled = true;
        
        // Simular retardo de red
        setTimeout(() => {
            // Validar credenciales
            if (validCredentials[username] && validCredentials[username] === password) {
                showAlert('Acceso autorizado. Redirigiendo...', 'success');
                
                // Redirigir al sistema después de 1.5 segundos
                setTimeout(() => {
                    window.location.href = 'sistema.html'; // Cambiar por tu página de destino
                }, 1500);
            } else {
                showAlert('Usuario o contraseña incorrectos', 'error');
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            }
        }, 1000);
    });
    
    // Función para mostrar alertas
    function showAlert(message, type) {
        // Eliminar alertas previas
        const existingAlert = document.querySelector('.login-alert');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        // Crear elemento de alerta
        const alertDiv = document.createElement('div');
        alertDiv.className = `login-alert ${type}`;
        alertDiv.textContent = message;
        
        // Insertar antes del formulario
        loginForm.insertBefore(alertDiv, loginForm.firstChild);
        
        // Eliminar después de 5 segundos
        if (type === 'error') {
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    }
});