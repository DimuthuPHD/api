@extends('layouts.app')
@section('content')
@props(['route' => null , 'columns' => []])
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('user.create')}}" class="btn btn-pill btn-primary btn-air-primary pull-right">Add
                New</a>
        </div>
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $user)
                            <tr>
                                <th scope="row">#{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>
                                    <x-utils.status :status="$user->status"></x-utils.status>
                                </td>
                                <td>{{$user->email}}</td>
                                <td><a href="{{route('user.edit', $user->id)}}"
                                        class="btn btn-outline-info btn-sm">Edit</a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
