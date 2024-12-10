@extends('layouts.app')

@section('title', 'Posts')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Perizinan</h1>
                {{-- <div class="section-header-button">
                    <a href="features-post-create.html"
                        class="btn btn-primary">Add New</a>
                </div> --}}
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Perizinan</a></div>
                    <div class="breadcrumb-item">Semua Perizinan</div>
                </div>
            </div>
            <div class="section-body">
                {{-- <h2 class="section-title">Posts</h2>
                <p class="section-lead">
                    You can manage all posts, such as editing, deleting and more.
                </p> --}}

                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link "
                                            href="{{ route('perizinan.index')  }}">Semua Perizinan <span class="badge badge-primary">
                                                {{ $jumlah_data}}
                                                 </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="{{ route('diterima') }}">
                                            Diterima <span class="badge badge-white">
                                                {{ $jumlah_data_diterima}}
                                            </span>
                                        </a>

                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href=" {{ route('pending') }}">Pendingg <span class="badge badge-primary">
                                                {{ $jumlah_data_pending}}

                                                </span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            href="{{ route('ditolak') }}">Ditolak <span class="badge badge-primary">
                                                {{ $jumlah_data_ditolak}}

                                                </span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Perizinan Karyawan</h4>
                            </div>
                            <div class="card-body">
                                {{-- <div class="float-left">
                                    <select class="form-control selectric">
                                        <option>Action For Selected</option>
                                        <option>Move to Draft</option>
                                        <option>Move to Pending</option>
                                        <option>Delete Pemanently</option>
                                    </select>
                                </div> --}}
                                <div class="float-right">
                                    <form method="GET" >
                                        <div class="input-group">
                                            <input name="search" type="text"
                                                class="form-control"
                                                placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>

                                            <th>Action</th>
                                            <th>Kategori perizinan</th>
                                            <th>
                                                nama karyawan
                                            </th>
                                            <th>
                                                Tanggal mulai - Tanggal selesai
                                            </th>
                                            <th>Status Perizinan</th>
                                        </tr>
                                        @foreach ($perizinan as $p)
                                        <tr>

                                            <td>
                                                {{-- {{$k->judul_Perizinan}} --}}
                                                <div class="table-links">
                                                    <a href="{{ route('perizinan.show',$p->id) }}">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="#">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#"
                                                        class="text-danger">Trash</a>
                                                </div>
                                            </td>
                                            <td>
                                               {{
                                                $p->jenis_izin
                                               }}

                                            </td>
                                            <td>
                                                <a href="#">
                                                    <img
                                                    alt="Foto Karyawan"
                                                    src="{{ asset('images/'.$p->karyawan->foto) }}"
                                                    class="rounded-circle"
                                                    width="40"
                                                    height="40"
                                                    style="object-fit: cover;"
                                                    title="Foto Karyawan">

                                                    <div class="d-inline-block ml-1">{{
                                                        $p->karyawan->nama

                                                        }}</div>
                                                </a>
                                            </td>
                                            <td>

                                                {{ \Carbon\Carbon::parse($p->tanggal_mulai)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($p->tanggal_selesai)->translatedFormat('d F Y') }}


                                            </td>
                                            <td>

                                                @if ($p->status == 'approved')
                                                    <span class="badge badge-primary">
                                                        {{
                                                            $p->status
                                                        }}
                                                    </span>
                                                    @elseif ($p->status == 'pending')
                                                    <span class="badge badge-warning">
                                                        {{
                                                            $p->status
                                                        }}
                                                    </span>
                                                    @else
                                                    <span class="badge badge-success">
                                                        {{
                                                            $p->status
                                                        }}
                                                    </span>
                                                @endif

                                                @if ($p->is_active == '1' && $p->status == 'approved')
                                                    <span class="badge badge-success"  data-toggle="tooltip"
                                                    data-title="karyawan belum mulai bekerja (perizinan masih aktif) ">
                                                        Aktif
                                                    </span>
                                                @elseif ($p->is_active == '0' && $p->status == 'approved')
                                                    <span class="badge badge-danger"  data-toggle="tooltip"
                                                    data-title="karyawan sudah mulai bekerja (perizinan sudah tidak aktif) ">
                                                        Tidak Aktif

                                                </span>
                                                @endif


                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{-- {{ $Perizinan->withQueryString()->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
