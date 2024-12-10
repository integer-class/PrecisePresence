@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">

        <div class="section">
            <div class="section-header">
                <h1>
                    {{-- {{ $penduduk->nama }} --}}
                </h1>
                <div class="section-header-button">
                    {{-- <a href="{{ route('category.create') }}" class="btn btn-primary">Add New</a> --}}
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Data</a></div>
                    <div class="breadcrumb-item">Detail Penduduk</div>
                </div>
            </div>



            <div class="section-body">
                <a style="width:130px; height:38px; margin-bottom:50px" href="{{ route('hrd_karyawan.index') }}"
                    class="btn btn-lg btn-primary">Kembali</a>

                <div class="">
                    <div class="row">
                        <!-- Kolom Kiri -->
                        <div class="col-md-3">
                            <div class="">
                                <img style="border-radius:50px;" src="{{ asset('images/' . $karyawan->foto) }}"
                                    alt="profile" class="img-fluid">
                            </div>
                            <div class="" style="margin-top: 20px;">
                                <div style="border-radius: 100px; border: 2px solid blue; height: 55px; padding: 10px; text-align: center; overflow: visible;"
                                    class="card">
                                    <div class="card-body" style="margin: 0;">
                                        <h4 style="margin: -10px; white-space: nowrap; text-overflow: ellipsis;">
                                            {{ $karyawan->nama }}
                                        </h4>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <h4>Divisi</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <span class="btn btn-primary btn-lg btn-block">
                                                {{ $karyawan->nama_divisi }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Kolom Tengah -->
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <i class="far fa-user"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>
                                                    Total Perizinan

                                                </h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $jumlah_izin }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <i class="fas fa-circle"></i>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Total Presensi</h4>
                                            </div>
                                            <div class="card-body">
                                                {{ $jumlah_absen }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <card class="card-header">
                                    <h4>Detail Perzinan</h4>
                                </card>

                                <div class="card-body">


                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-4 col-form-label">Jenis Perizinan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="jenis_kelamin"
                                                value="{{$perizinan->jenis_izin}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="jenis_kelamin"
                                                value="{{$perizinan->tanggal_mulai}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="jenis_kelamin" class="col-sm-4 col-form-label">Tanggal Berakhir</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="jenis_kelamin"
                                                value="{{$perizinan->tanggal_selesai}}" readonly>
                                        </div>
                                    </div>


                                    <div class="row mb-3">
                                        <label for="dokumen_pendukung" class="col-sm-4 col-form-label">Dokumen Pendukung</label>
                                        <div class="col-sm-8">
                                            @if($perizinan->dokumen_pendukung)
                                                @php
                                                    $fileExtension = pathinfo($perizinan->dokumen_pendukung, PATHINFO_EXTENSION);
                                                @endphp

                                                @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                                                    <img src="{{ asset($perizinan->dokumen_pendukung) }}" alt="Dokumen Pendukung" class="img-fluid">
                                                @elseif(in_array($fileExtension, ['pdf']))
                                                    <embed src="{{ asset($perizinan->dokumen_pendukung) }}" type="application/pdf" width="100%" height="400px">
                                                @elseif(in_array($fileExtension, ['doc', 'docx']))
                                                    <a href="{{ asset($perizinan->dokumen_pendukung) }}" target="_blank">Lihat Dokumen Word</a>
                                                @else
                                                    <p>Format dokumen tidak didukung untuk ditampilkan.</p>
                                                @endif
                                            @else
                                                <p>Tidak ada dokumen pendukung.</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
















                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Status Perizinan</h4>
                                </div>

                                @if ($perizinan->status == 'aproved')
                                <div class="card-body">
                                    <span class="btn btn-primary btn-lg btn-block">Aproved</span>
                                </div>
                                @elseif($perizinan->status == 'pending')
                                <div class="card-body">
                                    <span class="btn btn-info btn-lg btn-block">Pending</span>
                                </div>
                                @else
                                <div class="card-body">
                                    <span class="btn btn-danger btn-lg btn-block">Rejected</span>
                                @endif


                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>Aktivitas Terakhir</h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">
                                        @foreach ($aktivitas as $a)
                                            <li class="media">
                                                <img alt="image" class="rounded-circle mr-3"
                                                    style="border-radius: 50%; width: 50px; height: 50px; object-fit: cover;"
                                                    src="{{ asset('images/' . $karyawan->foto) }}">
                                                <div class="media-body">
                                                    <div class="font-weight-bold mt-0 mb-1">
                                                        <a style="color: black" href="">{{ $a->jenis }}</a>
                                                    </div>
                                                    <p>{{ $a->nama }} melakukan {{ $a->jenis }}:
                                                        {{ $a->aktivitas }}</p>
                                                    <p class="text-muted">{{ $a->tanggal }}</p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>

                @endsection

                @push('scripts')
                    <!-- JS Libraies -->
                    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

                    <!-- Page Specific JS File -->
                @endpush
