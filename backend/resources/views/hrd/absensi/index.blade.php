@extends('layouts.app')

@section('title', 'Article')

@push('style')
    <!-- CSS Libraries -->
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Article</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Components</a></div>
                    <div class="breadcrumb-item">Article</div>
                </div>
            </div>

            <h2 class="section-title">Article Style C</h2>
            <div class="row">
                <div class="col-12 col-md-2 col-lg-2">
                    <article class="article article-style-c">
                        <div class="article-header">
                            <div class="article-image"
                                data-background="{{ asset('img/news/img14.jpg') }}">
                            </div>
                        </div>
                        <div class="article-details">
                            <div class="article-category"><a href="#">News</a>
                                <div class="bullet"></div> <a href="#">5 Days</a>
                            </div>
                            <div class="article-title">
                                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
                            </div>
                            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                cillum dolore eu fugiat nulla pariatur. </p>
                            <div class="article-user">
                                <img alt="image"
                                    src="{{ asset('img/avatar/avatar-3.png') }}">
                                <div class="article-user-details">
                                    <div class="user-detail-name">
                                        <a href="#">Rizal Fakhri</a>
                                    </div>
                                    <div class="text-job">UX Designer</div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
