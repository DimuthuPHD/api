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
            <select class="form-control btn-square" name="consultant_id"
                data-default="{{old('consultant_id', $model?->slot?->consultant_id)}}"
                data-slot="{{old('slot_id', $model?->slot?->id)}}">
                <option value="">--Select--</option>
                @foreach ($consultants as $id => $role)
                <option value="{{$id}}" {{old('consultant_id', $model?->slot?->consultant_id) == $id ? 'selected' :
                    null}}>
                    {{$role}}
                </option>
                @endforeach
            </select>
            <span class="text-danger">{{$errors->first('consultant_id')}}</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" id="notes" cols="30" class="form-control"
                rows="10">{{old('notes', $model?->notes)}}</textarea>
            <span class="text-danger">{{$errors->first('notes')}}</span>
        </div>
    </div>

    @if ($model !== null)
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

    @endif

    <span class="text-danger">{{$errors->first('status')}}</span>
</div>

<br><br><br><br>
<div class="row">
    <div class="col-md-12">
        <h3>Avaiable Slots</h3>
    </div>
    <div class="col-md-12">
        <div class="slots">

            @include('appointment.slots')

        </div>
        <span class="text-danger" id="slot_error">{{$errors->first('slot_id')}}</span>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
        var select = $('select[name="consultant_id"]');
        if(select.data('default')){
            getSlots(select.data('default'))
        }
    })

    $('select[name="consultant_id"]').on('change',function(event) {
        $('#slot_error').text('')
        getSlots($(this).val())
    })

    function getSlots(consultant){

        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });

        $.ajax({

        type:'POST',

        url: '/consultant/'+consultant+'/slots',
        data : {default_slot: $('select[name="consultant_id"]').data('slot')},
        success:function(data){

            if (data.success) {
                $('.slots').html(data.slots);
            }

        }

        });
    }
</script>
@endpush
