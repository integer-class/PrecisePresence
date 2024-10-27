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

            <div class="section-body">
                <h2 class="section-title">Articles</h2>
                <p class="section-lead">This article component is based on card and flexbox.</p>


                <div class="row">

                    @foreach ($karyawan as $k)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-2">
                        <article class="article article-style-b">
                            <div style="height: 250px" class="article-header">
                                <div class="article-image"
                                    data-background="https://ameltrias.com/wp-content/uploads/2021/07/p-Jasa-Pas-Foto-Malang-Ameltrias-P-Ameltrias.jpg">
                                </div>
                                <div class="article-badge">
                                    <div class="article-badge-item bg-danger">
                                        {{-- <i class="fas fa-fire"></i>  --}}

                                        Akuntan</div>
                                </div>
                            </div>
                            <div class="article-details">
                                <div class="article-title">
                                    <h2><a href="#">Andi stutisno suyilno subandi</a></h2>
                                </div>
                                {{-- <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. </p> --}}
                                <div class="article-cta">
                                    <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
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
