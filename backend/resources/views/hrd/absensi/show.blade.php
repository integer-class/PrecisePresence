@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Hi, Ujang!</h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image"
                                    src="{{ asset('img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Posts</div>
                                        <div class="profile-widget-item-value">187</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Followers</div>
                                        <div class="profile-widget-item-value">6,8K</div>
                                    </div>
                                    <div class="profile-widget-item">
                                        <div class="profile-widget-item-label">Following</div>
                                        <div class="profile-widget-item-value">2,1K</div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">Ujang Maman <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div> Web Developer
                                    </div>
                                </div>
                                Ujang maman is a superhero name in <b>Indonesia</b>, especially in my family. He is not a
                                fictional character but an original hero in my family, a hero for his children and for his
                                wife. So, I use the name as a user in this template. Not a tribute, I'm just bored with
                                <b>'John Doe'</b>.
                            </div>
                            <div class="card-footer text-center">
                                <div class="font-weight-bold mb-2">Follow Ujang On</div>
                                <a href="#"
                                    class="btn btn-social-icon btn-facebook mr-1">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="#"
                                    class="btn btn-social-icon btn-twitter mr-1">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="btn btn-social-icon btn-github mr-1">
                                    <i class="fab fa-github"></i>
                                </a>
                                <a href="#"
                                    class="btn btn-social-icon btn-instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Default Tab</h4>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-tabs"
                                    id="myTab"
                                    role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active"
                                            id="home-tab"
                                            data-toggle="tab"
                                            href="#home"
                                            role="tab"
                                            aria-controls="home"
                                            aria-selected="true">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link"
                                            id="profile-tab"
                                            data-toggle="tab"
                                            href="#profile"
                                            role="tab"
                                            aria-controls="profile"
                                            aria-selected="false">Profile</a>
                                    </li>

                                </ul>
                                <div class="tab-content"
                                    id="myTabContent">
                                    <div class="tab-pane fade show active"
                                        id="home"
                                        role="tabpanel"
                                        aria-labelledby="home-tab">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                        proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                                    </div>
                                    <div class="tab-pane fade"
                                        id="profile"
                                        role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        Sed sed metus vel lacus hendrerit tempus. Sed efficitur velit tortor, ac efficitur
                                        est lobortis quis. Nullam lacinia metus erat, sed fermentum justo rutrum ultrices.
                                        Proin quis iaculis tellus. Etiam ac vehicula eros, pharetra consectetur dui. Aliquam
                                        convallis neque eget tellus efficitur, eget maximus massa imperdiet. Morbi a mattis
                                        velit. Donec hendrerit venenatis justo, eget scelerisque tellus pharetra a.
                                    </div>
                                    <div class="tab-pane fade"
                                        id="contact"
                                        role="tabpanel"
                                        aria-labelledby="contact-tab">
                                        Vestibulum imperdiet odio sed neque ultricies, ut dapibus mi maximus. Proin ligula
                                        massa, gravida in lacinia efficitur, hendrerit eget mauris. Pellentesque fermentum,
                                        sem interdum molestie finibus, nulla diam varius leo, nec varius lectus elit id
                                        dolor. Nam malesuada orci non ornare vulputate. Ut ut sollicitudin magna. Vestibulum
                                        eget ligula ut ipsum venenatis ultrices. Proin bibendum bibendum augue ut luctus.
                                    </div>
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
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
