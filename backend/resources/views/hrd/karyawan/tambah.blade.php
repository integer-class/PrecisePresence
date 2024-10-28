@extends('layouts.app')

@section('title', 'Advanced Forms')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Karyawan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Data</a></div>
                    <div class="breadcrumb-item"><a href="#">Karyawan</a></div>
                    <div class="breadcrumb-item">Tambah Karyawan</div>
                </div>
            </div>

            @include('sweetalert::alert')
            <div class="section-body">
                {{-- <h2 class="section">

                    <a style="width:130px; height:38px; margin-bottom:20px" href="" class="btn btn-lg btn-primary">Kembali</a>


                </h2> --}}




                <div class="card">
                    <div class="row mt-4">
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <div class="wizard-steps">
                                <div class="wizard-step wizard-step-active">
                                    <div class="wizard-step-icon">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Tambahkan Karyawan
                                    </div>
                                </div>
                                <div class="wizard-step">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Upload Dataset foto
                                    </div>
                                </div>
                                <div class="wizard-step">
                                    <div class="wizard-step-icon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <div class="wizard-step-label">
                                        Validasi Server
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('hrd_karyawan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h4>Form</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Nama Lengkap -->
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Jenis kelamin </label>
                                        <select class="form-control" name="jenis_kelamin" required>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Divisi -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Divisi</label>
                                        <select class="form-control" name="kategori" required>
                                            <option value="Keuangan">Keuangan</option>
                                            <option value="Pemasaran">Pemasaran</option>
                                            <option value="Sumber Daya Manusia">Sumber Daya Manusia</option>
                                            <option value="Teknologi Informasi">Teknologi Informasi</option>
                                            <option value="Produksi">Produksi</option>
                                            <option value="Pengadaan">Pengadaan</option>
                                            <option value="Penjualan">Penjualan</option>
                                            <option value="Hukum">Hukum</option>
                                            <option value="Operasional">Operasional</option>
                                            <option value="Keamanan">Keamanan</option>
                                            <option value="Penelitian dan Pengembangan">Penelitian dan Pengembangan</option>
                                            <option value="Pelanggan">Layanan Pelanggan</option>
                                        </select>
                                    </div>

                                </div>

                                <!-- Email -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                </div>

                                <!-- Nomor Hp -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nomor Hp</label>
                                        <input type="tel" class="form-control" name="no_hp" required>
                                    </div>
                                </div>

                                <!-- Foto dengan Preview -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Foto PAS</label>
                                        <input type="file" class="form-control" name="foto" required onchange="previewImage(event)">
                                        <img id="imagePreview" style="margin-top: 10px; max-width: 100%; max-height: 150px; display: none;">
                                    </div>
                                </div>

                                <!-- Keterangan -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <textarea style="height: 150px" class="form-control" name="alamat" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="card-footer text-right">
                            <button class="btn btn-primary">Next</button>
                        </div>
                    </form>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.style.display = 'block';
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.onload = () => URL.revokeObjectURL(imagePreview.src); // release memory
    }
    </script>

@endpush
