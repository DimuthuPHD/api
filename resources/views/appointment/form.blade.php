<div class="row">

    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Job Seeker</label>
            <select class="form-control btn-square" name="job_seeker_id">
                <option value="">--Select--</option>
                @foreach ($jobSeekers as $id => $role)
                <option value="{{$id}}" {{old('job_seeker_id', $model?->job_seeker_id) == $id ? 'selected' : null}}>
                    {{$role}}
                </option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('job_seeker_id')}}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">Consultant</label>
            <select class="form-control btn-square" name="consultant_id">
                <option value="">--Select--</option>
                @foreach ($consultants as $id => $role)
                <option value="{{$id}}" {{old('consultant_id', $model?->consultant_id) == $id ? 'selected' : null}}>
                    {{$role}}
                </option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('consultant_id')}}</span>
        </div>
    </div>


    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input class="form-control" type="date" placeholder="Address" name="date"
                value="{{old('date', $model?->date)}}" step="any">
            <span class="text-danger">{{$errors->first('date')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">From</label>
            <input class="form-control" type="time" placeholder="Address" name="time_from"
                value="{{old('time_from', $model?->time_from)}}" step="any">
            <span class="text-danger">{{$errors->first('time_from')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">From</label>
            <input class="form-control" type="time" placeholder="Address" name="time_to"
                value="{{old('time_to', $model?->time_to)}}" step="any">
            <span class="text-danger">{{$errors->first('time_to')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select class="form-control btn-square" name="status_id">
                <option value="">--Select--</option>
                @foreach ($statuses as $id => $role)
                <option value="{{$id}}" {{old('status_id', $model?->status_id) == $id ?
                    'selected' : null}}>
                    {{$role}}
                    </option>
                 @endforeach
            </select>
            <span class="text-danger">{{$errors->first('status_id')}}</span>
        </div>
    </div>

    <span class="text-danger">{{$errors->first('status')}}</span>
</div>
