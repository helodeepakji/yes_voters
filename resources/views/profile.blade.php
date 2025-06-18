@include('layouts.main')
</head>
@include('layouts.menu')

        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

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

                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                            </div>
                            <h4 class="page-title">Profile</h4>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-4 col-lg-5">
                        <div class="card text-center">
                            <div class="card-body">
                                <img src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('assets/images/users/avatar-1.jpg') }}"
                                    class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">

                                <h4 class="mb-1 mt-2">{{ $user->name }}</h4>
                                <p class="text-muted">{{ $user->role->role_name }}</p>

                                {{-- <button type="button" class="btn btn-success btn-sm mb-2">Follow</button>
                                <button type="button" class="btn btn-danger btn-sm mb-2">Message</button> --}}

                                <div class="text-start mt-3">
                                    <h4 class="fs-13 text-uppercase">About Me :</h4>
                                    <p class="text-muted mb-3">
                                        {{ $user->bio }}
                                    </p>
                                    <p class="text-muted mb-2"><strong>Full Name :</strong> <span
                                            class="ms-2">{{ $user->name }}</span></p>

                                    <p class="text-muted mb-2"><strong>Mobile :</strong><span
                                            class="ms-2">{{ $user->phone }}</span></p>

                                    <p class="text-muted mb-2"><strong>Email :</strong> <span
                                            class="ms-2 ">{{ $user->email }}</span></p>

                                </div>
                            </div> <!-- end card-body -->
                        </div> <!-- end card -->

                    </div> <!-- end col-->

                    <div class="col-xl-8 col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills bg-nav-pills nav-justified mb-3">
                                    <li class="nav-item">
                                        <a href="#settings" data-bs-toggle="tab" aria-expanded="false"
                                            class="nav-link rounded-end rounded-0 active">
                                            Settings
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">

                                    <div class="tab-pane show active" id="settings">
                                        <form action="/editprofile/{{$user->id}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <h5 class="mb-4 text-uppercase"><i class="ri-contacts-book-2-line me-1"></i>
                                                Personal Info</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="firstname" class="form-label">Name</label>
                                                        <input type="text" class="form-control" name="name"
                                                            placeholder="Enter your name"
                                                            value="{{ $user->name }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="lastname" class="form-label">Profile</label>
                                                        <input type="file" class="form-control" name="profile"
                                                            accept="image/*">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="mb-3">
                                                        <label for="userbio" class="form-label">Bio</label>
                                                        <textarea class="form-control" id="userbio" rows="4"
                                                            placeholder="Write something..."
                                                            name="bio">{{ $user->bio }}</textarea>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="useremail" class="form-label">Email</label>
                                                        <input type="email" class="form-control" name="email"
                                                            id="useremail" placeholder="Enter email"
                                                            value="{{ $user->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="userphone" class="form-label">Phone</label>
                                                        <input type="number" class="form-control" name="phone"
                                                            id="userphone" placeholder="Enter phone"
                                                            value="{{ $user->phone }}">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i
                                                        class="ri-save-line"></i> Save</button>
                                            </div>
                                        </form>
                                        <form method="post" action="/changePassword">
                                            @csrf
                                            <h5 class="mb-3 text-uppercase bg-light p-2"><i
                                                    class="ri-building-line me-1"></i> Change Password</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">Password</label>
                                                        <input type="password" class="form-control" name="password"
                                                            placeholder="Enter New Password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="cpassword" class="form-label">Confirm
                                                            Password</label>
                                                        <input type="cpassword" class="form-control" name="cpassword"
                                                            placeholder="Enter Confirm Password">
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->

                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success mt-2"><i
                                                        class="ri-save-line"></i> Save</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end settings content-->

                                </div> <!-- end tab-content -->
                            </div> <!-- end card body -->
                        </div> <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row-->

            </div>
            <!-- container -->

        </div>
        <!-- content -->

        @include('layouts.footer')

        <!-- Profile Demo App js -->
        <script src="{{ asset('assets/js/pages/demo.profile.js') }}"></script>
        <script>
            function copyApiUrl() {
                var copyText = document.getElementById("apiUrl");
                copyText.select();
                document.execCommand("copy");
                $('#coptbtn').removeClass('btn-primary');
                $('#coptbtn').addClass('btn-warning');
            }
        </script>
</body>

</html>