@extends('layouts.app')

@section('title', 'Detail Cabang - ' . $cabang->nama_cabang)

@push('style')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #map {
            height: 400px; /* Tinggi peta */
            border-radius: 8px; /* Memberikan sudut melengkung */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Efek bayangan */
        }
        .detail-card {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            color: #4e73df; /* Warna biru untuk judul */
            font-weight: bold;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail Cabang</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Cabang</a></div>
                    <div class="breadcrumb-item">{{ $cabang->nama_cabang }}</div>
                </div>
            </div>

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card detail-card">
                            <div class="card-header">
                                <h4 class="section-title">{{ $cabang->nama_cabang }}</h4>
                            </div>
                            <div class="card-body">
                                <img height="200" src="{{ asset($cabang->foto_cabang) }}" alt="Foto Cabang" class="img-fluid rounded mb-3">
                                <p><strong>Alamat:</strong> {{ $cabang->alamat_cabang }}</p>
                                <p><strong>Radius:</strong> {{ $cabang->radius }} meter</p>
                                <p><strong>Koordinat:</strong> {{ $cabang->latitude }}, {{ $cabang->longitude }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div id="map"></div> <!-- Peta akan muncul di sini -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script>
        // Inisialisasi peta
        const map = L.map('map').setView([{{ $cabang->latitude }}, {{ $cabang->longitude }}], 15);

        // Tambahkan peta dasar
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tambahkan marker di lokasi cabang
        L.marker([{{ $cabang->latitude }}, {{ $cabang->longitude }}])
            .addTo(map)
            .bindPopup(
                `<strong>{{ $cabang->nama_cabang }}</strong><br>{{ $cabang->alamat_cabang }}`
            )
            .openPopup();

        // Tambahkan lingkaran radius
        L.circle([{{ $cabang->latitude }}, {{ $cabang->longitude }}], {
            color: 'blue',
            fillColor: '#add8e6',
            fillOpacity: 0.5,
            radius: {{ $cabang->radius }}
        }).addTo(map);
    </script>
@endpush
