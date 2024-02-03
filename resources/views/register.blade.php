<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Book | Register</title>
    <link href="img/logo/logo.png" rel="icon">
    <!-- CSS -->
    <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/css/ruang-admin.min.css') }}" rel="stylesheet">
</head>

<body class="bg-gradient-login">

    <!-- Register Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Register</h1>
                                    </div>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif


                                    @if (session('status'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif

                                    <form action="" method="post">
                                        @csrf
                                        <form>
                                            {{-- <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="fname" class="form-control"
                                                id="exampleInputFirstName" placeholder="Enter First Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="lname" class="form-control"
                                                id="exampleInputLastName" placeholder="Enter Last Name">
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Enter Email Address">
                                        </div> --}}
                                            <div class="form-group">
                                                <label>Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="username" placeholder="Enter Username">
                                            </div>
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="password" placeholder="Password">
                                            </div>
                                            <div class="form-group">
                                                <label>No Phone</label>
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                    placeholder="Enter No Phone">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" class="form-control" id="address" placeholder="Enter Address"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit"
                                                    class="btn btn-primary btn-block">Register</button>
                                            </div>
                                            <hr>
                                            <a href="#" class="btn btn-google btn-block">
                                                <i class="fab fa-google fa-fw"></i> Register with Google
                                            </a>
                                            <a href="#" class="btn btn-facebook btn-block">
                                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                            </a>
                                        </form>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="font-weight-bold small" href="login">Already have an account?</a>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- JS -->
    <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('template/js/ruang-admin.min.js') }}"></script>

    <!-- CKeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#address'))
            .catch(error => {
                console.error(error);
            });
    </script>


</body>

</html>
