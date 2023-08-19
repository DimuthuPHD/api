@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">

            <div class="col-xl-12">
                <x-utils.forms.post :route="route('job-seeker.store')" :cancel="route('job-seeker.index')" title="Create Job Seeker" :files="true">
                    @include('job-seeker.form', ['model' =>null])
                </x-utils.forms.post>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
