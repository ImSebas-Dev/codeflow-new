document.addEventListener("DOMContentLoaded", function () {
    const projectDropdown = document.getElementById('create-project-btn');
    const createProjectModal = document.getElementById('createProjectModal');
    const closeModalBtn = document.getElementById('close-modal');
    const projectCards = document.querySelectorAll('.project-card-container');

    // Modal Dropdown
    const userDropdown = document.getElementById('user-dropdown');
    const userModal = document.getElementById('userModal');

    userDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        userModal.style.display = 'block';
    });

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

    // Abrir modal con botón de crear proyecto
    projectDropdown.addEventListener('click', (e) => {
        e.stopPropagation();
        createProjectModal.style.display = 'block';
    });

    // Cerrar modal con botón de cerrar
    closeModalBtn.addEventListener('click', () => {
        createProjectModal.style.display = 'none';
    });

    // Contador de caracteres para descripción
    const descriptionTextarea = document.getElementById('projectDescription');
    const descCounter = document.getElementById('descCounter');

    descriptionTextarea.addEventListener('input', () => {
        const currentLength = descriptionTextarea.value.length;
        descCounter.textContent = currentLength;

        if (currentLength > 1000) {
            descriptionTextarea.value = descriptionTextarea.value.substring(0, 1000);
            descCounter.textContent = 1000;
        }
    });

    // Inicializar contador de descripción
    descCounter.textContent = descriptionTextarea.value.length;
})