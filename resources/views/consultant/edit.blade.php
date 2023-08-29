@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">

            <div class="col-xl-12">
                <x-utils.forms.patch :route="route('job-seeker.update', $jobSeeker->id)" :cancel="route('job-seeker.index')" title="Edit Job Seeker" :files="true">
                    @include('job-seeker.form', ['model' =>$jobSeeker])
                </x-utils.forms.patch>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
