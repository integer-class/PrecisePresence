@extends('layouts.app')

@section('title', 'Settings')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="javascript:void(0);" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Settings</h1>
            <div class="section-header-button">
                <a href="{{ route('hrd.pengaturan.cabang.tambah') }}" class="btn btn-primary">Tambah Cabang</a>
            </div>

            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Settings</div>

            </div>
        </div>

        <div class="section-body">
            <div class="row">

                @foreach ($cabang as $c)
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                    <article class="article">
                        <div class="article-header">
                            <div class="article-image"
                                style="background-image: url('{{ asset($c->foto_cabang) }}');">
                            </div>

                            <div class="article-title">
                                <h2><a href="#">
                                        {{ $c->nama_cabang }}
                                    </a></h2>
                            </div>
                        </div>
                        <div class="article-details">
                            <p>
                                {{ $c->alamat_cabang }}
                            </p>
                            <div class="article-cta">
                                <a href="{{ route('hrd.pengaturan.cabang.detail', $c->id_cabang) }}"
                                    class="btn btn-primary">Read More</a>
                            </div>
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