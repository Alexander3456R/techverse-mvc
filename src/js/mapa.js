if(document.querySelector('#mapa')) {

    const lat = -0.182803
    const lng = -78.484491
    const zoom = 16;




    const map = L.map('mapa').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h2 class="mapa__heading">TechVerse</h2>
            <p class="mapa__texto">Pista de la carolina</p>    
        `)
        .openPopup();
}