document.addEventListener("DOMContentLoaded", function () {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const registerForms = document.querySelectorAll('.register-form');
    const descriptionTextarea = document.getElementsByClassName('freelancer-bio');
    const descCounter = document.getElementById('descCounter');

    // Maneja las pestañas de registro
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            // Remover clase active de todos los botones y formularios
            tabBtns.forEach(b => b.classList.remove('active'));
            registerForms.forEach(form => form.classList.remove('active'));

            // Agregar clase active al botón clickeado
            this.classList.add('active');

            // Mostrar el formulario correspondiente
            const tabId = this.getAttribute('data-tab');
            document.getElementById(`${tabId}-form`).classList.add('active');
        });
    });

    // Maneja la seguridad de la contraseña
    const passwordInputs = document.querySelectorAll('input[type="password"]');

    passwordInputs.forEach(input => {
        input.addEventListener('input', function () {
            const strengthBar = this.closest('.form-group').querySelector('.strength-bar');
            const strengthText = this.closest('.form-group').querySelector('.strength-text span');
            const password = this.value;
            let strength = 0;

            // Validaciones de fortaleza
            if (password.length > 0) strength += 1;
            if (password.length >= 8) strength += 1;
            if (/[A-Z]/.test(password)) strength += 1;
            if (/[0-9]/.test(password)) strength += 1;
            if (/[^A-Za-z0-9]/.test(password)) strength += 1;

            // Actualizar barra y texto
            strengthBar.style.width = `${strength * 20}%`;

            // Cambiar colores según fortaleza
            if (strength <= 1) {
                strengthBar.style.backgroundColor = '#dc3545';
                strengthText.textContent = 'Débil';
            } else if (strength <= 3) {
                strengthBar.style.backgroundColor = '#fd7e14';
                strengthText.textContent = 'Moderada';
            } else {
                strengthBar.style.backgroundColor = '#28a745';
                strengthText.textContent = 'Fuerte';
            }
        });
    });

    // Contador de caracteres para descripción
    for (let textarea of descriptionTextarea) {
        textarea.addEventListener('input', function () {
            const currentLength = textarea.value.length;
            descCounter.textContent = currentLength;

            if (currentLength > 1000) {
                textarea.value = textarea.value.substring(0, 1000);
                descCounter.textContent = 1000;
            }

            // Inicializar contador de descripción
            descCounter.textContent = descriptionTextarea.value.length;
        })
    }
})