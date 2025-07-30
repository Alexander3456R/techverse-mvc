(function() {
    // Código del módulo
    const expostiroresInput = document.querySelector('#expositor');
    if(expostiroresInput) {
        let expositores = [];
        let expositoresFiltrados = [];

        const listadoExpositores = document.querySelector('#listado-expositores');
        const expositorHidden = document.querySelector('[name="expositor_id"]');

        obtenerExpositores();
        expostiroresInput.addEventListener('input', buscarExpositores);

        if(expositorHidden.value) {
            (async() => {
                const expositor = await obtenerExpositor(expositorHidden.value);

                // Insertar en el html
                const expositorDOM = document.createElement('LI');
                expositorDOM.classList.add('listado-expositores__expositor', 'listado-expositores__expositor--seleccionado');
                expositorDOM.textContent = `${expositor.nombre} ${expositor.apellido}`;
                listadoExpositores.appendChild(expositorDOM);
            })();
        }
        
        async function obtenerExpositores() {
            const url = `/api/expositores`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            formatearExpositores(resultado);
        }

        async function obtenerExpositor(id) {
            const url = `/api/expositor?id=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            return resultado;
        }

        function formatearExpositores(arrayExpositores = []) {
            expositores = arrayExpositores.map(expositor => {
                return {
                    nombre: `${expositor.nombre.trim()} ${expositor.apellido.trim()}`,
                    id: expositor.id
                }
            })
        }

        function buscarExpositores(e) {
            const busqueda = e.target.value;

            if(busqueda.length > 3) {
                const expresion = new RegExp(busqueda, "i");
                expositoresFiltrados = expositores.filter(expositor => {
                    if(expositor.nombre.toLowerCase().search(expresion) !== -1) {
                        return expositor;
                    }
                })
            } else {
                expositoresFiltrados = [];
            }

            mostrarExpositores();
        }

        function mostrarExpositores() {
            while(listadoExpositores.firstChild) {
                listadoExpositores.removeChild(listadoExpositores.firstChild);
            }

            if(expositoresFiltrados.length > 0) {
                expositoresFiltrados.forEach(expositor => {
                    const expositorHTML = document.createElement('LI');
                    expositorHTML.classList.add('listado-expositores__expositor');
                    expositorHTML.textContent = expositor.nombre;
                    expositorHTML.dataset.expositorId = expositor.id;
                    expositorHTML.onclick = seleccionarExpositor;

                    // Añadir al DOM
                    listadoExpositores.appendChild(expositorHTML);

                })
            } else {
                const noResultados = document.createElement('P');
                noResultados.classList.add('listado-expositores__no-resultados');
                noResultados.textContent = 'No hay resultados';
                listadoExpositores.appendChild(noResultados);
            }

   
        }

        function seleccionarExpositor(e) {
            const expositor = e.target;

            // Remover la clase previa
            const expositorPrevio = document.querySelector('.listado-expositores__expositor--seleccionado');
            if(expositorPrevio) {
                expositorPrevio.classList.remove('listado-expositores__expositor--seleccionado');
            }


            expositor.classList.add('listado-expositores__expositor--seleccionado');

            expositorHidden.value = expositor.dataset.expositorId;
        }
    }

})();