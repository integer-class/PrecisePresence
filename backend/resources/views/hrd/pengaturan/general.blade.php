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
                <a href="/pengaturan" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pengaturan Divisi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="#">Pengaturan Divisi</a></div>
                <div class="breadcrumb-item">Divisi</div>
            </div>
        </div>

        <div class="section-body">

            <div id="output-status"></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Jump To</h4>
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
                    <form id="setting-form">
                        <div class="card"
                            id="settings-card">
                            <div class="card-header">
                                <h4>Manage Divisi</h4>

                            </div>
                            <div class="card-body">
                                <div class="section-header-button">
                                    <a href="{{ route('hrd.pengaturan.divisi.tambah') }}" class="btn btn-primary">Tambah Divisi</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-bordered table-md table">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Divisi</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($divisi as $d)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $d->nama_divisi }}</td>
                                            <td>{{ $d->created_at }}</td>
                                            <td>
                                                <a href="{{ route('divisi.edit',$d->id_divisi) }}" class="btn btn-primary">Edit</a>
                                                <button class="btn btn-danger"
                                                    type="button">Delete</button>
                                            </td>
                                        </tr>
                                        @endforeach


                                    </table>
                                </div>
                            </div>
                            {{-- <div class="card-footer bg-whitesmoke text-md-right">
                                    <button class="btn btn-primary"
                                        id="save-btn">Save Changes</button>
                                    <button class="btn btn-secondary"
                                        type="button">Reset</button>
                                </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/codemirror/lib/codemirror.js') }}"></script>
<script src="{{ asset('library/codemirror/mode/javascript/javascript.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-setting-detail.js') }}"></script>
@endpush
