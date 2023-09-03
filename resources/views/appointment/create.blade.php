@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">

            <div class="col-xl-12">
                <x-utils.forms.post :route="route('appointment.store')" :cancel="route('appointment.index')"
                    title="Create Appointment" :files="true">
                    @include('appointment.form', ['model' =>null])
                </x-utils.forms.post>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection