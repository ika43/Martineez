<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Berkshire+Swash" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <title>Martineez</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <link href="{{asset('css/lightbox.css')}}" rel="stylesheet">
    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
</head>
<body>


{{--NAVIGATION--}}
<nav id="mainNav" class="nav navbar navbar-expand-lg navbar-light bg-light div-sticky">
    <div class="container">
        <a class="navbar-brand logo-nav" href="{{url('/')."/home"}}" style="color:white">Martineez</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            {{--SEARCH FORM--}}
            <form class="input-group mr-5 mt-2 mt-lg-0" id="search-form" autocomplete="off">
                {{csrf_field()}}
                <input type="text" class="form-control" placeholder="Search for people..." name="tbSearch" id="myInput">
                <div class="input-group-append">
                    <span class="input-group-text searchTxt"><button type="submit" class="btn btn-light" id="btnSearch">Search</button></span>
                </div>
            </form>
            <ul id="mainUl" class="navbar-nav my-2 my-lg-0 ml-5">
                <li class="nav-item mx-1">
                    <a class="nav-link btn btn-primary" href="{{url('/')."/home"}}">Home</a>
                </li>
                <li id="mainLi" class="nav-item mx-1">
                    <a class="nav-link btn btn-primary" href="{{url('/')."/profil"}}">
                        {{session()->get('user')[0]->getFirstname()}}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link btn btn-primary" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Notification @if(count($notf) >=1)<span class="badge badge-danger">{{count($notf)}}</span>@endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(count($notf) >=1)
                        @foreach($notf as $item)
                            <a class="dropdown-item noty-item" href="#" rel="{{$item->postId."-".$item->commentId}}"><small>{{$item->firstname." ".$item->lastname}} commented on your post</small></a>
                            @endforeach
                            @else
                            <a class="dropdown-item" href="#"><small>No new notification</small></a>
                        @endif
                    </div>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link btn btn-primary" href="{{url('/')."/logout"}}">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@if ($errors->any())
    <div class="alert alert-danger text-center">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--END NAVIGATION--}}

{{--MODAL FOR POST--}}
@include('components.modal')
@include('components.article-modal')
{{--CONTENT--}}
<div class="mt-1">
    @yield('content')
</div>
<style>
    .highlight{
        box-shadow: 0px 0px 10px 4px rgba(99, 66, 99, 0.50);
        -moz-box-shadow: 0px 0px 10px 4px rgba(99, 66, 99, 0.50);
        -webkit-box-shadow: 0px 0px 10px 4px rgba(99, 66, 99, 0.50);
    }
</style>


{{--FOOTER--}}
@include('components.footer')
<a href="#" id="back-to-top" class="back-to-top" title="Back to top"><img src="{{asset('images/top.png')}}" class="back-to-top"/></a>
<script src="{{asset('js/auto-com.js')}}"></script>
<script src="{{asset('js/lightbox-plus-jquery.min.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
<script src="{{asset('js/jquery-validation.js')}}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.13.1/additional-methods.js"></script>
<script src="{{asset('js/regform-validate.js')}}"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>