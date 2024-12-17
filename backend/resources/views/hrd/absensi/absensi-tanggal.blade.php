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
            <div class="col-12 col-md-3 col-lg-3" data-bs-toggle="modal" data-bs-target="#absensiModal{{ $item->id_karyawan }}">
                <article class="article article-style-c">
                    <div class="article-header">
                        <a href="#">
                            <div class="article-image"
                                style="background-image: url('{{ asset('checkin_photos/'.$item->foto) }}');">
                            </div>
                        </a>
                    </div>
                    <div class="article-details">
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

@foreach ($absensi as $item)
<!-- Absensi Modal -->
<div class="modal fade" id="absensiModal{{ $item->id_karyawan }}" tabindex="-1" aria-labelledby="absensiModal{{ $item->id_karyawan }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="absensiModal{{ $item->id_karyawan }}Label">List Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="max-height: 500px; overflow-y: auto;">
                <div class="d-flex flex-wrap gap-3">
                    @foreach($item->list_absensi as $item_list)
                    <article class="article article-style-c" style="flex: 1 1 calc(33.33% - 1rem); min-width: 200px;">
                        <div class="article-header">
                            <a href="{{ route('hrd_absensi.show', $item_list->id) }}">
                                <div class="article-image"
                                    style="background-image: url('{{ asset('checkin_photos/'.$item_list->foto) }}'); height: 150px; background-size: cover; background-position: center;">
                                </div>
                            </a>
                        </div>
                        <div class="article-details">
                            <div class="article-category">
                                <div class="d-flex flex-column">
                                    <a href="{{ route('hrd_absensi.show', $item_list->id) }}">
                                        {{ \Carbon\Carbon::parse($item_list->waktu_absensi)->format('H:i:s') }} - {{ $item_list->status_absensi }}
                                    </a>
                                    @if ($item_list->status_absen == 'hadir')
                                    <span class="badge badge-success" data-toggle="tooltip">Hadir</span>
                                    @else
                                    <span class="badge badge-danger" data-toggle="tooltip">Tidak Hadir</span>
                                    @endif
                                </div>
                            </div>
                            <div class="article-user">
                                <img
                                    alt="Foto Karyawan"
                                    src="{{ asset('images/'.$item_list->karyawan->foto) }}"
                                    class="rounded-circle"
                                    width="40"
                                    height="40"
                                    style="object-fit: cover;"
                                    title="Foto Karyawan">
                                <div class="article-user-details">
                                    <div class="user-detail-name">
                                        <a href="{{ route('hrd_absensi.show', $item_list->id) }}">
                                            {{ $item_list->karyawan->nama }}
                                        </a>
                                    </div>
                                    <div class="text-job">
                                        {{ $item_list->karyawan->divisi }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

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
            const baseURL = `${window.location.origin}${window.location.pathname.slice(0, window.location.pathname.lastIndexOf('/'))}` // Get the base URL
            const datePicker = $('#datepicker').val()
            const newURL = `${baseURL}/${datePicker}`
            window.location.href = newURL // Redirect to the new URL
        })
    })
</script>

<!-- Page Specific JS File -->
@endpush