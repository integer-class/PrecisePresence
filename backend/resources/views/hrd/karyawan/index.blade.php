@extends('layouts.app')

@section('title', 'Article')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="/hrd_karyawan" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>List Karyawan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Karyawan</a></div>
                <div class="breadcrumb-item">List Karyawan</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                @foreach ($karyawan as $k)
                <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                    <article class="article article-style-b">
                        <div style="height: 250px" class="article-header">
                            <div class="article-image"
                                style="background-image: url('{{ asset('images/'.$k->foto) }}');">
                            </div>
                            <div class="article-badge">
                                <div class="article-badge-item bg-danger">
                                    {{-- <i class="fas fa-fire"></i>  --}}
                                    {{ $k->divisi }}
                                </div>
                            </div>
                        </div>
                        <div class="article-details d-flex flex-column" style="min-height: 129px;">
                            <div class="article-title">
                                <h2><a href="#" style="overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; line-clamp: 2; -webkit-box-orient: vertical;">
                                        {{$k->nama}}
                                    </a>
                                </h2>
                            </div>
                            {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. </p> --}}
                            <d class="d-flex mt-auto justify-content-between">
                                <div class="article-cta">
                                    <a href="{{ route('karyawan.destroy',$k->id_karyawan) }}">Hapus</i></a>
                                </div>
                                <div class="article-cta">
                                    <a href="{{ route('detailkaryawan',$k->id_karyawan) }}">Profile <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </d>
                            {{-- {{ route('penduduk.arsip', $p->nik) }} --}}
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->

<!-- Page Specific JS File -->
@endpush