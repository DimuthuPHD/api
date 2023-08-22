@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <div class="col-xl-12">
                <x-utils.forms.patch :route="route('appointment.update', $model->id)"
                    :cancel="route('appointment.index')" title="Edit Appointment" :files="true">
                    @include('appointment.form', ['model' =>$model])
                </x-utils.forms.patch>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection