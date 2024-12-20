@extends('layouts.app')

@section('title', 'General Settings')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/codemirror/lib/codemirror.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/codemirror/theme/duotone-dark.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="features-settings.html" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah Divisi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Settings</a></div>
                    <div class="breadcrumb-item">Tambah Divisi</div>
                </div>
            </div>

            <div class="section-body">


                <div id="output-status"></div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pengaturan Divisi</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item"><a href="{{ route('hrd.pengaturan.general') }}"
                                            class="nav-link active">Divisi</a></li>
                                    <li class="nav-item"><a href="{{ route('hrd.pengaturan.jenis_absensi') }}"
                                            class="nav-link">Jenis absensi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <!-- Form untuk menyimpan data -->
                        <form action="{{ route('divisi.simpan') }}" method="POST" id="setting-form">
                            @csrf
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>Buat Divisi</h4>
                                </div>
                                <div class="card-body">
                                    <!-- Form Nama Divisi -->
                                    <div class="form-group">
                                        <label for="nama_divisi">Nama Divisi</label>
                                        <input type="text" class="form-control" id="nama_divisi" name="nama_divisi" placeholder="Masukkan nama divisi" required>
                                    </div>

                                    <!-- Section Jadwal -->
                                    <div class="form-group">
                                        <label for="jadwal">Jadwal</label>
                                        <div id="jadwal-container">
                                            <!-- Template Jadwal -->
                                            <div class="jadwal-row d-flex align-items-center mb-2">
                                                <select class="form-control mr-2" name="jenis_absensi[]" required>
                                                    @foreach ($jenis_absensi as $absensi)
                                                        <option value="{{ $absensi->id_jenis_absensi }}">{{ $absensi->nama_jenis_absensi }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="time" class="form-control mr-2" name="waktu[]" required>
                                                <button type="button" class="btn btn-danger btn-remove-row">Hapus</button>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-primary mt-3" id="add-jadwal">Tambah Jadwal</button>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-success">Simpan</button>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data jenis absensi yang diambil dari controller dan diteruskan ke view
        const jenisAbsensiData = @json($jenis_absensi);

        // Referensi elemen container untuk jadwal dan tombol tambah jadwal
        const jadwalContainer = document.getElementById('jadwal-container');
        const addJadwalButton = document.getElementById('add-jadwal');

        // Fungsi untuk membuat baris jadwal baru
        function createJadwalRow() {
            // Buat elemen div untuk baris jadwal
            const row = document.createElement('div');
            row.className = 'jadwal-row d-flex align-items-center mb-2';

            // Buat dropdown jenis absensi
            let selectOptions = '';
            jenisAbsensiData.forEach(absensi => {
                selectOptions += `<option value="${absensi.id_jenis_absensi}">${absensi.nama_jenis_absensi}</option>`;
            });

            // Tambahkan elemen ke dalam baris
            row.innerHTML = `
                <select class="form-control mr-2" name="jenis_absensi[]" required>
                    ${selectOptions}
                </select>
                <input type="time" class="form-control mr-2" name="waktu[]" required>
                <button type="button" class="btn btn-danger btn-remove-row">Hapus</button>
            `;

            // Tambahkan baris ke dalam container jadwal
            jadwalContainer.appendChild(row);
        }

        // Event listener untuk tombol "Tambah Jadwal"
        addJadwalButton.addEventListener('click', function () {
            createJadwalRow();
        });

        // Event listener untuk tombol "Hapus" pada setiap baris jadwal
        jadwalContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-remove-row')) {
                e.target.parentElement.remove();
            }
        });

        // Menampilkan SweetAlert setelah form berhasil disubmit
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Divisi Berhasil Ditambahkan',
                text: '{{ session('success') }}',  // Menampilkan pesan sukses dari session
                showConfirmButton: true
            });
        @endif
    });
</script>
@endpush
