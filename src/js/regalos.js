document.addEventListener('DOMContentLoaded', () => {
    const grafica = document.querySelector('#regalos-grafica');

    if (!grafica) return;

    async function obtenerDatos() {
        try {
            const url = `${location.origin}/api/regalos`;
            const respuesta = await fetch(url);

            if (!respuesta.ok) throw new Error('Error al obtener los datos');

            const resultado = await respuesta.json();

            const nombres = resultado.map(regalo => regalo.nombre);
            const totales = resultado.map(regalo => parseInt(regalo.total) || 0);

            new Chart(grafica, {
                type: 'bar',
                data: {
                    labels: nombres,
                    datasets: [{
                        label: 'Regalos',
                        data: totales,
                        backgroundColor: [
                            '#ea580c','#84cc16','#22d3ee','#a855f7',
                            '#ef4444','#14b8a6','#db2777','#e11d48','#7e22ce'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

        } catch (error) {
            console.error('Error cargando la gráfica de regalos:', error);
        }
    }

    obtenerDatos();
});
