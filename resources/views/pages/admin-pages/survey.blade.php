@extends('app.admin-layout')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Statistic and update</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Insert new</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Delete &vert; Set active</a>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
            <select class="form-control form-control-lg mb-4 ddl-survey mt-5">
                <option value="0">Choose survey...</option>
                @foreach($surveys as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            <div id="shQuest" class="mt-5"></div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="container">
            <form action='{{url('/')."/admin/survey/insert"}}' id='insertSurvey' method='POST'>
                {{csrf_field()}}
                <div class='form-group'><label for='name'>Enter the name of the survey</label><input type='text' class='form-control' name='name'></div>
                <div class='form-group'><label for='question1'>Question 1</label><input type='text' class='form-control' name='question1'></div>
                <div class='form-group'><label for='question2'>Question 2</label><input type='text' class='form-control' name='question2'></div>
                <div class='form-group'><label for='question3'>Question 3</label><input type='text' class='form-control' name='question3'></div>
                <button type='submit' class='btn btn-dark'>Insert</button>
            </form>
            </div>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
            <div class="container">
            <form action='{{url('/')."/admin/survey/delete"}}' method='POST' id="insertNewSurvey">
                {{csrf_field()}}
            <select class="form-control form-control-lg mb-4 mt-5" name="ddlDelete" id="ddlDel">
                <option value="0">Choose survey...</option>
                @foreach($surveys as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
                <button type='submit' class='btn btn-dark' value="0" name="btnAction">Delete</button>
                <button type='submit' class='btn btn-dark' value="1" name="btnAction">Set active</button>
            </form>
            </div>
        </div>
    </div>
    @endsection

