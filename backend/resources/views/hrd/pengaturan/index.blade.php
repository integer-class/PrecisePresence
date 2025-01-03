@extends('layouts.app')

@section('title', 'Settings')

@push('style')
<!-- CSS Libraries -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="javascript:void(0);" onclick="history.back();" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Pengaturan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Pengaturan</div>
            </div>
        </div>

        <div class="section-body">
            <!-- <h2 class="section-title">Overview</h2>
            <p class="section-lead">
                Organize and adjust all settings about this site.
            </p> -->

            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-large-icons">
                        <div class="card-icon bg-primary text-white">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div class="card-body">
                            <h4>Divisi</h4>
                            <!-- <p>General settings such as, site title, site description, address and so on.</p> -->
                            <a href="{{ route('hrd.pengaturan.general') }}"
                                class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-large-icons">
                        <div class="card-icon bg-primary text-white">
                            <i class="fas fa-search"></i>
                        </div>
                        <div class="card-body">
                            <h4>Cabang</h4>
                            <!-- <p>Search engine optimization settings, such as meta tags and social media.</p> -->
                            <a href="{{ route('hrd.pengaturan.cabang') }}"
                                class="card-cta">Change Setting <i class="fas fa-chevron-right"></i></a>
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

<!-- Page Specific JS File -->
@endpush