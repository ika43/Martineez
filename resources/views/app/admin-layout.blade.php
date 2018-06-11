
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <title>Admin Panel</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
</head>

<body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{url('/')."/admin"}}">Martineez</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="{{url('/')."/admin/logout"}}">Sign out</a>
        </li>
    </ul>
</nav>
    <div class='wrapper'>


<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2  bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{url('/')."/admin"}}">
                            <span data-feather="users"></span>
                            Users <span class="sr-only"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')."/admin/post"}}">
                            <span data-feather="file"></span>
                            Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')."/admin/comment"}}">
                            <span data-feather="message-square"></span>
                            Comments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')."/admin/activities"}}">
                            <span data-feather="activity"></span>
                            Activities
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')."/admin/survey"}}">
                            <span data-feather="send"></span>
                            Survey
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')."/admin/adv"}}">
                            <span data-feather="tv"></span>
                            Advertisement
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3">
            @yield('content')
        </main>
    </div>
</div>
@include('components.footer')
</div>
<style>
    .wrapper{
        height: 100vh;
        display: flex;
        flex-direction: column;
    }
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/jquery-validation.js')}}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
</body>
</html>
