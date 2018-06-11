<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <title>Martineez</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand logo-nav" href="{{url('/')}}">Martineez</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
               <span class="navbar-nav mr-auto mt-2 mt-lg-0">
               </span>

            {{--FORMA LOGIN--}}
            <form class="form-inline my-2 my-lg-0" id="loginForm" action="{{url('/')."/login"}}" method="post">
                {{csrf_field()}}
                <label for="tbUsername"></label>
                <input class="form-control mr-sm-2 mt-2 mt-lg-0" type="text" placeholder="Username" name="tbMail" id="tbMail">
                <label for="tbPassword"></label>
                <input class="form-control mr-sm-2 mt-2 mt-lg-0" type="password" placeholder="Password" name="tbPassword" id="tbPassword">
                <button class="btn btn-primary mt-2 mt-lg-0" type="submit">Login</button>
            </form>
            {{--END LOGIN FORM--}}

        </div>
    </div>
</nav>

<div class="container">
    <div class="col-md-6 offset-md-3">
        <!-- form card register -->
        <div class="card card-outline-secondary mt-5">
            <div class="card-header">
                <h3 id="logo">Get Started it's free</h3>
                <p>Make your account</p>
            </div>


            <div class="card-block">
                <form class="form register-form" id="register-form" action="{{url('/')."/registerUser"}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">account_circle</i></span>
                            </div>
                            <input type="text"  name="tbFirstname" class="form-control" placeholder="Firstname">
                        </div>
                        <div id="firstname"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">account_circle</i></span>
                            </div>
                            <input type="text" class="form-control" placeholder="Lastname" name="tbLastname">
                        </div>
                        <div id="lastname"></div>
                    </div>

                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">email</i></span>
                            </div>
                            <label for="tbMail"></label>
                            <input type="email" class="form-control" placeholder="Email" name="tbMail">
                        </div>
                        <div id="mail"></div>
                        @if (session('msg'))
                            <div class="alert alert-danger">
                                {{ session('msg') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">lock</i></span>
                            </div>
                            <label for="tbPassword"></label>
                            <input type="password" class="form-control" placeholder="Password" name="tbPassword">
                        </div>
                        <div id="password"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">restaurant_menu</i></span>
                            </div>
                            <label for="tbWorkplace"></label>
                            <input type="text" class="form-control" placeholder="Workplace" name="tbWorkplace">
                        </div>
                        <div id="workplace"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">local_bar</i></span>
                            </div>
                            <label for="tbPosition"></label>
                            <input type="text" class="form-control" placeholder="Position" name="tbPosition">
                        </div>
                        <div id="position"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="btnRegister">Register</button>
                    </div>
                </form>
                <p class="ml-3">Already have an account?<a href="{{url('/')."/showLog"}}"> Sign in here!</a></p>
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
        </div>
        <!-- /form card register -->
    </div>
</div>
@include('components.footer')
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/jquery-validation.js')}}"></script>
<script src="{{asset('js/regform-validate.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>