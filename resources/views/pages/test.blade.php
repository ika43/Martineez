<div class="container">
    <div class="row fullWidth bgpm">
        <img src="{{asset('images/simple.jpg')}}" class="rounded img-fluid" style="opacity: 0.600; border: 1px solid rgba(0,0,0,.125);"/>
        <div class="large-12 columns box">

            <div class="row">
                <div class="large-2 large-centered columns">
                        @if(isset($profilimg))
                            <img src="{{($profilimg->src)}}" class="logo rounded">
                        @else
                            <img src="{{asset('images/blank-profile.png')}}" class="logo rounded">
                        @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row fullWidth">
        <div class="large-12 columns box fw">
        </div>
    </div>
    <div class="container">
        <h3 class="text-center">{{$user->firstname." ".$user->lastname}}</h3>
        <p class="text-center">{{$user->workplace}}, {{$user->position}}</p>
    </div>
    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
        @if(count($post)>=1)
        <li class="nav-item">
            <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">{{$user->firstname}}'s Wall
            </a>
        </li>
        @endif
            @if(count($gallery) >= 1)
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Gallery</a>
        </li>
            @endif
        <li class="nav-item">
            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true">Information</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade  pt-5 mb-5" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="d-flex justify-content-center">
                <div class="container">
                    @if(count($post)>=1)
                        @foreach($post as $item)
                            @if(empty($item->srcPost))
                                @include('components.text-post')
                            @else
                                @include('components.img-post')
                            @endif
                        @endforeach
                    @else
                        @include('components.first-time')
                    @endif
                </div>
            </div>
        </div>
        <div class="tab-pane fade mb-5" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container pb-5">
                <h5 class="pt-3 text-center">{{$user->firstname}} Photo's</h5>

                {{--CODE FOR GALLERY--}}
                @if(count($gallery) >= 1)
                    @include('components.gallery')
                @else
                    @include('components.first-time-gallery')
                @endif



            </div>
        </div>
        <div class="tab-pane fade show active" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <h5 class="pt-3 text-center">About {{$user->firstname}}</h5>
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