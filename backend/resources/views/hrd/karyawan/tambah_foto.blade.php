@extends('layouts.app')

@section('title', 'Multiple Upload')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/dropzone/dist/dropzone.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">
    <style type="text/css">
        .dz-preview .dz-image img {
            width: 100% !important;
            height: 100% !important;
            object-fit: cover;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="{{ route('hrd_karyawan.index') }}" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Tambah foto Dataset</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Karywan</a></div>
                    <div class="breadcrumb-item">Tambah Foto</div>
                </div>
            </div>

            <div class="section-body">

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Maximal upload foto 50MB</h4>
                            </div>
                            <div class="card-body">
                                <form style="margin-bottom: 20px" action="{{ route('upload.files') }}" method="post" enctype="multipart/form-data" class="dropzone">
                                    @csrf
                                    <input type="hidden" value="{{ $karyawan->id_karyawan }}" name="user_id">
                                </form>
                                <button id="uploadFile" class="btn btn-success mt-1">Upload Images</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/page/components-multiple-upload.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone(".dropzone", {
            init: function() {
                myDropzone = this;
            },
            autoProcessQueue: false,
            paramName: "files",
            uploadMultiple: true,
            maxFilesize: 50, // Mengubah batas ukuran file menjadi 50MB
            acceptedFiles: ".jpeg,.jpg,.png,.gif",
            addRemoveLinks: false,
            dictFileTooBig: "Ukuran file terlalu besar (maksimal 50MB).",
            dictInvalidFileType: "Hanya file dengan ekstensi .jpeg, .jpg, .png, .gif yang diterima.",
        });

        $('#uploadFile').click(function() {
            // Mengecek jika ada file yang melebihi batas ukuran
            if (myDropzone.getAcceptedFiles().length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tidak ada file yang valid untuk diupload.'
                });
            } else {
                myDropzone.processQueue();
            }
        });

        myDropzone.on("success", function(file, response) {
            if (Array.isArray(response.responses)) {
                response.responses.forEach(function(item) {
                    if (item.message === "Embedding saved successfully") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: `File: ${item.filename} - ${item.message}`
                        });
                    } else if (item.message === "No face detected with sufficient confidence.") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Warning',
                            text: `File: ${item.filename} - ${item.message}`
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: `File: ${item.filename} - ${item.message}`
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Unexpected response format.'
                });
            }
        });
    </script>
@endpush
