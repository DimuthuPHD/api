@extends('layouts.app')
@section('content')
@props(['route' => null , 'columns' => []])
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <a href="{{route('job-seeker.create')}}" class="btn btn-pill btn-primary btn-air-primary pull-right">Add New</a>
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
                                <th scope="col">Date Of Birth</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($jobSeekers as $jobSeeker)
                            <tr>
                                <th scope="row">#{{$jobSeeker->id}}</th>
                                <td>{{$jobSeeker->first_name}}</td>
                                <td>{{$jobSeeker->last_name}}</td>
                                <td>{{$jobSeeker->email}}</td>
                                <td>{{$jobSeeker->date_of_birth}}</td>
                                <td><a href="{{route('job-seeker.edit', $jobSeeker->id)}}" class="btn btn-outline-info btn-sm">Edit</a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="card-footer">
            {{ $jobSeekers->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
