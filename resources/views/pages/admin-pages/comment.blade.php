@extends('app.admin-layout')
@section('content')

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Insert</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Edit or delete</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="container">
                <select class="form-control form-control-lg ddl-cpostCom mb-4 mt-lg-5">
                    <option value="0">Choose post by user...</option>
                    @foreach($users as $item)
                        <option value="{{$item->id}}">{{$item->firstname." ".$item->lastname}}</option>
                    @endforeach
                </select>
                <div id="prikaz" class="container">
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <div class="container">

                <select class="form-control form-control-lg ddl-comment mb-4 mt-lg-5">
                    <option value="0">Choose comment by user...</option>
                    @foreach($users as $item)
                        <option value="{{$item->id}}">{{$item->firstname." ".$item->lastname}}</option>
                    @endforeach
                </select>
                <div id="shComm" class="container">

                </div>

            </div>

        </div>
    </div>
@endsection