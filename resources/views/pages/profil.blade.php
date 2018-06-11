@extends('app.layout')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center fade-out">
            {{ session('msg') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger text-center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @include('components.profileModal')
    <div class="container profilPrikaz">
    <div class="row fullWidth bgpm">
        <img src="{{asset('images/simple.jpg')}}" class="rounded img-fluid" style="opacity: 0.600; border: 1px solid rgba(0,0,0,.125);"/>
        <div class="large-12 columns box">

            <div class="row">
                <div class="large-2 large-centered columns">
                    <a href="#" data-toggle="modal" data-target=".profile">
                        @if(isset($profilimg))
                            <img src="{{($profilimg->src)}}" class="logo rounded" style="z-index: 1">
                            @else
                            <img src="{{asset('images/blank-profile.png')}}" class="logo rounded" style="z-index: 1">
                            @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row fullWidth">
        <div class="large-12 columns box fw">
        </div>
    </div>
        <div class="container">
            <h3 class="text-center">{{session()->get('user')[0]->getFirstname()}} {{session()->get('user')[0]->getLastname()}}</h3>
            <p class="text-center">{{session()->get('user')[0]->getWorkplace()}}, {{session()->get('user')[0]->getPosition()}}</p>
        </div>
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">My Wall
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gallery</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Setting's</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active pt-5 mb-5" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div id="pagination_data">
                    </div>
            </div>
            <script>
                $(document).ready(function(){
                    load_data(1);
                    function load_data(page){
                        var url = window.location.href+"/pag";
                        $.ajax({
                            url: url,
                            method: "GET",
                            data: {page: page},
                            success: function (data) {
                                $('#pagination_data').html(data);
                            }, error: function (error) {
                                console.log(error);
                            }

                        })
                    }
                    $(document).on('click', '.pagination_link', function () {
                        var page = $(this).attr('id');
                        load_data(page);
                    });

                })
            </script>
            <div class="tab-pane fade mb-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container pb-5">
                    <h5 class="pt-3 text-center">Your Photo's</h5>

                    {{--CODE FOR GALLERY--}}
                    @if(count($gallery) >= 1)
                        @include('components.gallery')
                    @else
                        @include('components.first-time-gallery')
                    @endif



                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <h5 class="pt-3 text-center">Change your account setting's</h5>
                <!--SETTINGS FORM-->
                <div class="container">
                    <div class="col-md-6 offset-md-3">
                        <!-- form card register -->
                        <div class="card card-outline-secondary mt-4">
                            <div class="card-block">

                                @include('components.update-form')

                            </div>
                        </div>
                        <!-- /form card register -->
                    </div>

                </div>
                <!--END SETTINGS FORM-->
            </div>
        </div>
    </div>

@stop