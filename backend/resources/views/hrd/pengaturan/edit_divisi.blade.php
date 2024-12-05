@extends('layouts.app')

@section('title', 'General Settings')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>General Settings</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">General Settings</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">All About General Settings</h2>
                <p class="section-lead">You can adjust all general settings here</p>

                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Jump To</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('hrd.pengaturan.general') }}" class="nav-link active">Divisi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('hrd.pengaturan.jenis_absensi') }}" class="nav-link">Jenis absensi</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="" method="POST" id="setting-form">
                            @csrf
                            @if(isset($divisi)) @method('PUT') @endif

                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>{{ isset($divisi) ? 'Edit Divisi' : 'Buat Divisi' }}</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Form Nama Divisi -->
                                    <div class="form-group">
                                        <label for="nama_divisi">Nama Divisi</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="nama_divisi"
                                            name="nama_divisi"
                                            value="{{ old('nama_divisi', $divisi->nama_divisi ?? '') }}"
                                            placeholder="Masukkan nama divisi"
                                            required>
                                    </div>

                                    <!-- Section Jadwal -->
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <div id="jadwal-container">
                                            @if(isset($divisi) && $divisi->jadwal)
                                                @foreach ($divisi->jadwal as $jadwal)
                                                    <div class="jadwal-row d-flex align-items-center mb-2">
                                                        <select class="form-control mr-2" name="jenis_absensi[]" required>
                                                            @foreach ($jenis_absensi as $absensi)
                                                                <option value="{{ $absensi->id_jenis_absensi }}"
                                                                    {{ $jadwal->jenis_absensi_id == $absensi->id_jenis_absensi ? 'selected' : '' }}>
                                                                    {{ $absensi->nama_jenis_absensi }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <input
                                                            type="time"
                                                            class="form-control mr-2"
                                                            name="waktu[]"
                                                            value="{{ $jadwal->waktu }}"
                                                            required>
                                                        <button type="button" class="btn btn-danger btn-remove-row">Hapus</button>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="jadwal-row d-flex align-items-center mb-2">
                                                    <select class="form-control mr-2" name="jenis_absensi[]" required>
                                                        @foreach ($jenis_absensi as $absensi)
                                                            <option value="{{ $absensi->id_jenis_absensi }}">{{ $absensi->nama_jenis_absensi }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="time" class="form-control mr-2" name="waktu[]" required>
                                                    <button type="button" class="btn btn-danger btn-remove-row">Hapus</button>
                                                </div>
                                            @endif
                                        </div>
                                        <button type="button" class="btn btn-primary mt-3" id="add-jadwal">Tambah Jadwal</button>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success">
                                        {{ isset($divisi) ? 'Update' : 'Simpan' }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jadwalContainer = document.getElementById('jadwal-container');
        const addJadwalButton = document.getElementById('add-jadwal');
        const jenisAbsensiData = @json($jenis_absensi);

        function createJadwalRow(selectedAbsensi = '', waktu = '') {
            const row = document.createElement('div');
            row.className = 'jadwal-row d-flex align-items-center mb-2';

            const selectOptions = jenisAbsensiData.map(absensi =>
                `<option value="${absensi.id_jenis_absensi}"
                    ${absensi.id_jenis_absensi == selectedAbsensi ? 'selected' : ''}>
                    ${absensi.nama_jenis_absensi}
                </option>`
            ).join('');

            row.innerHTML = `
                <select class="form-control mr-2" name="jenis_absensi[]" required>
                    ${selectOptions}
                </select>
                <input type="time" class="form-control mr-2" name="waktu[]" value="${waktu}" required>
                <button type="button" class="btn btn-danger btn-remove-row">Hapus</button>
            `;

            jadwalContainer.appendChild(row);
        }

        addJadwalButton.addEventListener('click', () => createJadwalRow());

        jadwalContainer.addEventListener('click', e => {
            if (e.target.classList.contains('btn-remove-row')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endpush
