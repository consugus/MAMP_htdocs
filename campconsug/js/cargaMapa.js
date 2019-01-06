(function(){

    document.addEventListener("DOMContentLoaded", function(){

        var map = L.map('mapa').setView([-31.423129, -64.152144], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([-31.423129, -64.152144]).addTo(map)
            .bindPopup('La casa del Consugus')
            .openPopup('qué será ésto');

    });

})();



