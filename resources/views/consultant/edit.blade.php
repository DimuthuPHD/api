@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">

            <div class="col-xl-12">
                <x-utils.forms.patch :route="route('consultant.update', $consultant->id)"
                    :cancel="route('consultant.index')" title="Edit Job Seeker" :files="true">
                    @include('consultant.form', ['model' =>$consultant])
                </x-utils.forms.patch>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
