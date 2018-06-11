@extends('app.admin-layout')
@section('content')
    <div class='container'>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">User activities</h1>
    </div>
    <select class="form-control form-control-lg mb-4 ddl-act">
        <option value="0">Choose user...</option>
        @foreach($users as $item)
            <option value="{{$item->id}}">{{$item->firstname." ".$item->lastname}}</option>
        @endforeach
    </select>
    <div id="showAct" class="container">
    </div>
    </div>
@endsection