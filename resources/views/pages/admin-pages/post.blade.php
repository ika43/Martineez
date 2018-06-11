@extends('app.admin-layout')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Insert</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Delete or Update</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

            <div class="container">

                <form class="adminPostImg" action="{{url('/')."/admin/postImg"}}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{csrf_field()}}
                        <fieldset class="form-group">
                            <label for="tbTitle">Title</label>
                            <input type="text" class="form-control" name="tbTitle">
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>

                </form>
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

        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

            <div class="container">
                <select class="form-control form-control-lg ddl-cpost mb-4 mt-lg-5">
                    <option value="0">Choose post by user...</option>
                    @foreach($users as $item)
                        <option value="{{$item->id}}">{{$item->firstname." ".$item->lastname}}</option>
                    @endforeach
                </select>
                <div id="prikaz" class="container">
                </div>
            </div>

        </div>
    </div>
    @endsection