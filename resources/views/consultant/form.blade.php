<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input class="form-control" type="text" placeholder="First Name" name="first_name"
                value="{{old('first_name', $model?->first_name)}}">
            <span class="text-danger">{{$errors->first('first_name')}}</span>
        </div>
    </div>
    <div class="col-sm-6 col-md-6">
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input class="form-control" type="text" placeholder="Last Name" name="last_name"
                value="{{old('last_name', $model?->last_name)}}">
            <span class="text-danger">{{$errors->first('last_name')}}</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Address</label>
            <input class="form-control" type="text" placeholder="Home Address" name="address"
                value="{{old('address', $model?->address)}}">
            <span class="text-danger">{{$errors->first('address')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Telephone</label>
            <input class="form-control" type="tel" placeholder="Telephone" name="telephone"
                value="{{old('telephone', $model?->telephone)}}">
            <span class="text-danger">{{$errors->first('telephone')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" type="email" placeholder="Address" name="email"
                value="{{old('email', $model?->email)}}">
            <span class="text-danger">{{$errors->first('email')}}</span>
        </div>
    </div>

    <div class="col-md-3">
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <select class="form-control btn-square" name="gender_id">
                <option value="">--Select--</option>
                @foreach ($genders as $id => $gender)
                <option value="{{$id}}" {{old('gender_id', $model?->gender_id) == $id ?
                    'selected' : null}}>
                    {{$gender}}
                </option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('gender_id')}}</span>
        </div>
    </div>

    <div class="col-md-12">
        @php
        $user_job_type_ids = old('user_types' , $model ? $model->jobTypes->pluck('id')->toArray() : []);
        @endphp
        <label class="form-label">Consulting Areas</label>
        <div class="row">
            @php $count = 1; @endphp
            @foreach ($jobTypes as $id => $name)
            @if ($count % 5 === 1) @if ($count > 1) </div> @endif <div class="col-md-4"> @endif
            <label class="d-block" for="user_types{{$id}}">
                <input class="checkbox_animated" type="checkbox" id="user_types{{$id}}" value="{{$id}}"
                    name="job_types[]" {{in_array($id, $user_job_type_ids) ? 'checked' : false}}>
                {{$name}}
            </label>

            @php $count++; @endphp
            @endforeach
            @if ($count > 1)
        </div> @endif
        <span class="text-danger">{{$errors->first('job_types')}}</span>
    </div>
    <br>
    <div class="col-md-12">
        @php
        $user_country_ids = old('countries', $model ? $model->countries->pluck('id')->toArray() : []);
        @endphp
        <label class="form-label">Consulting Countries</label>
        <div class="row">
            @php $count = 1; @endphp
            @foreach ($countries as $id => $name)
            @if ($count % 5 === 1) @if ($count > 1) </div> @endif <div class="col-md-4"> @endif
            <label class="d-block" for="user_cntry_{{$id}}">
                <input class="checkbox_animated" type="checkbox" id="user_cntry_{{$id}}" value="{{$id}}"
                    name="countries[]" {{in_array($id, $user_country_ids) ? 'checked' : false}}>
                {{$name}}
            </label>

            @php $count++; @endphp
            @endforeach
            @if ($count > 1)
        </div> @endif
        <span class="text-danger">{{$errors->first('countries')}}</span>
    </div>


    <div class="col-md-12">
        <div>
            <label class="form-label">Notes</label>
            <textarea class="form-control" rows="5"
                placeholder="Enter About your description">{{old('notes', $model?->notes)}}</textarea>
            <span class="text-danger">{{$errors->first('notes')}}</span>
        </div>
    </div>
    <div class="col-md-1">
        <br>
        <div class="d-flex mb-2">
            <label class="col-form-label m-r-10">Status</label>
            <div class="flex-grow-1 text-end icon-state">
                <label class="switch">
                    <input type="checkbox" {{old('status', $model?->status) == 1 ? 'checked' : null}} name="status"
                    value="1" ><span class="switch-state"></span>
                </label>
            </div>
        </div>
    </div>
    <span class="text-danger">{{$errors->first('status')}}</span>
</div>
