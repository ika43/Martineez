<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <title>Martineez - Login</title>

</head>
<body>
    <div class='wrapper'>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand logo-nav" href="{{url('/')}}">Martineez</a>
    </div>
</nav>


<div  id="form-login" class="container">

    <div class="col-md-6 offset-md-3">
        @if(isset($msg))
            <div class="alert alert-danger">
                {{$msg}}
            </div>
            @endif
        <!-- form card register -->
        <div class="card card-outline-secondary mt-5">
            <div class="card-header">
                <p>Sign in to your account</p>
            </div>



            <div class="card-block">
                <form class="form" id="log-form" action="{{url('/')."/login"}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">email</i></span>
                            </div>
                            <input type="text"  name="tbMail" class="form-control" placeholder="Email" autofocus>
                        </div>
                        <div id="mail"></div>
                    </div>
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="material-icons">lock</i></span>
                            </div>
                            <input type="password" class="form-control" placeholder="Password" name="tbPassword">
                        </div>
                        <div id="password"></div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" name="btnRegister">Sign in</button>
                    </div>
                </form>
                <p class="ml-3">Don't have an account?<a href="{{url('/')}}"> Register here!</a></p>
            </div>
        </div>
        <!-- /form card register -->
    </div>
</div>

@include('components.footer')
</div>
<style>
    .wrapper{
        display:flex;
        flex-direction:column;
        height: 100vh;
    }
    footer{
        margin-top:auto;
    }
</style>
<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/jquery-validation.js')}}"></script>
<script src="{{asset('js/regform-validate.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>