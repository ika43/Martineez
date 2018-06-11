@extends('app.layout')
@section('content')
    @if (session('msg'))
        <div class="alert alert-success text-center fade-out">
            {{ session('msg') }}
        </div>
    @endif
    <div class="container profilPrikaz">
        <div class="row">
            {{--ADVERTISEMENT--}}
            @include('components.advertisement')

            <div id='mediaContent' class="col-sm-6 p-0">
                <div class="share nmt">
                    <h3 class="">Hello, {{session()->get('user')[0]->getFirstname()}}!</h3>
                    <p class="lead">Share an article or photo...</p>
                    <hr class="my-2">
                    <p class="lead">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Share Photo
                        </button>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#article-modal">
                            Share article
                        </button>
                    </p>
                </div>

                {{--PLACE FOR ALL POST--}}
                @foreach($post as $item)
                    @if(empty($item->srcPost))
                        @include('components.text-post')
                        @else
                        @include('components.img-post')
                        @endif
                @endforeach
            </div>
                  <div  class="col-sm banner">
            @include('components.survey')
                <div id="weather" class="text-center card"></div>
        </div>
            <script>
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (xmlhttp.readyState === XMLHttpRequest.DONE ) {
                        if (xmlhttp.status === 200) {
                            var data = JSON.parse(xmlhttp.responseText);
                            var output = "";
                            //access json properties here

                            var src = "http://openweathermap.org/img/w/"+data.weather[0].icon+".png";
                            $('.wimg').attr('src',src);
                            var date = new Date(data.sys.sunrise*1000);
                            var sunrise = date.getHours()+":"+date.getMinutes();
                            var date2 = new Date(data.sys.sunset*1000);
                            var sunset = date2.getHours()+":"+date2.getMinutes();
                            output += "<table class=\"table table-sm\">";
                            output += "<h5 class=\"card-title\">Weather in "+data.name+", "+data.sys.country+"</h5>";
                            output += "<h3 class=\"card-title\"><img src='"+src+"'>"+Math.round(data.main.temp)+"&#8451;</h3>";
                            output += "<tr><td>Wind</td><td scope=\"row\">"+data.wind.speed+" m/s</td></tr>";
                            output += "<tr><td>"+data.weather[0].main+"</td><td>"+data.weather[0].description+"</td></tr>";
                            output += "<tr><td>Pressure</td><td>"+data.main.pressure+" hpa</td></tr>";
                            output += "<tr><td>Humidity</td><td>"+data.main.humidity+" %</td></tr>";
                            output += "<tr><td>Sunrise</td><td>"+sunrise+"</td></tr>";
                            output += "<tr><td>Sunset</td><td>"+sunset+"</td></tr>";
                            output += "</table>";
                            $('#weather').html(output);
                        }
                        else if (xmlhttp.status === 400) {
                            alert('There was an error 400');
                        }
                        else {
                            alert('something else other than 200 was returned');
                        }
                    }
                };
                xmlhttp.open("GET", "http://api.openweathermap.org/data/2.5/weather?q=Belgrade&units=metric&APPID=05d3f9aa93293d57f108b50293a99812", true);
                xmlhttp.send();
            </script>
        </div>
    </div>
@stop