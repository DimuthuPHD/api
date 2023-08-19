@extends('layouts.app')
@section('content')
<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="edit-profile">
        <div class="row">

            <div class="col-xl-12">
                <x-utils.forms.patch :route="route('user.update', $model->id)" :cancel="route('user.index')"
                    title="Edit User" :files="true">
                    @include('user.form', ['model' =>$model])
                </x-utils.forms.patch>

            </div>
        </div>
    </div>
</div>
<!-- Container-fluid Ends-->
@endsection
