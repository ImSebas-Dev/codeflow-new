document.addEventListener("DOMContentLoaded", function () {
    // Gráfico para el dashboard de empresa
    if (document.getElementById('activityChart')) {
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [
                    {
                        label: 'Proyectos iniciados',
                        data: [3, 5, 2, 4, 6, 5],
                        backgroundColor: '#6e3aed',
                        borderRadius: 6
                    },
                    {
                        label: 'Proyectos completados',
                        data: [2, 3, 1, 3, 4, 3],
                        backgroundColor: '#4a25a8',
                        borderRadius: 6
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        },
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Gráfico para el dashboard de freelancer
    if (document.getElementById('freelancerChart')) {
        const ctx = document.getElementById('freelancerChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Ingresos ($)',
                    data: [2200, 2800, 2500, 3000, 3200, 2900, 3250],
                    borderColor: '#6e3aed',
                    backgroundColor: 'rgba(110, 58, 237, 0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(255, 255, 255, 0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
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
})