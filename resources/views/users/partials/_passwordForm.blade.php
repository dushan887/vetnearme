<form action="/password/update"
    method="post"
    class="col-md-3"
    role=form>
    @csrf
    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">

        <label for="password" class="control-label">Password</label>

        <input type="password" name=password class="form-control" value="{{ old('password') }}" id="password" placeholder="Password">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}

    </div>

    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">

        <label for="password" class="control-label">Password Repeat</label>

        <input type="password" name=password_confirmation class="form-control" value="{{ old('password_confirmation') }}" id="password_confirmation" placeholder="Password">
        {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}

    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-danger">Change Password</button>
    </div>

</form>