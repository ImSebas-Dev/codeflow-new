document.addEventListener('DOMContentLoaded', function () {
    const savedState = localStorage.getItem('project-collapsed');
        if (savedState === 'true') {
            const header = document.querySelector('.collapsible-header');
            if (header) {
                toggleCollapse(header);
            }
        }

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
});

// JavaScript para manejar la funcionalidad
function toggleCollapse(header) {
    // Encuentra el contenido colapsable asociado
    const content = header.nextElementSibling;
    const icon = header.querySelector('.collapse-icon');

    // Alternar la clase 'collapsed'
    content.classList.toggle('collapsed');
    header.classList.toggle('collapsed-icon');

    // Opcional: Si quieres guardar el estado
    const isCollapsed = content.classList.contains('collapsed');
    localStorage.setItem('project-collapsed', isCollapsed);
}