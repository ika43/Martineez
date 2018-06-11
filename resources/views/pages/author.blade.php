<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="utf-8">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
    <title>Author</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">

    </div>
</nav>
<div class="container">
    <img src="{{asset('images/profile.jpg')}}" class="rounded mx-auto d-block mt-lg-5" alt="author-profil" style="width: 200px; height: 200px;">
    <div class="jumbotron text-center">
        <p class="lead">Hello people my name is</p>
        <hr class="my-4">
        <h1 class="display-4">Laba Ivan</h1>
        <p class="lead">Web designer, developer</p>
        <p>I currently study ICT college of vocational studies.</p>
        <p>This project is for my course from Objected-oriented programming PHP using laravel framework.</p>
    </div>
</div>

@include('components.footer')
<script
        src="http://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>