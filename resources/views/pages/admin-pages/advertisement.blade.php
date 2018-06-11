@extends('app.admin-layout')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="insert-tab" data-toggle="tab" href="#insert" role="tab" aria-controls="insert" aria-selected="true">Insert</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="false">Update</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="delete-tab" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false">Delete</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="insert" role="tabpanel" aria-labelledby="insert-tab">
            <div class="container">
            <form id="insertAdv" method="POST" action="{{url('/')."/admin/adv/insert"}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="Title">Title</label>
                    <input type="text" class="form-control" placeholder="Title" name="title">
                </div>
                <div class="form-group">
                    <label for="text">Text</label>
                    <textarea class="form-control" name="text" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <button type="submit" class="btn btn-dark">Insert</button>
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
        <div class="tab-pane fade" id="update" role="tabpanel" aria-labelledby="update-tab">
            <div class="container">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
            <select class="form-control form-control-lg mb-4 ddl-upd-adv mt-5">
                <option value="0">Choose adv...</option>
                @foreach($advs as $item)
                    <option value="{{$item->id}}">{{$item->title}}</option>
                @endforeach
            </select>
                <div id="showUpdAdv">

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="delete" role="tabpanel" aria-labelledby="delete-tab">
            <div class="container">
                <form method="post" action="{{url('/')."/admin/adv/delete"}}">
                    {{csrf_field()}}
                    <select class="form-control form-control-lg mb-4 mt-5" name="ddlDelAdv">
                        <option value="0">Choose adv...</option>
                        @foreach($advs as $item)
                            <option value="{{$item->id}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-dark">Delete</button>
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
    </div>
    @endsection