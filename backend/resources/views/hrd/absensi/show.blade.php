@extends('layouts.app')

@section('title', 'Detail Absensi')

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="javascript:void(0);" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Detail Absensi</h1>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Informasi Absensi</h4>
                            </div>
                            <div class="card-body">
                                <p><strong>Nama Karyawan:</strong> {{ $karyawan->nama }}</p>
                                <p><strong>Waktu Absensi:</strong> {{ $absensi->waktu_absensi ?? '-' }}</p>
                                <p><strong>Status Absensi:</strong> {{ $absensi->status_absensi ?? '-' }}</p>
                                <p><strong>Catatan:</strong> {{ $absensi->catatan ?? '-' }}</p>

                                <img src="{{ asset('checkin_photos/'.$absensi->foto) }}" alt="Image" class="img-fluid">

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Lokasi Presensi</h4>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        @if ($absensi->lat && $absensi->lon)
            var map = L.map('map').setView([{{ $absensi->lat }}, {{ $absensi->lon }}], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([{{ $absensi->lat }}, {{ $absensi->lon }}]).addTo(map)
                .bindPopup("<b>Lokasi Presensi</b><br />Lat: {{ $absensi->lat }}, Lon: {{ $absensi->lon }}")
                .openPopup();
        @endif
    </script>
@endpush
