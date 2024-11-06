@extends('layouts.app')

@section('title', 'Article')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>
                    Absensi karyawan

                    {{ date('d M Y') }}
                </h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>k
                    <div class="breadcrumb-item">Article</div>
                </div>
            </div>


            <div class="card">
                <div class="card-header">
                    <h4>Filter</h4>
                </div>
                <div class="card-body">
                    @include('sweetalert::alert')

                    <form id="filterForm" method="GET" action="">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
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
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">





               @foreach ($absensi as $item)

               <div class="col-12 col-md-2  col-lg-2">
                <article class="article article-style-c">
                    <div class="article-header">
                        <a href="{{ route('hrd_absensi.show', $item->id) }}">
                            <div class="article-image"
                            data-background="{{ asset('checkin_photos/'.$item->foto_checkin) }}">
                        </div>
                    </a>
                    </div>
                    <div class="article-details">
                        <div class="article-category"><a href="#">

                            <div class="bullet"></div> <a href="#">
                                {{ \Carbon\Carbon::parse($item->check_in_time)->format('H:i:s') }}
                            </a>

                        @if ($item->keterangan == 'Terlambat')
                            <span class="badge badge-danger"  data-toggle="tooltip">
                                Terlambat
                            </span>
                            @elseif ($item->keterangan == 'Tepat Waktu')
                                <span class="badge badge-succes"  data-toggle="tooltip"
                            >
                            Tepat Waktu
                            </span>
                        @endif



                        </a>

                        </div>


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
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
