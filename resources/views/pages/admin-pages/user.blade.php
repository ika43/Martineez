@extends('app.admin-layout')
@section('content')

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="update-tab" data-toggle="tab" href="#update" role="tab" aria-controls="update" aria-selected="true">Update or Delete</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="insert-tab" data-toggle="tab" href="#insert" role="tab" aria-controls="insert" aria-selected="false">Insert</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="update" role="tabpanel" aria-labelledby="update-tab">
                <div class="table-responsive mt-5">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Workplace</th>
                            <th>Position</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Date of birth</th>
                            <th>Registration date</th>
                            <th>Delete User</th>
                            <th>Edit User</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $item)
                            <tr>
                                <td>{{$item->firstname}}</td>
                                <td>{{$item->lastname}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->workplace}}</td>
                                <td>{{$item->position}}</td>
                                <td>{{$item->city}}</td>
                                <td>{{$item->state}}</td>
                                <td>{{$item->dateOfBirth}}</td>
                                <td>{{\Carbon\Carbon::parse($item->created_at)->format('d.m.Y  \a\t H:i')}}</td>
                                <td>
                                    <form action="{{url()->current()."/delete/".$item->id.""}}" method="post">
                                        {{csrf_field()}}
                                        <button type="submit" class="btn btn-dark btn-del" onclick="return confirm('Are you sure you want to delete user?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <button class="btn btn-dark btn-edit" type="button" data-toggle="collapse" data-target="#{{$item->id}}" rel="{{$item->id}}">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="11">
                                    <div class="collapse" id="{{$item->id}}">
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{--INSERT NEW ONE--}}
            <div class="tab-pane fade" id="insert" role="tabpanel" aria-labelledby="insert-tab">
                <form action='{{url('/')."/admin/register"}}' method='post' id="adminInsert">
                    {{csrf_field()}}
                    <div class='form-group row'>
                        <label for='tbFirstname' class='col-sm-2 col-form-label'>Firstname:</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='tbFirstname'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbLastname' class='col-sm-2 col-form-label'>Lastname:</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='tbLastname'>
                        </div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbPosition' class='col-sm-2 col-form-label'>Position:</label>
                        <div class='col-sm-10'><input type='text' class='form-control' name='tbPosition'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbWorkplace' class='col-sm-2 col-form-label'>Workplace:</label>
                        <div class='col-sm-10'><input type='text' class='form-control' name='tbWorkplace'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbCity' class='col-sm-2 col-form-label'>City:</label>
                        <div class='col-sm-10'><input type='text' class='form-control' name='tbCity'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbState' class='col-sm-2 col-form-label'>State:</label>
                        <div class='col-sm-10'><input type='text' class='form-control' name='tbState'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbMail' class='col-sm-2 col-form-label'>Email:</label>
                        <div class='col-sm-10'><input type='email' class='form-control' name='tbMail'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='tbPassword' class='col-sm-2 col-form-label'>Password:</label>
                        <div class='col-sm-10'><input type='password' class='form-control' name='tbPassword'></div>
                    </div>
                    <div class='form-group row'>
                        <label for='date' class='col-sm-2 col-form-label'>Date of Birth:</label>
                        <div class='col-sm-10'><input type='date' class='form-control' name='date'></div>
                    </div>
                    <div class='form-group row'>
                        <div class='col-sm-10'><button type='submit' class='btn btn-dark'>Confirm</button></div>
                    </div>
                </form>
                @if (session('msg'))
                    <div class="alert alert-danger">
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
        </div>
    @stop