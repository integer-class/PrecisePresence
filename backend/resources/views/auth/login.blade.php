<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="./../../library/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="./../../library/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="./../../css/style.css">
    <link rel="stylesheet" href="./../../css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <!-- Footer -->
                        <div class="login-brand">
                            <img src="{{ asset('img/logo.png') }}" alt="logo" width="200" class="img-responsive">
                        </div>

                        <!-- Content -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                @if (session('status'))
                                <div class="mb-4 text-sm text-green-600">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <form method="POST"
                                    action="{{ route('login') }}"
                                    class="needs-validation"
                                    novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email"
                                            type="email"
                                            class="form-control"
                                            name="email"
                                            tabindex="1"
                                            required
                                            autofocus>
                                        @error('email')
                                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password"
                                                class="control-label">Password</label>

                                        </div>
                                        <input id="password"
                                            type="password"
                                            class="form-control"
                                            name="password"
                                            tabindex="2"
                                            required>
                                        @error('password')
                                        <span class="text-red-500 text-sm mt-2">{{ $message }}</span>
                                        @enderror
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg btn-block"
                                            tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>


                            </div>
                        </div>


                        <!-- Footer -->
                        <div class="simple-footer">
                            Copyright &copy; Stisla {{ Carbon\Carbon::now()->year }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="./../../library/jquery/dist/jquery.min.js"></script>
    <script src="./../../library/popper.js/dist/umd/popper.js"></script>
    <script src="./../../library/tooltip.js/dist/umd/tooltip.js"></script>
    <script src="./../../library/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./../../library/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
    <script src="./../../library/moment/min/moment.min.js"></script>
    <script src="./../../js/stisla.js"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="./../../js/scripts.js"></script>
    <script src="./../../js/custom.js"></script>
</body>



</html>