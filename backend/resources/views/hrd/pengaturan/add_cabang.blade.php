@extends('layouts.app')
@section('title', 'Pengaturan Lokasi dan Jam Kerja')
@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
        .recommendations {
            border: 1px solid #ccc;
            max-height: 200px;
            overflow-y: auto;
            margin-top: 5px;
            position: absolute;
            background: white;
            width: calc(100% - 30px);
            z-index: 1000;
        }
        .recommendation-item {
            padding: 10px;
            cursor: pointer;
        }
        .recommendation-item:hover {
            background-color: #f0f0f0;
        }
    </style>
@endpush
@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Cabang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Pengaturan</a></div>
                    <div class="breadcrumb-item">Cabang</div>
                    <div class="breadcrumb-item">Tambah Cabang</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <form id="settingForm">
                            @csrf
                            <div class="form-group">
                                <label for="latitude">Nama Cabang:</label>
                                <input type="text" id="nama_cabang"  class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="latitude">Alamat Cabang</label>
                                <textarea style="height: 100px" class="form-control" id="alamat_cabang" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="foto_cabang">Foto Cabang:</label>
                                <input type="file" id="foto_cabang" class="form-control" accept="image/*">
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="latitude" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <input type="hidden" id="longitude" class="form-control" readonly>
                            </div>
                            <button type="button" id="save-button" class="btn btn-primary" onclick="saveSetting()">Simpan Pengaturan</button>
                        </form>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="search">Cari Lokasi:</label>
                    <input type="text" id="search" class="form-control" placeholder="Masukkan nama lokasi...">
                    <div id="recommendations" class="recommendations"></div>
                </div>
                <div id="map"></div>
                <div class="form-group mt-3">
                    <label for="radius">Radius (meter): <span id="radiusValue">100</span> m</label>
                    <input type="range" id="radius" class="form-control-range" min="1" max="500" value="100" onchange="updateRadius()">
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <!-- JS Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.7.1/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>
        let map;
        let marker;
        let radiusCircle;
        const geocoder = L.Control.Geocoder.nominatim();
        // Initialize the map
        function initMap() {
            map = L.map('map').setView([-6.1751, 106.8650], 13); // Default to Jakarta coordinates
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
            // Marker
            marker = L.marker([-6.1751, 106.8650], {
                draggable: true
            }).addTo(map);
            // Initialize radius circle
            radiusCircle = L.circle(marker.getLatLng(), {
                color: 'blue',
                fillColor: '#30f',
                fillOpacity: 0.2,
                radius: 100 // Default radius
            }).addTo(map);
            // Update latitude and longitude inputs when the marker is dragged
            marker.on('dragend', function (e) {
                const position = marker.getLatLng();
                document.getElementById('latitude').value = position.lat;
                document.getElementById('longitude').value = position.lng;
                updateRadius(); // Update radius position
            });
        }
        // Update radius based on the input
        function updateRadius() {
            const radius = parseInt(document.getElementById('radius').value);
            radiusCircle.setRadius(radius);
            radiusCircle.setLatLng(marker.getLatLng()); // Update circle position to marker
            document.getElementById('radiusValue').innerText = radius; // Update displayed radius value
        }
        // Save settings
        function saveSetting() {
        const formData = new FormData();
        formData.append('latitude', marker.getLatLng().lat);
        formData.append('longitude', marker.getLatLng().lng);
        formData.append('radius', parseInt(document.getElementById('radius').value));
        formData.append('nama_cabang', document.getElementById('nama_cabang').value);
        formData.append('alamat_cabang', document.getElementById('alamat_cabang').value);
        formData.append('foto_cabang', document.getElementById('foto_cabang').files[0]); // Ambil file gambar
        fetch('/save_cabang', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData // Menggunakan FormData untuk mengirim file
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
        }
        // Search location with autocomplete
        document.getElementById('search').addEventListener('input', function() {
    const query = this.value;
    if (query.length > 2) { // Minimal 3 karakter untuk mulai pencarian
        fetch(`https://nominatim.openstreetmap.org/search?q=${query}&limit=5&format=json&addressdetails=1`)
            .then(response => response.json())
            .then(data => showRecommendations(data))
            .catch(error => console.error('Error fetching data:', error));
    } else {
        clearRecommendations();
    }
});

function showRecommendations(data) {
    const recommendationsDiv = document.getElementById('recommendations');
    recommendationsDiv.innerHTML = ''; // Bersihkan daftar sebelumnya

    data.forEach(item => {
        const div = document.createElement('div');
        div.classList.add('recommendation-item');
        div.textContent = item.display_name;
        div.addEventListener('click', function() {
            selectLocation(item);
        });
        recommendationsDiv.appendChild(div);
    });
}

function clearRecommendations() {
    document.getElementById('recommendations').innerHTML = '';
}

function selectLocation(item) {
    // Atur marker dan map berdasarkan hasil pilihan
    const lat = parseFloat(item.lat);
    const lon = parseFloat(item.lon);
    map.setView([lat, lon], 13);
    marker.setLatLng([lat, lon]);
    radiusCircle.setLatLng([lat, lon]);

    // Isi input tersembunyi latitude dan longitude
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lon;

    // Bersihkan rekomendasi
    clearRecommendations();

    // Isi field alamat jika ada
    document.getElementById('alamat_cabang').value = item.display_name;
}

        // Initialize the map when the document is ready
        document.addEventListener('DOMContentLoaded', initMap);
    </script>
@endpush
