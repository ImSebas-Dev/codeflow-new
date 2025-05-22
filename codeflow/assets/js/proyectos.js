document.addEventListener("DOMContentLoaded", function () {
    const projectDropdown = document.getElementsByClassName('create-project-btn');
    const createProjectModal = document.getElementById('createProjectModal');
    const closeModalBtn = document.getElementsByClassName('modal-close');
    const projectCards = document.querySelectorAll('.project-card-container');
    const userDropdown = document.getElementById('user-dropdown');
    const userModal = document.getElementById('userModal');
    const descriptionTextarea = document.getElementsByClassName('projectDescription');
    const descCounter = document.getElementById('descCounter');

    // Abre el user modal
    userDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        userModal.style.display = 'block';
    });

    // Abrir modal con botón de crear proyecto
    for (let btnProject of projectDropdown) {
        btnProject.addEventListener('click', function () {
            createProjectModal.style.display = 'block';
        });    
    }

    // Cerrar modal con botón de cerrar
    for (let closeBtn of closeModalBtn) {
        closeBtn.addEventListener('click', () => {
            createProjectModal.style.display = 'none';
        });
    }

    // Cerrar al hacer clic fuera
    document.addEventListener('click', (e) => {
        if (!userModal.contains(e.target) && e.target !== userDropdown) {
            userModal.style.display = 'none';
        }
    });

    // Cerrar con ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            userModal.style.display = 'none';
        }
    });

    // Efecto de sombra al pasar el mouse sobre las tarjetas
    projectCards.forEach(card => {
        card.addEventListener('mouseenter', function () {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.transform = '';
            this.style.boxShadow = '';
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