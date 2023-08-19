<div class="row">

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input class="form-control" type="text" placeholder="First Name" name="first_name"
                value="{{old('first_name', $model?->first_name)}}">
            <span class="text-danger">{{$errors->first('first_name')}}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input class="form-control" type="text" placeholder="Last Name" name="last_name"
                value="{{old('last_name', $model?->last_name)}}">
            <span class="text-danger">{{$errors->first('last_name')}}</span>
        </div>
    </div>

    <div class="col-md-4">
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select class="form-control btn-square" name="role_id">
                <option value="">--Select--</option>
                @foreach ($roles as $id => $role)
                <option value="{{$id}}" {{old('role_id', $model?->role_id) == $id ? 'selected' : null}}>
                    {{$role}}
                </option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('role_id')}}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" placeholder="Address" name="email"
                value="{{old('email', $model?->email)}}">
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" type="password" placeholder="Address" name="password" value="">
            <span class="text-danger">{{$errors->first('password')}}</span>
        </div>
    </div>

    <div class="col-md-1">
        <br>
        <div class="d-flex mb-2">
            <label class="col-form-label m-r-10">Status</label>
            <div class="flex-grow-1 text-end icon-state">
                <label class="switch">
                    <input type="checkbox" {{old('status', $model?->status) == 1 ? 'checked' : null}}
                    name="status"><span class="switch-state"></span>
                </label>
            </div>
        </div>
    </div>
    <span class="text-danger">{{$errors->first('status')}}</span>
</div>
