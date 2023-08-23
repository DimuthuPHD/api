@extends('layouts.app', ['page_title' => 'Appointment List'])
@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <form action="{{route('appointment.index')}}" method="get" name="filter_appointments"
                id="filter_appointments">
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">From</label>
                            <input class="form-control" type="date" name="date_from" value="{{request('date_from')}}"
                                step="any">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">To</label>
                            <input class="form-control" type="date" name="date_to" value="{{request('date_to')}}"
                                step="any">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-3">
                            <label class="form-label">Time From</label>
                            <input class="form-control" type="time" name="time_from" value="{{request('time_from')}}"
                                step="any">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="mb-3">
                            <label class="form-label">Time To</label>
                            <input class="form-control" type="time" name="time_to" value="{{request('time_to')}}"
                                step="any">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Consultant</label>
                            <input class="form-control" type="email" name="consultant" value="{{request('consultant')}}"
                                placeholder="Consultant Email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">Job Seeker</label>
                            <input class="form-control" type="email" name="job_seeker" value="{{request('job_seeker')}}"
                                placeholder="Job Seeker Email">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <br>
                            <a href="{{route('appointment.create')}}" class="btn btn-square btn-success float-left">+ New</a>
                            <button type="submit" class="btn btn-square btn-primary pull-right">Filter</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        @if (count(array_filter(request()->all())) > 0)
                        @php
                        $params = array_filter(request()->all());
                        $params['export'] = isset($params['export']) ? $params['export'] : 1
                        @endphp
                        <a href="{{route('appointment.index')}}" class="btn btn-square btn-danger">Reset
                            Filters</a>

                        <a href="{{route('appointment.index', array_merge($params))}}"
                            class="btn btn-square btn-secondary">Export</a>
                        @endif

                    </div>
                </div>
            </form>

        </div>
        <div class="card-block row">
            <div class="col-sm-12 col-lg-12 col-xl-12">
                <div class="table-responsive">
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Job Seeker</th>
                                <th scope="col">Consultant</th>
                                <th scope="col">Date</th>
                                <th scope="col">From</th>
                                <th scope="col">To</th>
                                <th scope="col">Created on</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $appointment)
                            @php
                            $from = \Carbon\Carbon::parse($appointment->time_from)->format('h:i:A');
                            $to = \Carbon\Carbon::parse($appointment->time_to)->format('h:i:A');
                            @endphp
                            <tr>
                                <th scope="row">#{{$appointment->id}}</th>
                                <td>{{$appointment->jobSeeker->full_name}}</td>
                                <td>{{$appointment->consultant->full_name}}</td>
                                <td>{{$appointment->date}}</td>
                                <td>{{$from}}</td>
                                <td>{{$to}}</td>
                                <td>{{\Carbon\Carbon::parse($appointment->created_at)->format('Y-M-d : h:iA')}}</td>
                                <td>
                                    <x-utils.appointmet-status :status="$appointment?->status?->name">
                                    </x-utils.appointmet-status>
                                </td>
                                <td><a href="{{route('appointment.edit', $appointment->id)}}"
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
