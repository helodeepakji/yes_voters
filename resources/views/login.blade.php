@include('layouts.main')

    <div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5 position-relative" style="height: 100vh">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-4 col-lg-5">
                    <div class="card">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Logo -->
                        <div class="card-header py-4 text-center" >
                            <a href="/">
                                <span><img src="assets/images/logo-dark.png" width="200px" alt="logo" height="auto"></span>
                            </a>
                        </div>

                        <div class="card-body p-4" style="rgb(244 245 249)">

                            <div class="text-center w-75 m-auto">
                                <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                                <p class="text-muted mb-4">Enter your email address and password to access admin panel.
                                </p>
                            </div>

                            <form action="/login" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="email_or_phone" class="form-label">Email or Phone no.</label>
                                    <input class="form-control" type="text" id="email_or_phone" required=""
                                        placeholder="Enter your email or phone no." name="email_or_phone" value="{{old('email_or_phone') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control"
                                            placeholder="Enter your password" name="password">
                                        <div class="input-group-text" data-password="false">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                        <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                    </div>
                                </div>

                                <div class="mb-3 mb-0 text-center">
                                    <button class="btn btn-primary" type="submit"> Log In </button>
                                </div>

                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
    {{-- @include('layouts.footer') --}}
    <script src="{{ asset('assets/js/vendor.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/notify.js') }}"></script>
    <script src="{{ asset('assets/vendor/flatpickr/flatpickr.min.js')}}"></script>

</body>

</html>