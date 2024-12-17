@extends('layouts.app')

@section('title', 'Article')

@push('style')
<!-- CSS Libraries -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>
                Absensi karyawan {{ $tanggal }}
            </h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Absensi karyawan</div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>Filter</h4>
            </div>
            <div class="card-body">
                @include('sweetalert::alert')
                <form id="filterForm">
                    <div class="d-flex justify-content-left">
                        <!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="bulan">Bulan:</label>
                                <select class="form-control selectric" id="bulan" name="bulan">
                                    <option value="">-- Pilih Bulan --</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tahun">Tahun:</label>
                                <select class="form-control selectric" id="tahun" name="tahun">
                                    <option value="">-- Pilih Tahun --</option>
                                </select>
                            </div>
                        </div> -->
                        <input type="text" id="datepicker" placeholder="Select a date" class="form-control selectric col-4">
                        <div class="col-md-2 d-flex align-items-center">
                            <button type="button" id="filter-btn" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            @foreach ($absensi as $item)
            <div class="col-12 col-md-3 col-lg-3" data-bs-toggle="modal" data-bs-target="#absensiModal">
                <article class="article article-style-c">
                    <div class="article-header">
                        <a href="#">
                            <div class="article-image"
                                style="background-image: url('{{ asset('checkin_photos/'.$item->foto) }}');">
                            </div>
                        </a>
                    </div>
                    <div class="article-details">
                        <!-- <div class="article-category">
                            <div class="d-flex flex-column">
                                <div class="bullet"></div>
                                <a href="#">
                                    {{ \Carbon\Carbon::parse($item->waktu_absensi)->format('H:i:s') }} - {{ $item->status_absensi }}
                                </a>

                                @if ($item->status_absen == 'hadir')
                                <span class="badge badge-success" data-toggle="tooltip">
                                    Hadir
                                </span>
                                @else
                                <span class="badge badge-danger" data-toggle="tooltip">
                                    Tidak Hadir
                                </span>
                                @endif
                            </div>
                        </div> -->
                        <div class="article-user">
                            <img
                                alt="Foto Karyawan"
                                src="{{ asset('images/'.$item->karyawan->foto) }}"
                                class="rounded-circle"
                                width="40"
                                height="40"
                                style="object-fit: cover;"
                                title="Foto Karyawan">
                            <div class="article-user-details">
                                <div class="user-detail-name">
                                    <a href="#">

                                        {{ $item->karyawan->nama }}
                                    </a>
                                </div>
                                <div class="text-job">

                                    {{ $item->karyawan->divisi }}
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </section>
</div>

<!-- Absensi Modal -->
<div class="modal fade" id="absensiModal" tabindex="-1" aria-labelledby="absensiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="absensiModalLabel">Modal Title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                This is the modal body content.
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(() => {
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd', // Customize the date format
            maxDate: '+0D', // Prevent selecting next dates
        });

        $('#filter-btn').click(() => {
            const baseURL = `${window.location.origin}${window.location.pathname}` // Get the base URL
            const datePicker = $('#datepicker').val()
            const newURL = `${baseURL}/tanggal/${datePicker}`
            window.location.href = newURL // Redirect to the new URL
        })
    })
</script>

<!-- Page Specific JS File -->
@endpush