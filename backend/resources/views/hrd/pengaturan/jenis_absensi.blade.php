@extends('layouts.app')

@section('title', 'Modal')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/prismjs/themes/prism.min.css') }}">
@endpush


@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <div class="section-header-back">
                    <a href="/pengaturan" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
                </div>
                <h1>Pengaturan Divisi</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="#">Pengaturan</a></div>
                    <div class="breadcrumb-item">Jenis Absensi</div>
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
                                            class="nav-link ">Divisi</a></li>
                                    <li class="nav-item"><a href="{{ route('hrd.pengaturan.jenis_absensi') }}"
                                            class="nav-link active">Jenis absensi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form id="setting-form">
                            <div class="card" id="settings-card">
                                <div class="card-header">
                                    <h4>Manage Jenis Absensi</h4>

                                </div>
                                <div class="card-body">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Tambah Jenis Absensi
                                    </button>
                                    <div class="table-responsive">
                                        <table class="table-bordered table-md table">
                                            <tr>
                                                <th>#</th>
                                                <th>Jenis Absensi</th>
                                                <th>Aturan Waktu</th>

                                            </tr>
                                            @foreach ($jenis_absensi as $j)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $j->nama_jenis_absensi }}</td>
                                                    <td>
                                                        {{
                                                            $j->aturan_waktu == '<' ? 'Lebih Awal Baik' :
                                                            ($j->aturan_waktu == '>' ? 'Lebih Akhir Baik' :
                                                            ($j->aturan_waktu == '=' ? 'Harus Tepat Waktu' :
                                                            ($j->aturan_waktu == '=>' ? 'Lebih Akhir atau Tepat Baik' :
                                                            ($j->aturan_waktu == '<=' ? 'Lebih Awal atau Tepat Baik' : ''))))
                                                        }}
                                                    </td>


                                                </tr>
                                            @endforeach


                                        </table>
                                    </div>
                                </div>



                            </div>

                        </form>
                    </div>
                </div>
            </div>


        </section>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Absensi</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Input Jenis Absensi -->
                        <form action="{{ route('hrd.pengaturan.jenis_absensi.tambahjenis') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="nama_jenis_absensi">Nama Jenis Absensi</label>
                                <input type="text" name="nama_jenis_absensi" id="nama_jenis_absensi" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="aturan_waktu">Aturan Waktu</label>
                                <select name="aturan_waktu" id="aturan_waktu" class="form-control" required>
                                    <option value="<">Lebih Awal Baik</option>
                                    <option value=">">Lebih Akhir Baik</option>
                                    <option value="=">Harus Tepat Waktu</option>
                                    <option value="=>">Lebih Akhir atau Tepat Baik</option>
                                    <option value="<=">Lebih Awal atau Tepat Baik</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
                </div>
            </div>
        </div>


    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/prismjs/prism.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/bootstrap-modal.js') }}"></script>
@endpush
