@extends('layouts.app', ['page_title' => 'Consultants'])
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('consultant.create')}}" class="btn btn-pill btn-primary btn-air-primary pull-right">Add
                New</a>
        </div>
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($consultants as $consultant)
                            <tr>
                                <th scope="row">#{{$consultant->id}}</th>
                                <td>{{$consultant->first_name}}</td>
                                <td>{{$consultant->last_name}}</td>
                                <td>{{$consultant->email}}</td>
                                <td><a href="{{route('consultant.edit', $consultant->id)}}"
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
            {{ $consultants->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
