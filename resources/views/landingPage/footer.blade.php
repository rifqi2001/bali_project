<footer class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" style="text-align:center">
                <h3 class="">Lokasi Pantai Kami</h3>
            </div>
        </div>
            <div class="row">
             <div class="col-lg-12">
                <div id="mapid" style="height: 400px; width: 100%;"></div>
            </div>   
            
        </div>
    </div>
</footer>

<script>
    // Inisialisasi peta dengan koordinat dan level zoom
    var mymap = L.map('mapid').setView([-6.357647, 108.387466], 13);

    // Tambahkan layer peta dari OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    // Tambahkan marker pada koordinat
    var marker = L.marker([-6.357647, 108.387466]).addTo(mymap);

    // Tambahkan popup pada marker dengan link ke Google Maps
    marker.bindPopup('<a href="https://www.google.com/maps?q=-6.357647,108.387466" target="_blank">Lihat di Google Maps</a>');

</script>
