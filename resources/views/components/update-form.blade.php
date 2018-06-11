<form class="form register-form" role="form" action="{{url('/')."/edit"}}" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <label for="tbFirstname" class="font-weight-light">Firstname</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">account_circle</i></span>
            </div>
            <input type="text"  name="tbFirstname" class="form-control" value="{{$user->firstname}}" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="firstname"></div>
    </div>
    <div class="form-group">
        <label for="tbLastname" class="font-weight-light">Lastname</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">account_circle</i></span>
            </div>
            <input type="text"  name="tbLastname" class="form-control mb-0" value="{{$user->lastname}}" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="lastname"></div>
    </div>
    <div class="form-group">
        <label for="tbPosition" class="font-weight-light">Position</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">local_bar</i></span>
            </div>
            <input type="text" class="form-control mb-0 req" value="{{$user->position}}" name="tbPosition" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="position"></div>
    </div>
    <div class="form-group">
        <label for="tbWorkplace" class="font-weight-light">Workplace</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">restaurant_menu</i></span>
            </div>
            <input type="text" class="form-control mb-0" value="{{$user->workplace}}" name="tbWorkplace" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="workplace"></div>
    </div>
    <div class="form-group">
        <label for="tbCity" class="font-weight-light">City</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">location_on</i></span>
            </div>
            <input type="text" class="form-control mb-0"
                   @if(isset($user->city))
                   value="{{$user->city}}"
                   @endif
                   name="tbCity" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="city"></div>
    </div>
    <div class="form-group">
        <label for="tbState" class="font-weight-light">State</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">location_city</i></span>
            </div>
            <input type="text" class="form-control mb-0"
                   @if(isset($user->state))
                   value="{{$user->state}}"
                   @endif
                   name="tbState" onclick="this.select();" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
        </div>
        <div id="state"></div>
    </div>
    <div class="form-group">
        <label for="tbDate" class="font-weight-light">Date of Birth</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1"><i class="material-icons">date_range</i></span>
            </div>
            @if($user->dateOfBirth=="" && $user->id == session()->get('user')[0]->getId())
            <input type="date" class="form-control mb-0" name="tbDate" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
                @else
                <input type="text" class="form-control mb-0" value="{{$user->dateOfBirth}}" @if($user->id != session()->get('user')[0]->getId()){{"readonly"}}@endif>
                @endif
        </div>
    </div>
    @if($user->id == session()->get('user')[0]->getId())
    <div class="form-group">
        <button type="reset" class="btn btn-secondary">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
        @endif
</form>